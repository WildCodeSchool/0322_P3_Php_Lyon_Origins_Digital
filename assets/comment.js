const addComment = document.getElementById('add-comment');

const videoId = addComment.getAttribute('data-info');
const addCommentNoUser = document.getElementById('add-comment-nouser');

const form = document.getElementById('comment-field');
const commentBlock = document.getElementById('comment');
const writeBlock = commentBlock.children[0];
const writeField = writeBlock.firstElementChild;
const postBlock = commentBlock.children[1];
const postButton = postBlock.firstElementChild;
const noCommentFound = document.getElementById('no-comment-found');

addComment.addEventListener('click', function () {
    form.classList.remove('d-none');
})

if (noCommentFound) {
    noCommentFound.addEventListener('click', function () {
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

const saveCommentBtn = document.getElementById('comment_save');


saveCommentBtn.addEventListener('click', function (event) {
    event.preventDefault();
    const comment = document.getElementById('comment_content').value;
    const url = '/comment/' + videoId;
    if (videoId && videoId.length && comment && comment.length) {
        fetch(url, {
            method: "POST",
            body: JSON.stringify(comment)
        })
            .then(function (response) {
                if (response.ok) {
                    // Request was successful
                    return response.text();
                } else {
                    // Request failed
                    throw new Error('La requête a échouée avec un statut ' + response.status);
                }
            })
    }
});
