import Dropzone from "dropzone";

document.addEventListener("DOMContentLoaded", function () {
    //definisez ci-dessous la taille maxi d'une video à uploader (en Mb) 
    //FYI convertisseur ici: https://www.convertworld.com/fr/mesures-informatiques/megaoctet-megabyte.html
    const maxVideoFileSize = 512; // en Mb
    let dropzone_default = new Dropzone("#mydropzone", {
        maxFiles: 1,
        dictDefaultMessage: "Déposez votre vidéo ici ou cliquez pour en séléctionner une (taille max "+maxVideoFileSize+" Mb, durée min 30sec)",
        dictMaxFilesExceeded: 'Vous ne pouvez ajouter qu\'une seule video à la fois',
        acceptedFiles: 'video/mp4',
        chunking: true,
        maxFilesize: maxVideoFileSize,
        createImageThumbnails: false,
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                this.removeFile(file);
            });
            this.on("sending", function (file, xhr, formData) {
                // send additional data with the file as POST data if needed
                // code format : formData.append("key", "value");
            });
            this.on("success", function (file, response) {
                if (response.uploaded)
                    alert('File Uploaded');
            });
        }
    })
})
