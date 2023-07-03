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

const saveCommentBtn = document.getElementById('comment_save');

saveCommentBtn.addEventListener('click', function (event) {
    event.preventDefault();
    const commentArea = document.getElementById('comment_content');
    let commentValue = commentArea.value;
    commentValue = commentValue.replace(/\n/g, '<br>');
    const url = '/comment/' + videoId;
    if (videoId && videoId.length && commentValue && commentValue.length) {
        fetch(url, {
            method: "POST",
            body: JSON.stringify(commentValue)
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
            .then(function (datas) {
                const datasArray = JSON.parse(datas);
                commentArea.value = '';
                const divToAppend = document.getElementById('commentsPart');
                const CommentHtml = '<div class="comment-list-0 bt-container mb-4"><div class="row"><div class="fs-3 col-auto text-info d-flex align-items-center border border-end-0 border-1 border-info rounded-start-3 position-relative"><span class="position-absolute top-0 start-100 translate-middle"><i class="bi bi-dot m-0"></i></span><span class="position-absolute top-100 start-100 translate-middle"><i class="bi bi-dot m-0"></i></span></div><div class="col"><div class="d-flex align-items-center justify-content-start"><span class="title-font text-secondary fs-4"><i class="bi bi-dot m-0"></i></span><span class="title-font text-secondary fs-4 me-3">' + datasArray.user + '</span><span class="text-font text-info align-middle"><i class="bi bi-dot m-0"></i>' + datasArray.date + '</span></div><div class="text-font row"><div class="col d-flex align-items-center"><span class="mb-3">'+ datasArray.comment + '</span></div></div></div></div></div>';
                divToAppend.insertAdjacentHTML('afterbegin', CommentHtml);
            })
    }
});
