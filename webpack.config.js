const path = require('path');
var LiveReloadPlugin = require('webpack-livereload-plugin');

module.exports = {
    plugins: [
        new LiveReloadPlugin()
    ],
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
