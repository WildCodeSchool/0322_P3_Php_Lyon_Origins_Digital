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

const favIcon = document.getElementById('fav-icon');
const favDiv = document.getElementById('fav-div');
favIcon.classList.add('bi-heart');
favDiv.classList.add('text-light');

favDiv.addEventListener('click', function(){
    favIcon.classList.toggle('bi-heart');
    favIcon.classList.toggle('bi-heart-fill');
    favDiv.classList.toggle('text-light');
    favDiv.classList.toggle('text-secondary');
})

const watchLaterIcon = document.getElementById('watchLater-icon');
const watchLaterDiv = document.getElementById('watchLater-div');
watchLaterIcon.classList.add('bi-clock');
watchLaterDiv.classList.add('text-light');

watchLaterDiv.addEventListener('click', function(){
    watchLaterIcon.classList.toggle('bi-clock');
    watchLaterIcon.classList.toggle('bi-clock-fill');
    watchLaterDiv.classList.toggle('text-light');
    watchLaterDiv.classList.toggle('text-secondary');
})

const likeIcon = document.getElementById('like-icon');
const likeDiv = document.getElementById('like-div');
likeIcon.classList.add('bi-hand-thumbs-up');
likeDiv.classList.add('text-light');

likeDiv.addEventListener('click', function(){
    likeIcon.classList.toggle('bi-hand-thumbs-up');
    likeIcon.classList.toggle('bi-hand-thumbs-up-fill');
    likeDiv.classList.toggle('text-light');
    likeDiv.classList.toggle('text-secondary');
})

