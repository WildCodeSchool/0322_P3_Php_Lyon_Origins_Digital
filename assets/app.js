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

//boostrap css alert auto-close
const alert = document.getElementById('alertMsg');
//close the alert after 2 seconds (2000 milliseconds)
setTimeout(() => {
    alert.remove();
}, 2000);

(function loadMore() {

    const loadMoreButtons = document.getElementsByClassName('load-more-btn');


    for (const loadMoreButton of loadMoreButtons) {

        const idName = loadMoreButton.id;
        const gallery = document.getElementById(idName + "-bt-gallery");

        const loadMoreBtn = document.getElementById(idName);

        let firstHiddenBts = gallery.querySelectorAll('.bt-hidden.'+ idName + '-1')
        if (firstHiddenBts.length == 0) { loadMoreBtn.parentElement.parentElement.classList.add('d-none'); }

        let idNbr = 1;

        loadMoreBtn.addEventListener('click', function () {
            let hiddenBts = gallery.querySelectorAll('.bt-hidden.'+ idName + '-' + idNbr)
            if (hiddenBts.length < 1) { loadMoreBtn.parentElement.parentElement.remove(); }
            for (const bt of hiddenBts) {
                bt.classList.remove('bt-hidden');
                bt.classList.remove('d-none');
                bt.classList.add('bt-container');
            }

            idNbr++;

            hiddenBts = gallery.querySelectorAll('.bt-hidden.'+ idName + '-' + idNbr);
            if (hiddenBts.length < 1) { loadMoreBtn.parentElement.parentElement.remove(); }
        })
    }
})();

//gif preview when mouseover Bt
document.querySelectorAll('img.bt-poster').forEach(element => {
    element.addEventListener('mouseenter', function() {
        element.src = element.src.replace(/\.jpg$/, '.gif')
    })
  
    element.addEventListener('mouseleave', function() {
        element.src = element.src.replace(/\.gif$/, '.jpg')
    })
})
