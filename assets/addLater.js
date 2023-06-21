const laters = document.querySelectorAll('.later');

for (const later of laters) {

    const idVid = later.href.substring(later.href.lastIndexOf('/') + 1);

    const latersTrue = document.getElementsByClassName('la' + idVid);

    later.addEventListener('click', function (event) {
        event.preventDefault();

        fetch(later.getAttribute('href'))
            .then(response => {
                if (response.status != 200) alert("Erreur lors de l'ajout de cette vidéo dans les vidéos à voir plus tard.");
            })
            .then(function () {
                for (const laterTrue of latersTrue) {

                    if (laterTrue.classList.contains('bi-clock-fill')) {
                        laterTrue.classList.remove('bi-clock-fill');
                        laterTrue.classList.remove('text-secondary');
                        laterTrue.classList.add('bi-clock');
                        laterTrue.classList.add('text-light');
                    } else {
                        laterTrue.classList.remove('bi-clock');
                        laterTrue.classList.remove('text-light');
                        laterTrue.classList.add('bi-clock-fill');
                        laterTrue.classList.add('text-secondary')
                    }
                }
            })
            .catch(function (error) {
                alert(error);
            });
    });
}


