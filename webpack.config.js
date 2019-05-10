var Encore = require('@symfony/webpack-encore');

Encore
    // The project directory where compiled assets will be stored :
    .setOutputPath('public/build/')

    // The public path used by the web server to access the previous directory :
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())

    // Define the assets of the project :
    .addEntry('js/app', ['./assets/js/app.js'])
    .addStyleEntry('css/app', ['./assets/css/app.scss'])
;

module.exports = Encore.getWebpackConfig();
