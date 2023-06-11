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

const favIcons = document.getElementsByClassName('fav');
const watchLaterIcons = document.getElementsByClassName('watchLater');
const likeIcons = document.getElementsByClassName('like');
const favDivs = document.getElementsByClassName('bt-fav');
const watchLaterDivs = document.getElementsByClassName('bt-watchlater');
const likeDivs = document.getElementsByClassName('bt-like');

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

function addSocialBtns(icons, divs, className, offColor = 'light', onColor = 'secondary') {
    for (let icon of icons) {
        icon.classList.add('bi-' + className);
    }

    for (let div of divs) {
        div.classList.add('text-' + offColor);
        let icon = div.firstElementChild;
        div.addEventListener('click', function () {
            icon.classList.toggle('bi-' + className);
            icon.classList.toggle('bi-' + className + '-fill');
            div.classList.toggle('text-' + offColor);
            div.classList.toggle('text-' + onColor);
        })
    }
}

function loadMore() {

    const loadMoreButtons = document.getElementsByClassName('load-more-btn');
    
    for (const loadMoreButton of loadMoreButtons) {
        
        const idName = loadMoreButton.id;
        const firstParts = document.getElementsByClassName('0-' + idName);
        const loadMoreBtn = document.getElementById('load-more-'+idName);
        
        for (const firstPart of firstParts) {
            firstPart.classList.remove('d-none');
        }
        let idNbr = 1;
    
        loadMoreBtn.addEventListener('click', function () {
            let parts = document.getElementsByClassName(idNbr + '-' + idName);
            for (const part of parts) {
                part.classList.remove('d-none');
            }
    
            idNbr++;
        })
    }

}


loadMore();

addSocialBtns(favIcons, favDivs, 'heart');
addSocialBtns(watchLaterIcons, watchLaterDivs, 'clock');
addSocialBtns(likeIcons, likeDivs, 'hand-thumbs-up');

addMenuBtn('house');
addMenuBtn('play');
addMenuBtn('hash', false);
addMenuBtn('house', true, 'mobile');
addMenuBtn('play', true, 'mobile');
addMenuBtn('hash', false, 'mobile');
