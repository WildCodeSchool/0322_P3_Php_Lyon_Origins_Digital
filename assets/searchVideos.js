const inputSearch = document.getElementById('searchVideos');
const searchModal = document.getElementById('videoSearchModal');
// initié var de l'ul des resultats
const resultVideos = document.getElementById('resultVideos');

inputSearch.addEventListener('input', function(e){
    let search = e.target.value;
    // vider les resutat
    resultVideos.innerHTML = '';

    console.log(search)

    // if(search == '') checker si il y a plus de 3 char
    if (search.length >= 3) {

fetch('/search-videos/'+ search)
.then(response => response.text())
.then(videos => {

                let parser = new DOMParser();
                let html = parser.parseFromString(videos, 'text/html');
                let searchResult = html.body;

                resultVideos.innerHTML = searchResult.innerHTML;
            })
        }

    searchModal.addEventListener('hidden.bs.modal', function(){
        inputSearch.value = '';
    })
})
