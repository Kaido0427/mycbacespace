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
        this.querySelector('svg').classList.remove('bi bi-eye-fill');
        this.querySelector('svg').classList.add('bi bi-eye-slash-fill');
    } else {
        input.type = 'password';
        this.querySelector('svg').classList.remove('bi bi-eye-slash-fill');
        this.querySelector('svg').classList.add('bi bi-eye-fill');
    }
});

document.getElementById('newPasswordToggle').addEventListener('click', function () {
    var input = document.getElementById('newPassword');
    if (input.type === 'password') {
        input.type = 'text';
        this.querySelector('svg').classList.remove('bi bi-eye-fill');
        this.querySelector('svg').classList.add('bi bi-eye-slash-fill');
    } else {
        input.type = 'password';
        this.querySelector('svg').classList.remove('bi bi-eye-slash-fill');
        this.querySelector('svg').classList.add('bi bi-eye-fill');
    }
});

document.getElementById('confirmPasswordToggle').addEventListener('click', function () {
    var input = document.getElementById('confirmPassword');
    if (input.type === 'password') {
        input.type = 'text';
        this.querySelector('svg').classList.remove('bi bi-eye-fill');
        this.querySelector('svg').classList.add('bi bi-eye-slash-fill');
    } else {
        input.type = 'password';
        this.querySelector('svg').classList.remove('bi bi-eye-slash-fill');
        this.querySelector('svg').classList.add('bi bi-eye-fill');
    }
});



//la srolbar de app-content dans le dashbord
window.onload = function () {
    var header = document.querySelector('.app-head');
    var headerHeight = header.offsetHeight;
    var appContent = document.querySelector('.app-content');
    appContent.style.height = 'calc(100vh - ' + headerHeight + 'px)';
}


//photo de profil
document.addEventListener('DOMContentLoaded', () => {
    const submitButton = document.getElementById('submit-button');
    const form = document.getElementById('image-form');
    const imageInput = document.getElementById('photo');

    submitButton.addEventListener('click', (e) => {
        e.preventDefault(); // Empêcher la soumission normale du formulaire

        console.log('Bouton "Enregistrer" cliqué'); // Ajouter un log pour le clic sur le bouton

        // Remplacer le contenu du bouton par le SVG de trois points
        submitButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16"><path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/></svg>';

        console.log('SVG de trois points ajouté');

        // Retarder la soumission du formulaire de 2 secondes
        setTimeout(() => {
            // Créer un objet FormData à partir du formulaire
            const formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                    console.log('Requête AJAX réussie :', response);

                    // Rétablir le contenu du bouton "Enregistrer"
                    submitButton.innerHTML = 'Enregistrer';

                    console.log('Contenu du bouton restauré');

                    if (response.success) {
                        // Vider le champ input file
                        imageInput.value = '';

                        // Mettre à jour l'image de profil affichée
                        const imageUrl = '/avatars/' + response.imageName;
                        const profilePic = document.getElementById('profile-pic');
                        const sidebarPic = document.getElementById('sidebar-pic');
                        profilePic.src = imageUrl;
                        sidebarPic.src = imageUrl;

                        // Fermer le modal automatiquement
                        $('#ModalPic').modal('hide');
                    } else {
                        // Afficher une notification ou traiter l'erreur selon vos besoins
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Requête AJAX échouée :', error);

                    // Rétablir le contenu du bouton "Enregistrer"
                    submitButton.innerHTML = 'Enregistrer';

                    // Afficher une notification ou traiter l'erreur selon vos besoins
                }
            });
        }, 2000); // Retarder de 2 secondes
    });
});



















