const addComment = document.getElementById('add-comment');
const videoId = addComment.getAttribute('data-info');
const form = document.getElementById('comment-field');
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
                commentArea.value = '';
                const divToAppend = document.getElementById('commentsPart');
                divToAppend.insertAdjacentHTML('afterbegin', datas);
            })
    }
});

const commentContents = document.getElementsByClassName('comment-contents');

for (const commentContent of commentContents) {

    const commentId = commentContent.id;
    const truncatedComment = document.getElementById('truncated-comment-' + commentId);
    const fullComment = document.getElementById('full-comment-' + commentId);
    const loadMoreCommentContent = document.getElementById('loadmore-comment-' + commentId);
    const loadLessCommentContent = document.getElementById('loadless-comment-' + commentId);

    loadMoreCommentContent.addEventListener('click', function(){
        truncatedComment.classList.add('d-none');
        fullComment.classList.remove('d-none');
    })

    loadLessCommentContent.addEventListener('click', function(){
        truncatedComment.classList.remove('d-none');
        fullComment.classList.add('d-none');
    })
}
