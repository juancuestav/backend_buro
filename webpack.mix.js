const mix = require("laravel-mix");
const path = require("path");

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

// .copy("resources/js/particles.json", "public/js")
mix.js("resources/js/app.js", "public/js")
    .js("resources/js/full-app.js", "public/js")
    .ts("resources/js/main.ts", "public/js")
    .vue()
    .alias({
        "@": path.join(__dirname, "resources/js"),
        "@app": path.join(__dirname, "resources/js/Pages"),
        "@config": path.join(__dirname, "resources/js/config"),
        "@shared": path.join(__dirname, "resources/js/shared"),
        "@components": path.join(__dirname, "resources/js/shared/components"),
    })
    .sass("resources/sass/main.scss", "public/css")
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();
    // .copy("resources/css/vineta.svg", "public/css")
    // .version();
