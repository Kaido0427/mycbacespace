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
                for (var i = 0; i < procedures.length; i++) {
                    var procedure = procedures[i];
                    var tache = taches[i];

                    var row = $('<tr>');
                    row.append($('<td>').html('<a style="text-decoration:none;color:black;"  href="/document_clients/' + procedure.doc_client + '" target="_blank">' + tache.nom_tache + ' <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16"><path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/></svg></a>'));

                    var tdStatus = $('<td>');
                    var tdButton = $('<td>');

                    var statusButton;
                    if (procedure.status === 'soumis') {
                        statusButton = $('<button type="button" class="btn btn-primary open-treat-modal" data-bs-toggle="modal" data-bs-target="#treatModal" data-tache-id="' + tache.id + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0z"/> </svg></button>');
                    }

                    var statusText = $('<span>').text(' ' + procedure.status);

                    if (procedure.doc_client === null) {
                        tdStatus.addClass('btn btn-danger');
                    } else if (procedure.doc_traité) {
                        tdStatus.addClass('btn btn-success');
                    } else {
                        tdStatus.addClass('btn btn-warning');
                    }

                    tdStatus.append(statusText);

                    if (statusButton) {
                        tdButton.append(statusButton);
                    }

                    if (tdStatus.hasClass('btn btn-warning')) {
                        var treatModalButton = $('<button type="button" class="btn btn-primary open-treat-modal ml-2" data-bs-toggle="modal" data-bs-target="#treatModal" data-tache-id="' + tache.id + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0z"/> </svg></button>');
                        tdButton.append(' ');
                        tdButton.append(treatModalButton);
                    }

                    row.append(tdStatus);
                    row.append(tdButton);
                    tableBody.append(row);
                }
            }
            // Écouter les clics sur les boutons "open-treat-modal"
            const openTaskModalButtons = document.getElementsByClassName('open-treat-modal');
            console.log('Nombre de boutons :', openTaskModalButtons.length);

            for (let i = 0; i < openTaskModalButtons.length; i++) {
                openTaskModalButtons[i].addEventListener('click', function () {
                    console.log('Bouton cliqué');
                    const procedureId = this.getAttribute('data-tache-id');
                    console.log('Valeur de procedureId :', procedureId);
                    const procedureIdInput = document.querySelector('#treatForm input[name="tache_id"]');

                    procedureIdInput.value = procedureId;
                });
            }
        }
    });

    // Sélectionner le bouton "Save changes"
    const saveChangesButton = document.getElementById('treat-btn');

    // Ajouter un écouteur d'événement sur le clic du bouton "Save changes"
    saveChangesButton.addEventListener('click', function () {
        // Récupérer le formulaire et les données du formulaire
        const form = document.querySelector('#treatForm');
        const formData = new FormData(form);

        console.log('Valeur de tache_id :', formData.get('tache_id'));

        // Afficher le loader
        $('#treatModal').modal('hide');
        $('#loadModal').modal('show');

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
                $('#loadeModal').modal('hide');

                // Récupérer la procédure mise à jour
                var updatedProcedure = response.procedure;

                // Mettre à jour la ligne correspondante dans le tableau
                var tableBody = $('#client-table tbody');
                var tableRow = tableBody.find('tr[data-tache-id="' + updatedProcedure.tache_id + '"]');

                // Mettre à jour les cellules de la ligne
                var tdStatus = tableRow.find('td:nth-child(2)');
                var tdButton = tableRow.find('td:nth-child(3)');

                // Mettre à jour le statut
                tdStatus.removeClass('btn-danger btn-warning btn-success');
                if (updatedProcedure.doc_client === null) {
                    tdStatus.addClass('btn btn-danger');
                } else if (updatedProcedure.doc_traité) {
                    tdStatus.addClass('btn btn-success');
                } else {
                    tdStatus.addClass('btn btn-warning');
                }
                tdStatus.text(' ' + updatedProcedure.status);

                // Mettre à jour le bouton
                tdButton.empty();
                if (updatedProcedure.status === 'Soumis') {
                    var statusButton = $('<button type="button" class="btn btn-primary open-treat-modal" data-bs-toggle="modal" data-bs-target="#treatModal" data-tache-id="' + updatedProcedure.tache_id + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0z"/> </svg></button>');
                    tdButton.append(statusButton);
                }

                // Ajouter une nouvelle cellule pour le lien de téléchargement
                var tdDownload = $('<td>');
                var downloadLink = $('<a style="text-decoration:none;color:black;"  href="/document_clients/' + updatedProcedure.doc_client + '" target="_blank">' + updatedProcedure.tache.nom_tache + ' <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16"><path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/></svg></a>');
                tdDownload.append(downloadLink);
                tableRow.prepend(tdDownload);
            },

            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Erreur lors de la soumission du formulaire : ', textStatus, errorThrown);
                console.error('Messages d\'erreur : ', jqXHR.responseJSON.errors);

                // Fermer le modal de chargement
                $('#loadeModal').modal('hide');
            }
        });
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


//effectuer une tache coté client
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
        $('#taskModal').modal('hide');
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

                const docs = response.file_url;
                const fileView = document.getElementById('taskFiles');

                fileView.src = docs;

                // Fermer les modaux
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


//pour notifier 

$(document).ready(function () {
    function sendRelanceNotifications() {
        $.ajax({
            url: '{{ route("tasks.relance") }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response.message);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            }
        });
    }

    $('#relance-button').click(function () {
        sendRelanceNotifications();
    });
});































