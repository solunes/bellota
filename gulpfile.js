var elixir = require('laravel-elixir');
var htmlmin = require('gulp-htmlmin');
var gulp = require('gulp');

require('laravel-elixir-sass-compass');

var paths = {
    'jquery': '../../bower_components/jquery/',
    'bootstrap': '../../bower_components/bootstrap-sass-official/assets/',
    'fontawesome': '../../bower_components/fontawesome/',
    'perfectscrollbar': '../../bower_components/perfect-scrollbar/min/',
    'animatecss': '../../bower_components/animate.css/',
    'wysiwygeditor': '../../bower_components/wysiwyg-editor/',
    'navbarmenu': '../../bower_plugins/MegaNavbar/assets/',
    'flexslider': '../../bower_components/FlexSlider/',
    'wow': '../../bower_components/wow/dist/',
    'owl': '../../bower_components/OwlCarousel2/dist/',
    'isotope': '../../bower_components/isotope/dist/',
    'imagesloaded': '../../bower_components/imagesloaded/',
    'excanvas': '../../bower_components/ExplorerCanvas/',
    'respondjs': '../../node_modules/respond.js/dest/',
    'angularcode': 'resources/assets/ng/',
    'legacycss': 'resources/assets/legacy/css/',
    'legacyjs': 'resources/assets/legacy/js/',
    'revolutioncss': 'resources/assets/revolution/css/',
    'revolutionjs': 'resources/assets/revolution/js/',
}
var public_directory = 'public';

elixir.config.publicDir = public_directory;
elixir.config.publicPath  = public_directory;
elixir(function(mix) {
    mix.cssOuput = public_directory + '/assets/css';
    mix.jsOuput = public_directory + '/assets/js';
    mix
        /*.copy(paths.bootstrap + 'stylesheets/**', 'resources/assets/sass/bootstrap')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', public_directory + '/assets/fonts/bootstrap')
        .copy(paths.fontawesome + 'scss/**', 'resources/assets/sass/fontawesome')
        .copy(paths.fontawesome + 'fonts/**', public_directory + '/assets/fonts/fontawesome')
        .sass("resources/assets/sass/vendor.scss", public_directory + '/assets/css/vendor.css')*/
        .compass("main.scss", public_directory + '/assets/css', {
            config_file: "config/compass.rb",
            style: "nested",
            comments: false,
            sass: "resources/assets/main"
        })
        /*.styles([
            paths.wysiwygeditor + "css/froala_style.min.css",
            paths.animatecss + "animate.min.css"
        ], public_directory + '/assets/css/plugins.css', './')
        .styles([
            paths.legacycss + "style.css",
            paths.legacycss + "responsive.css",
            paths.legacycss + "custom.css"
        ], public_directory + '/assets/css/template.css', './')
        .styles([
            paths.revolutioncss + "settings.css",
            paths.revolutioncss + "layers.css",
            paths.revolutioncss + "navigation.css"
        ], public_directory + '/assets/css/revolution.css', './')
        .scripts([
            paths.jquery + "dist/jquery.js",
            paths.bootstrap + "javascripts/bootstrap.js"
        ], public_directory + '/assets/js/vendor.js', './')
        .scripts([
            paths.isotope + "isotope.pkgd.min.js",
            paths.imagesloaded + "imagesloaded.pkgd.min.js",
            paths.wow + "wow.min.js"
        ], public_directory + '/assets/js/plugins.js', './')
        .scripts([
            paths.legacyjs + "plugins.js",
            paths.legacyjs + "hover.js",
            paths.legacyjs + "banner-grid.js"
        ], public_directory + '/assets/js/template.js', './')
        .scripts([
            paths.revolutionjs + "jquery.themepunch.tools.min.js",
            paths.revolutionjs + "jquery.themepunch.revolution.min.js",
            paths.revolutionjs + "extensions/revolution.extension.actions.min.js",
            paths.revolutionjs + "extensions/revolution.extension.carousel.min.js",
            paths.revolutionjs + "extensions/revolution.extension.kenburn.min.js",
            paths.revolutionjs + "extensions/revolution.extension.layeranimation.min.js",
            paths.revolutionjs + "extensions/revolution.extension.migration.min.js",
            paths.revolutionjs + "extensions/revolution.extension.navigation.min.js",
            paths.revolutionjs + "extensions/revolution.extension.parallax.min.js",
            paths.revolutionjs + "extensions/revolution.extension.slideanims.min.js",
            paths.revolutionjs + "extensions/revolution.extension.video.min.js"
        ], public_directory + '/assets/js/revolution.js', './')
        .scripts([
            paths.respondjs + "respond.min.js",
            paths.excanvas + "excanvas.js"
        ], public_directory + '/assets/js/ie8.js', './')*/
        .version([
            'assets/css/vendor.css',
            'assets/css/plugins.css',
            'assets/css/template.css',
            'assets/css/revolution.css',
            'assets/css/main.css',
            'assets/js/vendor.js',
            'assets/js/plugins.js',
            'assets/js/template.js',
            'assets/js/revolution.js',
            'assets/js/ie8.js'
        ]);
});

gulp.task('compress', function() {
    var opts = {
        collapseWhitespace:    true,
        removeAttributeQuotes: true,
        removeComments:        true,
        minifyJS:              true
    };

    return gulp.src('./storage/framework/views/**/*')
        .pipe(htmlmin(opts))
        .pipe(gulp.dest('./storage/framework/views/'));
});