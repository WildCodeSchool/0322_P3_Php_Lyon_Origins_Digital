const likes = document.querySelectorAll('.like');

for (const like of likes) {

    const idVid = like.href.substring(like.href.lastIndexOf('/') + 1);

    const likesTrue = document.getElementsByClassName('li' + idVid);

    like.addEventListener('click', function (event) {
        event.preventDefault();

        fetch(like.getAttribute('href'))
            .then(response => {
                if (response.status != 200) alert("Erreur");
            });

        for (const likeTrue of likesTrue) {

            if (likeTrue.classList.contains('bi-hand-thumbs-up-fill')) {
                likeTrue.classList.remove('bi-hand-thumbs-up-fill');
                likeTrue.classList.remove('text-secondary');
                likeTrue.classList.add('bi-hand-thumbs-up');
                likeTrue.classList.add('text-light');
            } else {
                likeTrue.classList.remove('bi-hand-thumbs-up');
                likeTrue.classList.remove('text-light');
                likeTrue.classList.add('bi-hand-thumbs-up-fill');
                likeTrue.classList.add('text-secondary')
            }
        }

    });
}


