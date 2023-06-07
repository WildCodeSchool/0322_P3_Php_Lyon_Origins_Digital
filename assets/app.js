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

function addSocialBtns(icons, divs, className, offColor='light', onColor='secondary'){
    for (let icon of icons){
        icon.classList.add('bi-'+className);
    }

    for (let div of divs){
        div.classList.add('text-'+offColor);
        let icon = div.firstElementChild;
        div.addEventListener('click', function(){
            icon.classList.toggle('bi-'+className);
            icon.classList.toggle('bi-'+className+'-fill');
            div.classList.toggle('text-'+offColor);
            div.classList.toggle('text-'+onColor);
        })
    }
}

addSocialBtns(favIcons, favDivs, 'heart');
addSocialBtns(watchLaterIcons, watchLaterDivs, 'clock');
addSocialBtns(likeIcons, likeDivs, 'hand-thumbs-up');

