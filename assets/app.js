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

//include plyr JS
import Plyr from 'plyr';

// create an instance of plyr
const player = new Plyr('#player');


function addMenuBtn(iconId, fill=true, offColor='light', onColor='secondary'){
    const icon = document.getElementById(iconId);
    const div = document.getElementById('nav-'+iconId);

    icon.classList.add('bi-'+iconId);

    div.classList.add('text-'+offColor);
    div.addEventListener('click', function(){
        if (fill) {
            icon.classList.toggle('bi-'+iconId);
            icon.classList.toggle('bi-'+iconId+'-fill');
        }
        div.classList.toggle('text-'+offColor);
        div.classList.toggle('text-'+onColor);
    })
}

addMenuBtn('house');
addMenuBtn('play');
addMenuBtn('hash', false);