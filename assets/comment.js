const addComment = document.getElementById('add-comment');
const form = document.getElementById('comment-field');
const commentBlock = document.getElementById('comment');
const writeBlock = commentBlock.children[0];
const writeField = writeBlock.firstElementChild;
const postBlock = commentBlock.children[1];
const postButton = postBlock.firstElementChild;
const noCommentFound = document.getElementById('no-comment-found');

addComment.addEventListener('click', function(){
    form.classList.remove('d-none');
})

if (noCommentFound) {
    noCommentFound.addEventListener('click', function(){
        form.classList.remove('d-none');
        noCommentFound.classList.add('d-none');
    })
}

commentBlock.classList.add('row');

writeBlock.classList.add('col-10');

writeField.innerText = 'Ajoute ton commentaire';
writeField.classList.add('text-secondary');
writeField.classList.add('text-font');

postBlock.classList.add('col-2');
postBlock.classList.add('d-flex');
postBlock.classList.add('justify-content-end');
postBlock.classList.add('align-items-end');

// -------------------------------------------------
// 1. ajax controller
// 2. ajax route in btn href
// 3. js fetch

const commentSave = document.getElementById('comment_save');


commentSave.addEventListener('click', function (event) {
    event.preventDefault();

    fetch(commentSave.getAttribute('href'))
    .then(response => {
        if(response.status != 200 ) alert("Erreur");

        console.log('ça marche !')
    })
    ;
});