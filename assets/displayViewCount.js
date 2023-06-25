let videosId = [];
const elements = document.querySelectorAll('.bt-stats')

for (const element of elements) {
    videosId.push(element.getAttribute('data-info'));
}

if (videosId && videosId.length) {
    const url = '/viewed';
    const body = videosId;
    
    fetch(url, {
        method: "POST",
        body: JSON.stringify(body)
    })
        .then(function (response) {
            if (response.ok) {
                // Request was successful
                return response.text();
            } else {
                // Request failed
                throw new Error('Request failed with status ' + response.status);
            }
        })
        .then(function (datas) {
            const datasArray = JSON.parse(datas);
            datasArray.forEach(function (data) {
                const entries = Object.entries(data);
                entries.forEach(function (entry) {
                    const key = entry[0];
                    const value = entry[1];

                    let textForView = ' vue';
                    if (value > 1) textForView = ' vues';
                    let matchingDataInfo = document.querySelectorAll('[data-info="' + key + '"]');
                    matchingDataInfo.forEach(function(thisDataInfo) {
                        let matchingBtViews = thisDataInfo.querySelector('.bt-views');
                        matchingBtViews.textContent = value + textForView;
                    })
                });
            });
        })
        .catch(function (error) {
            // Handle any errors that occurred during the fetch operation
            alert('Error:', error);
        });

}
