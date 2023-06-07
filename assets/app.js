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

function loadMore(idName, btnId)
{
    const firstPart = document.getElementById('0-'+idName);
    const loadMoreBtn = document.getElementById(btnId);
    firstPart.classList.remove('d-none');
    let idNbr = 1;
    
    loadMoreBtn.addEventListener('click', function() {
        let part = document.getElementById( idNbr+'-'+idName);
        part.classList.remove('d-none');
        idNbr++;
    })
}

loadMore('latest', 'load-more-latest');