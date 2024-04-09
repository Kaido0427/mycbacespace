import './bootstrap';
import '../scss/app.scss';


document.querySelector(".jsFilter").addEventListener("click", function () {
    document.querySelector(".filter-menu").classList.toggle("active");
});

document.querySelector(".grid").addEventListener("click", function () {
    document.querySelector(".list").classList.remove("active");
    document.querySelector(".grid").classList.add("active");
    document.querySelector(".products-area-wrapper").classList.add("gridView");
    document
        .querySelector(".products-area-wrapper")
        .classList.remove("tableView");
});

document.querySelector(".list").addEventListener("click", function () {
    document.querySelector(".list").classList.add("active");
    document.querySelector(".grid").classList.remove("active");
    document.querySelector(".products-area-wrapper").classList.remove("gridView");
    document.querySelector(".products-area-wrapper").classList.add("tableView");
});

var modeSwitch = document.querySelector('.mode-switch');
modeSwitch.addEventListener('click', function () {
    document.documentElement.classList.toggle('light');
    modeSwitch.classList.toggle('active');
});



//gestion des liens dynamique de la sidebar
$(document).ready(function () {
    // Récupérer l'identifiant de l'onglet actif depuis sessionStorage
    var activeTab = sessionStorage.getItem('activeTab');

    // Sélectionner l'élément actif dans la sidebar
    var activeItem = $(`a[data-target="${activeTab}"]`);

    // Supprimer la classe 'active' de tous les items
    $('.sidebar-list-item').removeClass('active');

    // Ajouter la classe 'active' à l'élément actif dans la sidebar
    if (activeItem.length) {
        activeItem.parent().addClass('active');

        // Sélectionner l'élément de contenu correspondant à l'élément actif dans la sidebar
        var activeContent = $('#' + activeTab);

        // Afficher l'élément de contenu correspondant à l'élément actif dans la sidebar
        activeContent.show();
    } else {
        // Si aucun élément actif n'est trouvé, sélectionner le premier élément de la sidebar
        var firstItem = $('.sidebar-list-item:first-child');
        if (firstItem.length) {
            firstItem.addClass('active');

            // Sélectionner l'élément de contenu correspondant au premier élément de la sidebar
            var firstContent = $('#' + firstItem.find('a').data('target'));

            // Afficher l'élément de contenu correspondant au premier élément de la sidebar
            firstContent.show();
        }
    }

    // Ajouter l'écouteur d'événement sur le bouton de menu
    $('#menu-toggle').click(function () {
        let sidebar = $('#sidebar');
        let accountInfo = $('.account-info');
        let deco = $('.account-info-logout span'); // Mettre à jour le sélecteur ici
        if ($(window).width() > 768) {
            sidebar.toggleClass('collapsed');
            if (sidebar.hasClass('collapsed')) {
                accountInfo.find('.account-info-name').hide();
                deco.hide(); // Masquer le bouton de déconnexion
            } else {
                accountInfo.find('.account-info-name').show();
                deco.show(); // Afficher le bouton de déconnexion
            }
        } else {
            sidebar.toggleClass('active');
        }
    });


    // Ajouter un écouteur d'événement sur chaque lien de la sidebar
    $('.sidebar-list-item a').click(function (event) {
        event.preventDefault();
        let target = $(this).data('target');

        // Supprimer la classe 'active' de tous les items
        $('.sidebar-list-item').removeClass('active');

        // Ajouter la classe 'active' à l'item cliqué
        $(this).parent().addClass('active');

        // Afficher la section correspondante
        $('.app-content > div').hide();
        $('#' + target).show();

        // Stocker l'identifiant de l'onglet actif dans sessionStorage
        sessionStorage.setItem('activeTab', target);
    });

    // Ajouter un écouteur d'événement sur le lien dans la div #relances
    $('#relances a').click(function (e) {
        e.preventDefault(); // Empêcher le comportement par défaut du lien

        // Changer le contenu principal
        $('.app-content > div').hide(); // Cacher toutes les div
        $('#tasks').show(); // Afficher la div #tasks

        // Changer la classe active
        $('.sidebar-list-item').removeClass('active'); // Supprimer la classe active de tous les éléments de la sidebar
        $('.sidebar-list-item a[data-target="tasks"]').parent().addClass('active'); // Ajouter la classe active au nouvel élément de la sidebar

        // Stocker l'identifiant de l'onglet actif dans sessionStorage
        sessionStorage.setItem('activeTab', 'tasks');
    });
});



