//--------------------------------------------------------------------------
// Asset Management

const elixir = require('laravel-elixir');
require('laravel-elixir-postcss');

Elixir.config.assetsPath = './resources/assets/';
Elixir.config.publicPath = './public/assets/';

const paths = {
    node : './node_modules/',
    dashboard : {
        src  : Elixir.config.assetsPath + 'dashboard/',
        dest : Elixir.config.publicPath + 'dashboard/'
    }
};

elixir((mix) => {

    //--------------------------------------------------------------------------
    // Dashboard Assets

    // TODO: Add img and fonts folders copying

    // FontAwesome font files

    [
        'fontawesome-webfont.eot',
        'fontawesome-webfont.svg',
        'fontawesome-webfont.ttf',
        'fontawesome-webfont.woff',
        'fontawesome-webfont.woff2',
        'FontAwesome.otf'
    ].forEach(function(filename) {
        mix.copy(
            paths.dashboard.src  + 'plugins/font-awesome/fonts/' + filename,
            paths.dashboard.dest + 'fonts/font-awesome/' + filename
        );
    });

    // Datatable images

    [
        'sort_both.png',
        'sort_asc.png',
        'sort_desc.png',
        'sort_asc_disabled.png',
        'sort_desc_disabled.png'
    ].forEach(function(filename) {
        mix.copy(
            paths.dashboard.src  + 'plugins/jquery-datatable/media/images/' + filename,
            paths.dashboard.dest + 'img/datatables/' + filename
        );
    });

    // International Telephone Input

    [
        'flags.png',
        'flags@2x.png'
    ].forEach(function(filename) {
        mix.copy(
            paths.node + 'intl-tel-input/build/img/' + filename,
            paths.dashboard.dest + 'img/intl-tel-input/' + filename
        );
    });
    mix.copy(
        paths.node + 'intl-tel-input/build/js/utils.js',
        paths.dashboard.dest + 'js/intl-tel-input/utils.js'
    );

    // Styles

    mix.sass(
        paths.dashboard.src + 'scss/main.scss',
        paths.dashboard.dest + 'css/style.css'
    );

    mix.styles(
        [
            paths.dashboard.src + 'plugins/pace/pace-theme-flash.css',
            paths.dashboard.src + 'plugins/bootstrap/css/bootstrap.min.css',
            paths.dashboard.src + 'plugins/jquery-scrollbar/jquery.scrollbar.css',
            paths.dashboard.src + 'plugins/select2/css/select2.min.css',
            paths.dashboard.src + 'plugins/switchery/css/switchery.min.css',

            paths.dashboard.src + 'plugins/jquery-datatable/media/css/jquery.dataTables.css',
            paths.dashboard.src + 'plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css',
            paths.dashboard.src + 'plugins/datatables-responsive/css/datatables.responsive.css',

            paths.dashboard.src + 'plugins/datetimepicker/jquery.datetimepicker.css',

            paths.node + 'intl-tel-input/build/css/intlTelInput.css',

            paths.dashboard.dest + 'css/style.css'
        ],
        paths.dashboard.dest + 'css/style.css'
    );

    // Scripts

    mix.scripts(
        [
            paths.dashboard.src + 'plugins/feather-icons/feather.min.js',
            paths.dashboard.src + 'plugins/pace/pace.min.js',
            paths.dashboard.src + 'plugins/jquery/jquery-1.11.1.min.js',
            paths.dashboard.src + 'plugins/modernizr.custom.js',
            paths.dashboard.src + 'plugins/jquery-ui/jquery-ui.min.js',
            paths.dashboard.src + 'plugins/tether/js/tether.min.js',
            paths.dashboard.src + 'plugins/bootstrap/js/bootstrap.min.js',
            paths.dashboard.src + 'plugins/select2/js/select2.full.min.js',
            paths.dashboard.src + 'plugins/jquery/jquery-easy.js',
            paths.dashboard.src + 'plugins/jquery-unveil/jquery.unveil.min.js',
            paths.dashboard.src + 'plugins/jquery-bez/jquery.bez.min.js',
            paths.dashboard.src + 'plugins/jquery-ios-list/jquery.ioslist.min.js',
            paths.dashboard.src + 'plugins/imagesloaded/imagesloaded.pkgd.min.js',
            paths.dashboard.src + 'plugins/jquery-actual/jquery.actual.min.js',
            paths.dashboard.src + 'plugins/jquery-scrollbar/jquery.scrollbar.min.js',
            paths.dashboard.src + 'plugins/classie/classie.js',

            paths.dashboard.src + 'plugins/jquery-datatable/media/js/jquery.dataTables.min.js',
            paths.dashboard.src + 'plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js',
            paths.dashboard.src + 'plugins/datatables-responsive/js/datatables.responsive.js',
            paths.dashboard.src + 'plugins/datatables-responsive/js/lodash.min.js',

            paths.dashboard.src + 'plugins/datetimepicker/jquery.datetimepicker.js',
            paths.dashboard.src + 'plugins/bootstrap.file-input.js',
            paths.dashboard.src + 'plugins/autosize.min.js',

            paths.node + 'intl-tel-input/build/js/intlTelInput.min.js',
            paths.node + 'jquery-mask-plugin/dist/jquery.mask.min.js',

            paths.dashboard.src + 'js/pages.min.js',

            paths.dashboard.src + 'js/custom.js'
        ],
        paths.dashboard.dest + 'js/script.js'
    );

});
