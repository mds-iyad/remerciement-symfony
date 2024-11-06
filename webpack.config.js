// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/styles/app.scss')
    .enableSassLoader()
    .autoProvidejQuery() // Optional, if you need jQuery for Bootstrap 4 components
;

module.exports = Encore.getWebpackConfig();