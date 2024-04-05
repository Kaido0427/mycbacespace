<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\avatar;
use App\Models\categorie;
use App\Models\clientService;
use App\Models\User;
use App\Models\userCategorie;
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

        // Chemin de l'image par défaut
        $imageName = public_path('dist/user-default.png');

        // I save the default pic as default avatar for the user who was recently sign up
        Avatar::create([
            'user_id' => $user->id,
            'image' => $imageName
        ]);

        userCategorie::create([
            'user_id' => $user->id,
            'categorie_id' => $validatedData['origine_id']
        ]);

        // Associer les services à l'utilisateur
        if (isset($validatedData['services'])) {
            $user->services()->attach($validatedData['services']);
        }


        return $user;
    }
}
