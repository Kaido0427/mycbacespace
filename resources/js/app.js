import './bootstrap';
import '../scss/app.scss';
import moment from 'moment';



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


//pour changer le theme de couleur :
$(document).ready(function () {
    var $modeSwitch = $('.mode-switch');
    var $moonIcon = $modeSwitch.find('.sun');
    var $sunIcon = $modeSwitch.find('.moon');

    // Fonction de changement de thème
    function toggleTheme() {
        $('html').toggleClass('light');
        $modeSwitch.toggleClass('active');

        // Enregistrer le thème dans le localStorage
        if ($('html').hasClass('light')) {
            localStorage.setItem('theme', 'light');
        } else {
            localStorage.setItem('theme', 'dark');
        }

        // Afficher le soleil ou la lune en fonction du thème
        if ($('html').hasClass('light')) {
            $moonIcon.css('opacity', 0);
            $sunIcon.css('opacity', 1);
        } else {
            $moonIcon.css('opacity', 1);
            $sunIcon.css('opacity', 0);
        }
    }

    // Ajouter un écouteur d'événement pour le clic sur le bouton de changement de thème
    $modeSwitch.on('click', toggleTheme);

    // Vérifier si un thème est enregistré dans le localStorage et l'appliquer
    var savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'light') {
        $('html').addClass('light');
        $modeSwitch.addClass('active');
        $moonIcon.css('opacity', 0);
        $sunIcon.css('opacity', 1);
    } else if (savedTheme === 'dark') {
        $('html').removeClass('light');
        $modeSwitch.removeClass('active');
        $moonIcon.css('opacity', 1);
        $sunIcon.css('opacity', 0);
    }

    // Afficher l'icône appropriée une fois que le JavaScript est chargé
    setTimeout(function () {
        if ($('html').hasClass('light')) {
            $moonIcon.css('opacity', 0);
            $sunIcon.css('opacity', 1);
        } else {
            $moonIcon.css('opacity', 1);
            $sunIcon.css('opacity', 0);
        }
    }, 0);
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

                    // Fermer le modal de chargement après 0.5 secondes
                    setTimeout(() => {
                        $('#loadingModal').modal('hide');
                    }, 500);
                    imageInput.value = '';

                    // Mettre à jour l'image de profil affichée
                    const imageUrl = '/avatars/' + response.imageName;
                    const profilePic = document.getElementById('profile-pic');
                    const sidebarPic = document.getElementById('sidebar-pic');
                    const profilPic = document.getElementById('ppImg');
                    profilePic.src = imageUrl;
                    sidebarPic.src = imageUrl;
                    profilPic.src = imageUrl;


                } else {

                    // Afficher une notification ou traiter l'erreur selon vos besoins
                    console.error('Réponse AJAX avec succès mais avec une erreur :', response);

                }


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
    var procedures;
    var taches;

    function updateFullscreenModal(event) {
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
        procedures = button.data('procedures');
        taches = button.data('taches');

        // Mettre à jour l'image et les informations du client
        $('#img-client').attr('src', clientImage);
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

            if (procedures.length === taches.length) {
                for (var i = 0; i < procedures.length; i++) {
                    var procedure = procedures[i];
                    var tache = taches[i];

                    var row = $('<tr>');
                    var tdDownload = $('<td>');
                    var tdStatus = $('<td>').attr('id', 'status-' + tache.id);
                    var tdButton = $('<td>').attr('id', 'button-' + tache.id);

                    // Ajouter la cellule pour le nom de la tâche (avec ou sans lien)
                    if (procedure.doc_client) {
                        var downloadLink = $('<a>').attr('href', '/document_clients/' + procedure.doc_client).attr('target', '_blank').text(tache.nom_tache);
                        tdDownload.append(downloadLink);
                    } else {
                        tdDownload.text(tache.nom_tache);
                    }
                    row.append(tdDownload);

                    // Ajouter la cellule pour le statut
                    tdStatus.text(' ' + procedure.status);

                    tdStatus.removeClass('btn-danger btn-warning btn-success');
                    if (procedure.doc_client === null) {
                        tdStatus.addClass('btn btn-danger');
                    } else if (procedure.doc_traité) {
                        tdStatus.addClass('btn btn-success');
                    } else {
                        tdStatus.addClass('btn btn-warning');
                    }

                    row.append(tdStatus);

                    // Ajouter la cellule pour le bouton "Traiter" (uniquement si le statut est "Soumis")
                    if (procedure.status === 'Soumis') {
                        var statusButton = $('<button>').attr('type', 'button').attr('data-bs-toggle', 'modal').attr('data-bs-target', '#treatModal').attr('data-tache-id', tache.id).addClass('btn btn-primary open-treat-modal').text('Traiter');
                        tdButton.append(statusButton);
                    }

                    row.append(tdButton);
                    tableBody.append(row);
                }
            }

            // Écouter les clics sur les boutons "open-treat-modal"
            const openTaskModalButtons = document.getElementsByClassName('open-treat-modal');

            for (let i = 0; i < openTaskModalButtons.length; i++) {
                openTaskModalButtons[i].addEventListener('click', function () {
                    const procedureId = this.getAttribute('data-tache-id');
                    const procedureIdInput = document.querySelector('#treatForm input[name="tache_id"]');
                    procedureIdInput.value = procedureId;
                });
            }
        }
    }

    $('#fullscreenModal').on('show.bs.modal', updateFullscreenModal);

    const saveChangesButton = document.getElementById('treat-btn');

    saveChangesButton.addEventListener('click', function () {
        const form = document.querySelector('#treatForm');
        const formData = new FormData(form);

        $('#treatModal').modal('hide');
        $('#loadModal').modal('show');

        $.ajax({
            url: form.action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log('Formulaire soumis avec succès');
                console.log('Données de la réponse :', response);

                setTimeout(function () {
                    $('#loadModal').modal('hide');
                }, 1000);

                procedures = response.procedures;
                taches = response.taches;

                // Loop through the tasks and update the corresponding status cells
                for (var i = 0; i < taches.length; i++) {
                    var tache = taches[i];
                    var procedure = procedures.find(function (proc) {
                        return proc.tache_id === tache.id;
                    });
                    var statusCell = $('#status-' + tache.id);

                    // Store the cell's content in a const variable
                    const statusContent = statusCell.text().trim();

                    // Update the content of the cell
                    statusCell.text(' ' + procedure.status);

                    // Update the class of the cell
                    statusCell.removeClass('btn-danger btn-warning btn-success');
                    if (procedure.doc_client === null) {
                        statusCell.addClass('btn btn-danger');
                    } else if (procedure.doc_traité) {
                        statusCell.addClass('btn btn-success');
                    } else {
                        statusCell.addClass('btn btn-warning');
                    }
                }
            },

            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Erreur lors de la soumission du formulaire : ', textStatus, errorThrown);
                console.error('Messages d\'erreur : ', jqXHR.responseJSON.errors);

                $('#loadModal').modal('hide');
            }
        });
    });
});


