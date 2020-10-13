require('./bootstrap');
require('jquery.easing');
require('isotope-layout/dist/isotope.pkgd');
require('venobox');
require('owl.carousel2');
require('./app/main');

// Enable All Tooltips on All Pages
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});
