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

(function addSocialBtn(offColor = 'light', onColor = 'secondary') {

    const icons = document.getElementsByClassName('bt-fav');
    
    for (const icon of icons) {
        icon.classList.add('bi-heart')
        icon.classList.add('text-' + offColor);
        icon.addEventListener('click', function () {
            icon.classList.toggle('bi-heart');
            icon.classList.toggle('bi-heart-fill');
            icon.classList.toggle('text-' + offColor);
            icon.classList.toggle('text-' + onColor);
        })
    }
})();

(function ShowDescriptionOnMobile() {
    let description = document.getElementById('sh-description');
    const descriptionFull = document.getElementById('sh-description').innerText;
    let maxOnMobile = 100;
    let descriptionShort = '';
    
    addEventListener('resize', () => {

        if (window.screen.width <= 576) {
            
            if (description.innerText.length > maxOnMobile) {

                descriptionShort = description.innerText.slice(0, maxOnMobile) + '...';
                description.innerText = descriptionShort;
            } else {
                description.innerText = descriptionFull;
            }

            description.addEventListener('click', function () {
                if (description.innerText == descriptionShort) {
                    description.innerText = descriptionFull;
                } else if (description.innerText == descriptionFull) {
                    description.innerText = descriptionShort;
                }
            })
            
        } else {
            description.innerText = descriptionFull;
        }
    })
})();

