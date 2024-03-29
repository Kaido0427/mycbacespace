<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{

    //======================================SECTION ADMINISTRATEUR===============================

    public function updatePassword()
    {
        //Personaliser son mot de passe administrateur
    }

    //============================================SECTION CLIENT=================================
    public function addCustomer()
    {
        //Fonction pour ajouter un client
    }

    public function updateCustomer()
    {
        //Mise  a jour des information du client
    }

    public function indexCustomer()
    {
        //Pour voir la liste des clients
    }

    public function oneCustomer()
    {
        //voir les informations liés a un client
    }

    public function onOffcustomer()
    {
        //actuivier et desactiver un client dans un cas eventuel
    }

    public function historyTransactions()
    {
        // pour voir l'histrorique des transactions effectués sur un periode donnée
    }
}
