const inputSearch = document.getElementById('searchVideos');
const searchModal = document.getElementById('videoSearchModal');
const resultVideos = document.getElementById('resultVideos');

inputSearch.addEventListener('input', function(e){
    let search = e.target.value;

    resultVideos.innerHTML = '';
    if (inputSearch.value.length >= 3) {

        fetch('/search-videos/'+ search)
            .then(response => response.text())
            .then(videos => {
                resultVideos.innerHTML = '';
                if (inputSearch.value.length >= 3) {
                    let parser = new DOMParser();
                    let html = parser.parseFromString(videos, 'text/html');
                    let searchResult = html.body;

                    resultVideos.innerHTML = searchResult.innerHTML;
                }
            })
    }

    searchModal.addEventListener('hidden.bs.modal', function(){
        inputSearch.value = '';
    })
})
