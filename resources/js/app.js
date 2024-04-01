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


document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'identifiant de l'onglet actif depuis sessionStorage
    var activeTab = sessionStorage.getItem('activeTab');

    // Sélectionner l'élément actif dans la sidebar
    var activeItem = document.querySelector(`a[data-target="${activeTab}"]`);

    // Supprimer la classe 'active' de tous les items
    document.querySelectorAll('.sidebar-list-item').forEach(item => {
        item.classList.remove('active');
    });

    // Ajouter la classe 'active' à l'élément actif dans la sidebar
    if (activeItem) {
        activeItem.parentNode.classList.add('active');

        // Sélectionner l'élément de contenu correspondant à l'élément actif dans la sidebar
        var activeContent = document.querySelector('#' + activeTab);

        // Afficher l'élément de contenu correspondant à l'élément actif dans la sidebar
        activeContent.style.display = 'block';
    } else {
        // Si aucun élément actif n'est trouvé, sélectionner le premier élément de la sidebar
        var firstItem = document.querySelector('.sidebar-list-item:first-child');
        if (firstItem) {
            firstItem.classList.add('active');

            // Sélectionner l'élément de contenu correspondant au premier élément de la sidebar
            var firstContent = document.querySelector('#' + firstItem.querySelector('a').getAttribute('data-target'));

            // Afficher l'élément de contenu correspondant au premier élément de la sidebar
            firstContent.style.display = 'block';
        }
    }

    // Ajouter l'écouteur d'événement sur le bouton de menu
    document.querySelector('#menu-toggle').addEventListener('click', event => {
        let sidebar = document.querySelector('#sidebar');
        let accountInfo = document.querySelector('.account-info');
        if (window.innerWidth > 768) { // Si l'écran est suffisamment grand
            sidebar.classList.toggle('collapsed'); // Basculer entre le style normal et le style partiellement fermé
            if (sidebar.classList.contains('collapsed')) { // Si la sidebar est partiellement fermée
                accountInfo.querySelector('.account-info-name').style.display = 'none'; // Masquer le nom dans la section account-info
            } else { // Sinon
                accountInfo.querySelector('.account-info-name').style.display = 'block'; // Afficher le nom dans la section account-info
            }
        } else { // Sinon
            sidebar.classList.toggle('active'); // Afficher/masquer la sidebar
        }
    });
});

// Ajouter un écouteur d'événement sur chaque lien de la sidebar
document.querySelectorAll('.sidebar-list-item a').forEach(item => {
    item.addEventListener('click', event => {
        event.preventDefault();
        let target = event.currentTarget.getAttribute('data-target');

        // Supprimer la classe 'active' de tous les items
        document.querySelectorAll('.sidebar-list-item').forEach(item => {
            item.classList.remove('active');
        });

        // Ajouter la classe 'active' à l'item cliqué
        event.currentTarget.parentNode.classList.add('active');

        // Afficher la section correspondante
        document.querySelectorAll('.app-content > div').forEach(section => {
            section.style.display = 'none';
            if (section.getAttribute('id') === target) {
                section.style.display = 'block';
            }
        });

        // Stocker l'identifiant de l'onglet actif dans sessionStorage
        sessionStorage.setItem('activeTab', target);
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
                    profilePic.src = imageUrl;
                    sidebarPic.src = imageUrl;

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



























