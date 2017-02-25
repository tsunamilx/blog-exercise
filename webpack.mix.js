const {mix} = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const js = [
    'vendor', // vendor js (jquery, vue, etc.).
    'index', // index page.
    'show', // show page.
    'create', // create page.
    'edit', // edit page.
];

for (let f of js) {
    mix.js(`resources/assets/js/${f}.js`, `public/js/${f}.js`);
}

mix.sass('resources/assets/sass/app.scss', 'public/css');