//recupere la procedure lié a la tache a completé et la soumisson du doc coté client
document.addEventListener('DOMContentLoaded', function () {
    const openTaskModalButtons = document.querySelectorAll('.open-task-modal');
    const saveChangesButton = document.getElementById('save-changes-btn');
    const taskForm = document.getElementById('taskForm');

    openTaskModalButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            console.log('Bouton "Modifier le fichier" ou "Soumettre" cliqué');
            const procedureId = this.getAttribute('data-procedure-id');
            console.log('ID de la procédure :', procedureId);
            const procedureIdInput = document.getElementById('taskForm').querySelector('input[name="tache_id"]');
            procedureIdInput.value = procedureId;
        });
    });

    saveChangesButton.addEventListener('click', function () {
        const form = document.querySelector('#taskForm');
        const formData = new FormData(form);

        console.log('Valeur de tache_id :', formData.get('tache_id'));

        $('#taskModal').modal('hide');
        $('#loaderModal').modal('show');

        $.ajax({
            url: form.action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log('Formulaire soumis avec succès');

                // Génère le HTML pour les boutons de la tâche
                const generateTaskButtons = function (tacheId, procedure) {
                    let buttonsHtml = '';

                    if (procedure) {
                        if (procedure.doc_traité) {
                            buttonsHtml = `
                                    <a href="${procedure.doc_client}" class="btn btn-success" download>
                                        Télécharger le fichier traité
                                    </a>
                                `;
                        } else {
                            buttonsHtml = `
                                    <button type="button" class="btn btn-warning open-task-modal"
                                        data-bs-toggle="modal" data-bs-target="#taskModal"
                                        data-procedure-id="${procedure.id}">
                                        Modifier le fichier
                                    </button>
                                `;
                        }
                    } else {
                        buttonsHtml = `
                                <button type="button" class="btn btn-primary open-task-modal"
                                    data-bs-toggle="modal" data-bs-target="#taskModal"
                                    data-procedure-id="${tacheId}">
                                    Soumettre
                                </button>
                            `;
                    }

                    return buttonsHtml;
                };

                // Génère le HTML pour les fichiers de la tâche
                const generateTaskFiles = function (fileUrl) {
                    let fileHtml = '';

                    if (fileUrl) {
                        const extension = fileUrl.split('.').pop();

                        if (extension === 'pdf') {
                            fileHtml = `
                                    <div class="mt-3" style="width: 100%;">
                                        <embed id="taskFiles" src="${fileUrl}" type="application/pdf" width="100%" height="150px">
                                    </div>
                                `;
                        } else {
                            fileHtml = `
                                    <div class="mt-3" style="width: 100%;">
                                        <a href="#" target="_blank">
                                            <img style="object-fit: cover" src="/dist/word-logo.webp" alt="Word document" width="100%" height="150px">
                                        </a>
                                    </div>
                                `;
                        }
                    }

                    return fileHtml;
                };

                // Génère le nouveau contenu HTML pour la tâche
                const updatedTaskHtml = `
                        <div class="card-header d-flex">
                            <h5 class="card-title">${response.tache.nom_tache}</h5>
                            <div class="ms-auto">
                                ${generateTaskButtons(response.tache.id, response.procedure)}
                            </div>
                        </div>
                        <div class="card-body">
                            ${response.tache.description}
                            ${generateTaskFiles(response.file_url)}
                        </div>
                    `;

                // Mets à jour le contenu de la tâche
                const updateTaskContent = function (taskId, newContent) {
                    const taskElement = document.getElementById(`task-${taskId}`);
                    taskElement.innerHTML = newContent;
                };

                updateTaskContent(response.tache.id, updatedTaskHtml);

                // Fermer le loader après 1500 ms
                setTimeout(function () {
                    $('#loaderModal').modal('hide');
                }, 1500);
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



//les relances coté admin

$(document).ready(function () {
    $('#relances').on('click', '#relance-button', function (e) {
        e.preventDefault();

        console.log('Bouton Relancer cliqué');

        var tacheId = $(this).data('tache-id');
        var tacheTable = '#tache-table-' + tacheId;
        var route = $(this).data('route');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                'tache_id': tacheId,
            },
            beforeSend: function () {
                console.log('Requête AJAX en cours d\'envoi');
                // Afficher le loader
                $('#chargeModal').modal('show');
            },
            success: function (response) {
                console.log('Requête AJAX réussie');
                console.log('Réponse :', response);

                if (response.success) {
                    console.log('Relance effectuée avec succès');

                    // Cacher le loader après 1 seconde
                    setTimeout(function () {
                        console.log('Loader caché');
                        $('#chargeModal').modal('hide');
                    }, 1000);

                    // Afficher un message de succès ou effectuer une action
                } else {
                    console.log('La relance a échoué');
                }
            },
            error: function (error) {
                console.log('Erreur lors de la requête AJAX');
                console.log('Erreur :', error);
                // Cacher le loader
                $('#chargeModal').modal('hide');
            }
        });
    });
});


///Le tableau qui listes les clients
let table = new DataTable('#clients-table')



//labarre de progression sur chez le client

$(document).ready(function () {
    updateProgressBar();
});

function updateProgressBar() {
    $.ajax({
        url: '/tasks',
        type: 'GET',
        dataType: 'json',
        success: function (procedures) {
            const totalProcedures = procedures.length;
            const proceduresTerminees = procedures.filter(procedure => procedure.doc_traité !== null).length;
            const progression = (proceduresTerminees / totalProcedures) * 100;

            const progressBar = $('#progressbar');
            if (totalProcedures === 0) {
                progressBar.css('width', '0%');
            } else {
                const progressionStep = 100 / totalProcedures;
                progressBar.css('width', `${progressionStep * proceduresTerminees}%`);
            }
            progressBar.attr('aria-valuenow', progression);
        },
        error: function (error) {
            console.error(error);
        }
    });
}


//a la page de connexion pour le champs password










































