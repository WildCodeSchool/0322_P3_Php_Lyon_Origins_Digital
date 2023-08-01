const favs = document.querySelectorAll('.favorite');

for (const fav of favs) {

    const idVid = fav.href.substring(fav.href.lastIndexOf('/') + 1);

    const favsTrue = document.getElementsByClassName('fa' + idVid);

    fav.addEventListener('click', function (event) {
        event.preventDefault();

        fetch(fav.getAttribute('href'))
            .then(response => {
                if (response.status != 200) alert("Erreur lors de l'ajout de cette vidéo dans les favoris.");
            })
            .then(function () {
                for (const favTrue of favsTrue) {

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
                }
            })
            .catch(function (error) {
                alert(error);
            });
    });
}


