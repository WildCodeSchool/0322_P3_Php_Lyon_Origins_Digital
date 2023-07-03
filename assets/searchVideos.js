const inputSearch = document.getElementById('searchVideos');
const searchModal = document.getElementById('videoSearchModal');

inputSearch.addEventListener('input', function(e){
    let search = e.target.value;

    fetch('/search-videos/'+ search)
        .then(response => response.json())
        .then(videos => {
            const resultVideos = document.getElementById('resultVideos');
            const resultInfo = document.getElementById('resultInfo');
            const checkUser = document.getElementById('modalUser');

            resultVideos.innerHTML = '';

            resultInfo.innerHTML = videos.length + " resultats correspondants à votre recherche."

            for (const video of videos) {

                const poster = require("/assets/images/" + video.posterUrl);

                resultVideos.innerHTML +=
                "<li class='rounded-4 my-2 py-3 bg-secondary border border-3 border-primary list-group-item'>"
                    + "<a class='link-underline link-underline-opacity-0' href='/video/show/"+ video.id + "'>"
                        + "<div class='row'>"
                            + `<img src="${poster}" class="col-6 img-fluid rounded-4"/>`
                            + "<div class='col-6 d-flex flex-column align-items-start justify-content-center'>"
                                + "<h5 class='resultVideos-title title-font text-primary text-decoration-none'>" + video.title + "</h5>"
                                + "<div class='resultVideos-tag tag-item bg-primary rounded-3 p-2 d-flex justify-content-center align-items-center m-1'>"
                                    + "<h2 class='m-0 tag-list text-secondary'>#" + video.tag + "</h2>"
                                + "</div>"
                            + "</div>"
                        + "</div>"
                    + "</a>"
                + "</li>"
            }
        })
})

searchModal.addEventListener('hidden.bs.modal', function(){
    inputSearch.value = '';
})
