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
            const value = data;
            // Utilisez les données JSON récupérées (data) comme vous le souhaitez
        })
        .catch(function (error) {
            alert(error);
        });
}
