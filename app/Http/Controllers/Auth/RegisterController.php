<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\avatar;
use App\Models\categorie;
use App\Models\service;
use App\Models\User;
use App\Models\userServices;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    protected $redirectTo = '/subscription';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prenoms' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'bp' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'declaration' => ['bail', 'string', 'max:255'],
            'engagement' => ['required', 'string', 'max:255'],
            'engagsup' => ['bail', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'createDate' => ['required', 'date'],
            'numAssocies' => ['required', 'string', 'max:255'],
            'regime' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'user_type' => ['string'],
            'origine_id' => ['required'],
            'services.*' => 'exists:services,id',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
        }

        return $validator;
    }

    protected function create(array $data)
    {
        // Valider les données avant de les utiliser
        $validatedData = $this->validator($data)->validate();

        $user = User::create([
            'nom' => $validatedData['nom'],
            'prenoms' => $validatedData['prenoms'],
            'raison' => $validatedData['reason'],
            'adresse' => $validatedData['adresse'],
            'bp' => $validatedData['bp'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            'declaration' => $validatedData['declaration'],
            'engagement' => $validatedData['engagement'],
            'engagsup' => $validatedData['engagsup'],
            'date' => $validatedData['date'],
            'dateCreate' => $validatedData['createDate'],
            'numAssocies' => $validatedData['numAssocies'],
            'regime' => $validatedData['regime'],
            'user_type' => $validatedData['user_type'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $defaultImagePath = base_path('dist/user-default.png');
        if (file_exists($defaultImagePath)) {
            $imageName = time() . '_user-default.png';
            $destinationPath = base_path('avatars/' . $imageName);
            if (copy($defaultImagePath, $destinationPath)) {
                // je crée l'entrée dans la base de données pour l'avatar
                Avatar::create([
                    'user_id' => $user->id,
                    'image' => $imageName
                ]);
            } else {
                echo "L'image par défaut n'a pas été trouvée.";
            }
            if (isset($validatedData['services'])) {
                foreach ($validatedData['services'] as $serviceId) {
                    $user->services()->attach($serviceId);
                }
            }

            if (isset($validatedData['origine_id'])) {
                $categorie = Categorie::find($validatedData['origine_id']);
                foreach ($categorie->taches as $tache) {
                    $user->procedures()->create([
                        'categorie_id' => $validatedData['origine_id'],
                        'tache_id' => $tache->id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            return $user;
        }
    }
}
