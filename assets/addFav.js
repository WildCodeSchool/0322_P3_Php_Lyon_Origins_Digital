const favs = document.querySelectorAll('.favorite');

for (const fav of favs) {

    const idVid = fav.href.substring(fav.href.lastIndexOf('/') + 1);

    const favTrue = document.getElementById(idVid);

    fav.addEventListener('click', function (event) {
        event.preventDefault();

        fetch(fav.getAttribute('href'))
            .then(response => {
                if (response.status != 200) alert("Erreur");
            });

        if (favTrue.classList.contains('bi-heart-fill')) {
            favTrue.classList.remove('bi-heart-fill');
            favTrue.classList.remove('text-secondary');
            favTrue.classList.add('bi-heart');
            favTrue.classList.add('text-light');
        } else {
            favTrue.classList.remove('bi-heart');
            favTrue.classList.remove('text-light');
            favTrue.classList.add('bi-heart-fill');
            favTrue.classList.add('text-secondary')
        }

    });
}


