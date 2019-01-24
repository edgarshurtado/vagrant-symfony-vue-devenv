var webpackConfig = require('./webpack.config.js')

module.exports = (config) => {
    config.set({
        // ... normal karma configuration
        files: [
            // all files ending in "_test"
            { pattern: 'test/*_test.js', watched: false },
            { pattern: 'test/**/*_test.js', watched: false }
            // each file acts as entry point for the webpack configuration
        ],

        preprocessors: {
            // add webpack as preprocessor
            'test/*_test.js': [ 'webpack' ],
            'test/**/*_test.js': [ 'webpack' ]
        },

        webpack: webpackConfig,

        webpackMiddleware: {
            // webpack-dev-middleware configuration
            // i. e.
            stats: 'errors-only'
        },
        browsers: [
            'ChromeDebugging'
        ],
        frameworks: ['jasmine'],
        customLaunchers: {
            ChromeDebugging: {
                base: 'Chrome',
                flags: [ '--remote-debugging-port=9333' ]
              }
        }
    })
}