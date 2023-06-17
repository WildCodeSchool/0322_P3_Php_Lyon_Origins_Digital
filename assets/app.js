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

function addSocialBtn(name, className, offColor = 'light', onColor = 'secondary') {


    const icons = document.getElementsByClassName(name);
    const divs = document.getElementsByClassName('bt-' + name);

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

addSocialBtn('fav', 'heart');
addSocialBtn('watchLater', 'clock');
addSocialBtn('like', 'hand-thumbs-up');