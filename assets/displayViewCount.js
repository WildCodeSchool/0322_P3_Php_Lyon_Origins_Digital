const elements = document.querySelectorAll('.bt-stats');
for (const element of elements) {
    const videoId = element.getAttribute('data-info');
    fetch(videoId)
        .then(response => {
            if (response.status !== 200) {
                throw new Error("Impossible de compter cette vue");
            }
            return response.json();
        })
        .then(data => {
            const viewedValue = data[0][1];
            let textForView = ' vue';
            if (viewedValue > 1) textForView = ' vues';
            const viewsElement = element.querySelector('.bt-views');
            viewsElement.textContent = viewedValue + textForView;
        })
        .catch(function (error) {
            alert(error);
        });
}