//afficher et cacher le mot de passe
document.getElementById('currentPasswordToggle').addEventListener('click', function () {
    var input = document.getElementById('currentPassword');
    if (input.type === 'password') {
        input.type = 'text';
        this.querySelector('svg').classList.remove('bi-eye-fill');
        this.querySelector('svg').classList.add('bi-eye-slash-fill');
    } else {
        input.type = 'password';
        this.querySelector('svg').classList.remove('bi-eye-slash-fill');
        this.querySelector('svg').classList.add('bi-eye-fill');
    }
});


document.getElementById('newPasswordToggle').addEventListener('click', function () {
    var input = document.getElementById('newPassword');
    if (input.type === 'password') {
        input.type = 'text';
        this.querySelector('svg').classList.remove('bi', ' bi-eye-fill');
        this.querySelector('svg').classList.add('bi', 'bi-eye-slash-fill');
    } else {
        input.type = 'password';
        this.querySelector('svg').classList.remove('bi', 'bi-eye-slash-fill');
        this.querySelector('svg').classList.add('bi', ' bi-eye-fill');
    }
});

document.getElementById('confirmPasswordToggle').addEventListener('click', function () {
    var input = document.getElementById('confirmPassword');
    if (input.type === 'password') {
        input.type = 'text';
        this.querySelector('svg').classList.remove('bi', ' bi-eye-fill');
        this.querySelector('svg').classList.add('bi', 'bi-eye-slash-fill');
    } else {
        input.type = 'password';
        this.querySelector('svg').classList.remove('bi', 'bi-eye-slash-fill');
        this.querySelector('svg').classList.add('bi', ' bi-eye-fill');
    }
});



//la srolbar de app-content dans le dashbord
window.onload = function () {
    var header = document.querySelector('.app-head');
    var headerHeight = header.offsetHeight;
    var appContent = document.querySelector('.app-content');
    appContent.style.height = 'calc(100vh - ' + headerHeight + 'px)';
}

//script pour la photo de l'user
document.addEventListener('DOMContentLoaded', () => {
    const loadingSpinner = document.getElementById('loadingSpinner');
    const loadingMessage = document.getElementById('loadingMessage');
    const submitButton = document.getElementById('submit-button');
    const form = document.getElementById('image-form');
    const imageInput = document.getElementById('photo');

    submitButton.addEventListener('click', (e) => {
        e.preventDefault(); // Empêcher la soumission normale du formulaire

        console.log('Bouton "Enregistrer" cliqué'); // Ajouter un log pour le clic sur le bouton

        // Afficher le modal de chargement
        $('#loadingModal').modal('show');

        // Créer un objet FormData à partir du formulaire
        const formData = new FormData(form);

        // Effectuer la requête AJAX sans délai
        $.ajax({
            url: form.action,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (response) => {
                console.log('Requête AJAX réussie :', response);

                // Mettre à jour le message en fonction du résultat
                if (response.success) {
                    // Vider le champ input file
                    imageInput.value = '';

                    // Mettre à jour l'image de profil affichée
                    const imageUrl = '/avatars/' + response.imageName;
                    const profilePic = document.getElementById('profile-pic');
                    const sidebarPic = document.getElementById('sidebar-pic');
                    const profilPic = document.getElementById('ppImg');
                    profilePic.src = imageUrl;
                    sidebarPic.src = imageUrl;
                    profilPic.src = imageUrl;

                    // Mettre à jour le message
                    loadingMessage.innerText = 'Enregistré';
                } else {

                    // Afficher une notification ou traiter l'erreur selon vos besoins
                    console.error('Réponse AJAX avec succès mais avec une erreur :', response);
                    // Mettre à jour le message
                    loadingMessage.innerText = 'Une erreur est survenue';
                }

                // Fermer le modal de chargement après 0.5 secondes
                setTimeout(() => {
                    $('#loadingModal').modal('hide');
                }, 1000);
            },
            error: (xhr, status, error) => {
                imageInput.value = '';
                console.error('Requête AJAX échouée :', error);
                console.error('Statut :', status);
                console.error('Réponse du serveur :', xhr.responseText);

                // Mettre à jour le message
                loadingMessage.innerText = 'Une erreur est survenue';

                // Fermer le modal de chargement après 0.5 secondes
                setTimeout(() => {
                    $('#loadingModal').modal('hide');
                }, 1000);
            }
        });
    });
});


