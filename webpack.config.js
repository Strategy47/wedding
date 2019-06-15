const Encore = require('@symfony/webpack-encore');
const StyleLintPlugin = require('stylelint-webpack-plugin');


Encore
    .setOutputPath('public/build/')
    .enableLessLoader(function(options) {
        options.relativeUrls = true
    })
    .setPublicPath('/build')
    .enableSourceMaps(!Encore.isProduction())
    .disableSingleRuntimeChunk()
    .enablePostCssLoader(function(options) {
        options.config = {
            path: './postcss.config.js'
        };
    })
    .enableVersioning(Encore.isProduction())


    .addEntry('app', './assets/js/app.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')
    .addStyleEntry('css/app', [
        './assets/less/app.less'
    ])
    .addEntry('js/admin', './assets/js/admin.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')
    .addStyleEntry('css/admin', [
        './assets/less/admin.less'
    ])

    .addLoader(
        {
            test: /\.(eot|ico|ttf|png)([\?]?.*)$/,
            loader: 'file-loader'
        },
        {
            test: /\.woff(\?v=\d+\.\d+\.\d+)?$/,
            loader: "url-loader?limit=10000&mimetype=application/font-woff"
        },
        {
            test: /\.woff2(\?v=\d+\.\d+\.\d+)?$/,
            loader: "url-loader?limit=10000&mimetype=application/font-woff"
        }
    )
    .addLoader({
        enforce: 'pre',
        test: /\.jsx?$/,
        exclude: /(node_modules|var\/)/,
        loader: 'eslint-loader',
        options: {
            cache: true
        }
    })
    .addPlugin(new StyleLintPlugin({
        files: ['assets/less/**/*.less', 'assets/pdf/less/**/*.less']
    }))
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })
;

module.exports = Encore.getWebpackConfig();
