/**
 * Created by Morgan Lane on 24/08/2017.
 */
$('#upload-file-submit').click(function () {
   $('#upload-dropzone').submit();
});

$(function (){
    Dropzone.options.uploadDropzone = {
        paramName: "files",
        uploadMultiple:true,
        maxFilesize:1,
        autoProcessQueue: true,
        addRemoveLinks: true,
        acceptedFiles: ".png, .jpg, .jpeg",
        dictFallbackMessage:"Your browser does not support drag'n'drop file uploads.",
        dictRemoveFile: "Remove",
        dictFileTooBig:"Image is bigger than 6MB",

        accept: function(file, done) {
            console.log("Uploaded");
        },

        init:function() {

        },

        success: function(file,done){
            console.log("All files done!");
        }
    }
});