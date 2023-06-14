import Dropzone from "dropzone";

document.addEventListener("DOMContentLoaded", function () {
    var dropzone_default = new Dropzone(".dropzone", {
        maxFiles: 1,
        dictMaxFilesExceeded: 'Une seule video à la fois',
        acceptedFiles: 'video/mp4',
        chunking: true,
        forceChunking: false,
        maxFilesize: 256, // in Mb
        addRemoveLinks: false,
        createImageThumbnails: false,
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                this.removeFile(file);
            });
            this.on("sending", function (file, xhr, formData) {
                // send additional data with the file as POST data if needed :
                // formData.append("key", "value");
            });
            this.on("success", function (file, response) {
                if (response.uploaded)
                    alert('File Uploaded');
            });
        }
    })
})
