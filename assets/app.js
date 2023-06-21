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
        const loadMoreBtn = document.getElementById(idName);
        let hiddenBts = document.getElementById(idName + "-bt-gallery").querySelectorAll('.bt-hidden');

        let idNbr = 1;


        loadMoreBtn.addEventListener('click', function () {
            let groupOfBts = document.getElementsByClassName(idName + '-' + idNbr);
            for (const bt of groupOfBts) {
                bt.classList.remove('bt-hidden');
                bt.classList.remove('d-none');
                bt.classList.add('bt-container');
            }
            

            idNbr++;
            
            hiddenBts = document.getElementById(idName + "-bt-gallery").querySelectorAll('.bt-hidden');

            if (hiddenBts.length < 1) { loadMoreBtn.parentElement.parentElement.remove(); }
        })


        if (hiddenBts.length < 1) { loadMoreBtn.parentElement.parentElement.remove(); }
    }
})();


