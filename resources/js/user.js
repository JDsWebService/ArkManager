require('./bootstrap');

// Preloader JS
require('./user/loader');

// App
require('./user/app');

// Custom
require('./user/custom');

// Enable All Tooltips on All Pages
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

// Theme Specific JS
require('./user/main');

$(document).ready(function(){
    $('#fileUpload').change(function (e) {
        var fileName = e.target.files[0].name;
        $('#fileUploadPTag').text("Uploading file: " + fileName);
    });
});
