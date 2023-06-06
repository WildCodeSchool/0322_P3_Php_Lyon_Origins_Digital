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

for (const favIcon of favIcons) {
    favIcon.classList.add('bi-heart');
}

for (const favDiv of favDivs) {
    favDiv.classList.add('text-light');
    let favIcon = favDiv.firstElementChild;
    favDiv.addEventListener('click', function(){
        favIcon.classList.toggle('bi-heart');
        favIcon.classList.toggle('bi-heart-fill');
        favDiv.classList.toggle('text-light');
        favDiv.classList.toggle('text-secondary');
    })
}

for (const watchLaterIcon of watchLaterIcons) {
    watchLaterIcon.classList.add('bi-clock');
}

for (const watchLaterDiv of watchLaterDivs) {
    watchLaterDiv.classList.add('text-light');
    let watchLaterIcon = watchLaterDiv.firstElementChild;
    watchLaterDiv.addEventListener('click', function(){
        watchLaterIcon.classList.toggle('bi-clock');
        watchLaterIcon.classList.toggle('bi-clock-fill');
        watchLaterDiv.classList.toggle('text-light');
        watchLaterDiv.classList.toggle('text-secondary');
    })
}

for (const likeIcon of likeIcons) {
    likeIcon.classList.add('bi-hand-thumbs-up');
}

for (const likeDiv of likeDivs) {
    likeDiv.classList.add('text-light');
    let likeIcon = likeDiv.firstElementChild;
    likeDiv.addEventListener('click', function(){
        likeIcon.classList.toggle('bi-hand-thumbs-up');
        likeIcon.classList.toggle('bi-hand-thumbs-up-fill');
        likeDiv.classList.toggle('text-light');
        likeDiv.classList.toggle('text-secondary');
    })
}