//script pour les information standard
document.addEventListener('DOMContentLoaded', () => {
    const loadingSpinner = document.getElementById('loadingSpinner');
    const loadingMessage = document.getElementById('loadingMessage');
    const submitButton = document.getElementById('infoButton');
    const form = document.getElementById('infoForm');
    const accountInfoName = document.getElementById('account-info-name');
    const ppName = document.getElementById('ppName');
    const ppAdd = document.getElementById('ppAdd');

    submitButton.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('Bouton "Enregistrer" cliqué');

        $('#loadingModal').modal('show');

        setTimeout(() => {
            const formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                    console.log('Requête AJAX réussie :', response);
                    if (response.success) {
                        console.log('Mise à jour des données :', response);
                        console.log('Élément accountInfoName :', accountInfoName);

                        accountInfoName.innerHTML = response.prenoms + ' ' + response.nom;
                        ppName.innerHTML = response.nom + ' ' + response.prenoms;
                        ppAdd.innerHTML = response.adresse + ',' + response.bp;

                        $('#nom').val(response.nom);
                        $('#prenoms').val(response.prenoms);
                        $('#adresse').val(response.adresse);
                        $('#bp').val(response.bp);
                        $('#telephone').val(response.telephone);

                        $('#Modalinfo').modal('hide');
                    } else {
                        console.warn('La réponse ne contient pas de données valides :', response);
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Requête AJAX échouée :', error);
                },
                complete: () => {
                    setTimeout(() => {
                        loadingSpinner.style.display = 'none';
                        loadingMessage.innerText = 'Effectué avec succès';

                        setTimeout(() => {
                            $('#loadingModal').modal('hide');
                            $('#Modalinfo').modal('hide');
                        }, 500);
                    }, 500);
                }
            });
        }, 1000);
    });
});


//lien vers les taches depuis les notifications

$(document).ready(function () {
    $('#relances a').on('click', function (e) {
        e.preventDefault(); // Empêcher le comportement par défaut du lien

        // Changer le contenu principal
        $('.app-content > div').hide(); // Cacher toutes les div
        $('#tasks').show(); // Afficher la div #tasks

        // Changer la classe active
        $('.sidebar-list-item a').removeClass('active'); // Supprimer la classe active de tous les liens
        $('.sidebar-list-item a[data-target="tasks"]').addClass('active'); // Ajouter la classe active au lien #tasks
    });
});


//barre de progression au profil:

document.addEventListener('DOMContentLoaded', () => {
    // Récupérer la valeur actuelle de la barre de progression
    const progressValue = document.getElementById('progressBar').getAttribute('aria-valuenow');

    // Définir la classe CSS en fonction de la valeur actuelle
    let progressClass;
    if (progressValue < 25) {
        progressClass = 'bg-danger';
    } else if (progressValue < 75) {
        progressClass = 'bg-warning';
    } else {
        progressClass = 'bg-success';
    }

    // Appliquer la classe CSS à la barre de progression
    document.getElementById('progressBar').className = `progress-bar ${progressClass}`;
});


