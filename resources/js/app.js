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


//Script pour l'affichage des app_content en fonction d'un element de la sidebar

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
    });
});


//script pour ouvrir et fermer la sidebar
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner l'élément actif dans la sidebar
    var activeItem = document.querySelector('.sidebar-list-item.active a');

    // Sélectionner l'élément de contenu correspondant à l'élément actif dans la sidebar
    var activeContent = document.querySelector('#' + activeItem.dataset.target);

    // Afficher l'élément de contenu correspondant à l'élément actif dans la sidebar
    activeContent.style.display = 'block';

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





