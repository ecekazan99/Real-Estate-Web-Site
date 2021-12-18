// This js file is created for input multiple image files in add advertisement
let fileLess;
window.onload = function() {
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
        var filesInput = document.getElementById("files");
        filesInput.addEventListener("change", function(event) {

            var files = event.target.files; //FileList object
            var output = document.getElementById("result");

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                //Only pics
                if (!file.type.match('image'))
                    continue;

                var picReader = new FileReader();

                picReader.addEventListener("load", function(event) {

                    var picFile = event.target;

                    var div = document.createElement("div");
                    div.className = "slide";
                    div.innerHTML = "<div class='close'>&times;</div>" + "<img alt='HouseImage' style='width:70%;height: 300px'" + "src=' " + picFile.result + "'" +
                        "title='" + picFile.name + "'/>";

                    output.insertBefore(div, null);

                });

                //Read the image
                picReader.readAsDataURL(file);
            }
            console.log("---Files-----")
            fileLess = files;
            console.log(files);
        });
    } else {
        console.log("Your browser does not support File API");
    }
}

function FillAttachmentArray(e, readerEvt) {
    AttachmentArray[arrCounter] = {
        AttachmentType: 1,
        ObjectType: 1,
        FileName: readerEvt.name,
        FileDescription: "Attachment",
        NoteText: "",
        MimeType: readerEvt.type,
        Content: e.target.result.split("base64,")[1],
        FileSizeInBytes: readerEvt.size
    };
    arrCounter = arrCounter + 1;
}
//To remove attachment once user click on x button
jQuery(function($) {
    $("div").on("click", ".close", function() {
        var id = $(this)
            .closest(".close")
            .find("img")
            .data("id");

        //to remove image tag
        $(this)
            .parent()
            .find("img")
            .not()
            .remove();

        //to remove div tag that contain the image
        $(this)
            .parent()
            .find("div")
            .not()
            .remove();

        //to remove div tag that contain caption name

        $(this)
            .parent()
            .parent()
            .find(".slide")
            .not()
            .remove();

        var lis = document.querySelectorAll("#result div");
        for (var i = 0;
            (div = lis[i]); i++) {
            if (div.innerHTML === "") {
                div.parentNode.removeChild(div);
            }
        }

        console.log(lis);

    });


});