//pour charger les info du client dans le modal depuis le dashboard admin
$(document).ready(function () {
    $('#fullscreenModal').on('show.bs.modal', function (event) {
        // Récupérer le bouton qui a déclenché le modal
        var button = $(event.relatedTarget);

        // Récupérer les données du client à partir des attributs de données
        var clientId = button.data('client-id');
        var clientImage = button.data('client-image');
        var datecreateClient = button.data('client-datecreate');
        var clientReason = button.data('client-reason');
        var clientDeclaration = button.data('client-declaration');
        var clientService = button.data('client-service');
        var clientEngagement = button.data('client-engagement');
        var engagSupClient = button.data('engag-sup-client');
        var entrepriseClientDate = button.data('entreprise-client-date');
        var origineClient = button.data('origine-client');
        var clientAssocies = button.data('client-associes');
        var clientRegime = button.data('client-regime');
        var clientName = button.data('client-nom');
        var clientPrenoms = button.data('client-prenoms');
        var procedures = button.data('procedures');
        var taches = button.data('taches');

        // Je met à jour l'image du client
        $('#img-client').attr('src', clientImage);

        // Je met à jour les informations du client
        $('#datecreate-client').text(datecreateClient);
        $('#client-reason').text(clientReason);
        $('#client-declaration').html(clientDeclaration);
        $('#client-service').html(clientService);
        $('#client-engagement').html(clientEngagement);
        $('#engag-sup-client').html(engagSupClient);
        $('#entreprise-client-date').text(entrepriseClientDate);
        $('#origine-client').html(origineClient);
        $('#client-associes').html(clientAssocies);
        $('#client-regime').html(clientRegime);
        $('#client-name').html(clientName + '   ' + clientPrenoms);


        if (typeof procedures === 'object' && typeof taches === 'object') {

            var tableBody = $('#client-table tbody');
            tableBody.empty();

            // Vérifier que les deux tableaux ont la même longueur
            if (procedures.length === taches.length) {
                for (let i = 0; i < procedures.length; i++) {
                    let procedure = procedures[i];
                    let tache = taches[i];
                    let row = $('<tr>');
                    row.append($('<td>').text(tache.nom_tache));
                    row.append($('<td>').html('<a style="text-decoration:none;color:black;" href="' + procedure.doc_client + '" target="_blank"> </a>'));
                    row.append($('<td>').text(procedure.status));
                    row.append($('<td>').html('<button type="button" class="btn btn-secondary btn-action" data-procedure-id="' + procedure.id + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/> <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/> </svg></button>'));
                    tableBody.append(row);
                }
            }
        }

    });
});

//recupere la procedure lié a la tache a completé
document.addEventListener('DOMContentLoaded', function () {
    const openTaskModalButtons = document.querySelectorAll('.open-task-modal');

    openTaskModalButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const procedureId = this.getAttribute('data-procedure-id');
            const procedureIdInput = document.querySelector('#taskForm input[name="tache_id"]');

            procedureIdInput.value = procedureId;
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner le bouton "Save changes"
    const saveChangesButton = document.getElementById('save-changes-btn');

    // Ajouter un écouteur d'événement sur le clic du bouton "Save changes"
    saveChangesButton.addEventListener('click', function () {
        // Récupérer le formulaire et les données du formulaire
        const form = document.querySelector('#taskForm');
        const formData = new FormData(form);


        console.log('Valeur de tache_id :', formData.get('tache_id'));

        // Afficher le loader
        $('#loaderModal').modal('show');

        // Soumettre le formulaire via AJAX sans délai
        $.ajax({
            url: form.action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log('Formulaire soumis avec succès');

                // Fermer les modaux
                $('#taskModal').modal('hide');
                $('#loaderModal').modal('hide');

                // Mettre à jour la page ou effectuer d'autres actions si nécessaire
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Erreur lors de la soumission du formulaire : ', textStatus, errorThrown);
                console.error('Messages d\'erreur : ', jqXHR.responseJSON.errors);

                // Fermer le modal de chargement
                $('#loaderModal').modal('hide');
            }
        });
    });
});

































