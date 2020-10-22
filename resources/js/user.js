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
