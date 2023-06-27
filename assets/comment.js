const addComment = document.getElementById('add-comment');
const form = document.getElementById('comment-field');
const commentBlock = document.getElementById('comment');
const writeBlock = commentBlock.children[0];
const writeField = writeBlock.firstElementChild;
const postBlock = commentBlock.children[1];
const postButton = postBlock.firstElementChild;

addComment.addEventListener('click', function(){
    form.classList.remove('d-none');
})

commentBlock.classList.add('row');

writeBlock.classList.add('col-10');

writeField.innerText = 'Ajoute ton commentaire';
writeField.classList.add('text-secondary');
writeField.classList.add('text-font');

postBlock.classList.add('col-2');
postBlock.classList.add('d-flex');
postBlock.classList.add('justify-content-end');
postBlock.classList.add('align-items-end');



