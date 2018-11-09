---
title: multiple file upload using jquery ajax with complete percentage
layout: post
---
~~~js

//=================================================
// input On Change
//=================================================
function fileOnSelect(e) {
    e.preventDefault();
    var files = e.target.files;
    for (var i = 0; i < files.length; i++) {
        var eachFile = files[i];
        var formData = new FormData();
        formData.append("file", eachFile);

        uploadThisFile(formData);

    }

}

//=================================================
// Upload Each File
//=================================================
function uploadThisFile(formData){
    $.ajax({
        type: "POST",
        url: ['URL HERE'], // Upload URL Here
        data: formData,
        processData: false,
        contentType: false,
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    //=================================================
                    // this is the upload progress in percentage
                    //=================================================
                    var percentComplete = (evt.loaded / evt.total) * 100;
                    console.log(percentComplete);
                }
            }, false);
            return xhr;
        },
        success: function (response) {
            //=================================================
            // Ajax return Response
            //=================================================
            console.log(response);
        }
    });
}
~~~