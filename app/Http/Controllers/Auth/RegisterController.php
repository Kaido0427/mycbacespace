<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\avatar;
use App\Models\User;
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
            'service' => ['required', 'string', 'max:255'],
            'engagement' => ['required', 'string', 'max:255'],
            'engagsup' => ['bail', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'Origine' => ['required', 'string', 'max:255'],
            'createDate' => ['required', 'date'],
            'numAssocies' => ['required', 'string', 'max:255'],
            'regime' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['string']

        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
        }

        return $validator;
    }

    protected function create(array $data)
    {

        $user = User::create([
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'],
            'raison' => $data['reason'],
            'adresse' => $data['adresse'],
            'bp' => $data['bp'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'declaration' => $data['declaration'],
            'service' => $data['service'],
            'engagement' => $data['engagement'],
            'engagsup' => $data['engagsup'],
            'date' => $data['date'],
            'origine' => $data['Origine'],
            'dateCreate' => $data['createDate'],
            'numAssocies' => $data['numAssocies'],
            'regime' => $data['regime'],
            'user_type' => $data['user_type'],
            'password' => Hash::make($data['password']),
        ]);

        // Chemin de l'image par défaut
        $defaultImagePath = public_path('dist/user-default.png');

        // Vérifiez si le fichier existe
        if (file_exists($defaultImagePath)) {
            $imageName = time() . '_user-default.png';
            $destinationPath = public_path('avatars/' . $imageName);
            if (copy($defaultImagePath, $destinationPath)) {
                // Créer l'entrée dans la base de données pour l'avatar
                $avatar = Avatar::create([
                    'user_id' => $user->id,
                    'image' => $imageName
                ]);
            } else {
                echo "L'image par défaut n'a pas été trouvée.";
            }



            Log::info('User created ', ['user' => $user]);

            return $user;
        }
    }
}
