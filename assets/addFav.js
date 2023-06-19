const fav = document.querySelectorAll('.favorite');

fav.addEventListener('click', function (event) {
    event.preventDefault();

    fetch(fav.getAttribute('href'))
        .then(response => {
            if (response.status != 200) alert("Erreur");

        })
    ;
});
