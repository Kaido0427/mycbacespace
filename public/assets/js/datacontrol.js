//fonction pour verifier si les champs sont remplis avant l'envoi
function signInController() {
    var motdepasse = document.getElementById('password').value.trim();
    var confirm = document.getElementById('Confirmation').value.trim()


   

    if (motdepasse == "") {
        alert("Le mot de passe n'a pas été saisi!");
        event.preventDefault();
        return false;
    }

    if (confirm == "") {
        alert("Vous n'aviez pas confirmer votre mot de passe!");
        event.preventDefault();
        return false;
    }

    if (motdepasse !== confirm) {
        alert(" Les mots de passe ne correspondent pas!");
        event.preventDefault();
        return false;

    }

}
//verification des champs lors de la connexion
function loginController() {
    var motdepasse = document.getElementById('password').value.trim();

    if (document.getElementById("Email").value.trim() == "") {
        alert("L'email n'a pas été saisi!");
        event.preventDefault();
        return false;
    }

    if (motdepasse == "") {
        alert("Le mot de passe n'a pas été saisi!");
        event.preventDefault();
        return false;
    }

}

//pour eviter que la page se recharger apres une sousimission de formulaire
function notReload() {
    event.preventDefault();
}
//confirmation pour toute suppression sur le site
function delConfirmation() {
    confirm('Etes-vous sûr de vouloir supprimer ce dernier?');
}