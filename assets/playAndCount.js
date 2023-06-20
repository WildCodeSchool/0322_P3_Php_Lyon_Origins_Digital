//include plyr JS
import Plyr from 'plyr';
// create an instance of plyr
const player = new Plyr('#player');

const playerTriggers = document.querySelectorAll('.plyr__control[data-plyr="play"], .plyr__control--overlaid[data-plyr="play"]');
const videoId = document.querySelector('#player').className;

for (const playerTrigger of playerTriggers) {

    playerTrigger.addEventListener('click', function (event) {
        event.preventDefault();
        fetch(videoId)
            .then(response => {
                if (response.status != 200) alert("impossible de compter cette vue");
            })
            .then(function () {
            })
            .catch(function (error) {
                alert(error);
            });
    });
}



