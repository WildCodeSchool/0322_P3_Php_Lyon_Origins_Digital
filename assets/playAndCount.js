// include plyr JS
import Plyr from 'plyr';
// create an instance of plyr
const player = new Plyr('#player');
// add a view only if the video is played to completion 
const element = document.getElementById('player');
const videoId = element.getAttribute("data-info");
player.on('ended', (event) => {
    event.preventDefault();
    fetch(videoId)
        .then(response => {
            if (response.status != 200) alert("impossible de compter cette vue");
        })
        .catch(function (error) {
            alert(error);
        });
});
