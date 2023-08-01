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

                    resultVideos.innerHTML = videos;
                }
            })
    }

    searchModal.addEventListener('hidden.bs.modal', function(){
        inputSearch.value = '';
    })
})

searchModal.addEventListener('shown.bs.modal', function(){
    inputSearch.focus();
})
