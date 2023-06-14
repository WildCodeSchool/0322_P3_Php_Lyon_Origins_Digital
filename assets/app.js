/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// include bootstrap JS
require('bootstrap');

(function loadMore() {

    const loadMoreButtons = document.getElementsByClassName('load-more-btn');
    
    for (const loadMoreButton of loadMoreButtons) {
        
        const idName = loadMoreButton.id;
        const firstGroupOfBts = document.getElementsByClassName(idName + '-0');
        const loadMoreBtn = document.getElementById(idName);
        let hiddenBts = document.getElementById(idName+"-bt-gallery").querySelectorAll('.bt-hidden');
        
        for (const bt of firstGroupOfBts) {
            bt.classList.remove('d-none');
            bt.classList.remove('bt-hidden');
            bt.classList.add('bt-container');
        }
        
        
        let idNbr = 1;
        
        loadMoreBtn.addEventListener('click', function () {
            let groupOfBts = document.getElementsByClassName(idName + '-' + idNbr);
            for (const bt of groupOfBts) {
                bt.classList.remove('bt-hidden');
                bt.classList.remove('d-none');
                bt.classList.add('bt-container');
            }
            
            idNbr++;
            
            if (groupOfBts.length == 1) { loadMoreBtn.parentElement.parentElement.remove(); }
            hiddenBts = document.getElementById(idName+"-bt-gallery").querySelectorAll('.bt-hidden');
        })
    }
})();

function addSocialBtn(name, className, offColor = 'light', onColor = 'secondary') {
    
    const icons = document.getElementsByClassName(name);
    const divs = document.getElementsByClassName('bt-'+name);
    
    for (const icon of icons) {
        icon.classList.add('bi-' + className);
    }
    
    for (const div of divs) {
        div.classList.add('text-' + offColor);
        const icon = div.firstElementChild;
        div.addEventListener('click', function () {
            icon.classList.toggle('bi-' + className);
            icon.classList.toggle('bi-' + className + '-fill');
            div.classList.toggle('text-' + offColor);
            div.classList.toggle('text-' + onColor);
        })
    }
}

function addMenuBtn(iconId, fill = true, device = 'desktop', offColor = 'primary', onColor = 'secondary') {
    let icon = document.getElementById(iconId);
    let div = document.getElementById('nav-' + iconId);
    if (device === 'mobile') {
        icon = document.getElementById(iconId + '-mobile');
        div = document.getElementById('nav-' + iconId + '-mobile');
    }
    icon.classList.add('bi-' + iconId);
    div.classList.add('bg-secondary');
    div.classList.add('rounded-pill');
    div.classList.add('p-3');
    div.classList.add('text-' + offColor);
    div.addEventListener('click', function () {
        if (fill) {
            icon.classList.toggle('bi-' + iconId);
            icon.classList.toggle('bi-' + iconId + '-fill');
        }
        div.classList.toggle('text-' + offColor);
        div.classList.toggle('text-' + onColor);
        div.classList.toggle('bg-dark');
    })
}

addSocialBtn('fav', 'heart');
addSocialBtn('watchLater', 'clock');
addSocialBtn('like', 'hand-thumbs-up');

addMenuBtn('house');
addMenuBtn('play');
addMenuBtn('hash', false);
addMenuBtn('house', true, 'mobile');
addMenuBtn('play', true, 'mobile');
addMenuBtn('hash', false, 'mobile');