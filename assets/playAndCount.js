// include plyr JS
import Plyr from 'plyr';
// create an instance of plyr
const player = new Plyr('#player');
// add a view only if the video is played to completion 
const videoId = document.querySelector('#player').className;
player.on('ended', (event) => {
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
