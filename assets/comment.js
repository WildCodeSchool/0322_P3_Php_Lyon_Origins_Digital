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
                let parser = new DOMParser();
                let html = parser.parseFromString(datas, 'text/html');
                const fetchedComments = html.getElementById('commentTemplate');
                const divToAppend = document.getElementById('commentsPart');
                divToAppend.parentNode.insertBefore(fetchedComments, divToAppend);
            })
    }
});
