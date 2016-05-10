var path = require('path');
var webpack = require('webpack');
var source_dir = path.resolve(__dirname, 'app/Resources/AppBundle/assets');
var dest_dir = path.resolve(__dirname, 'web/assets');

module.exports = {
    entry: {
        main: [
            path.resolve(source_dir,"js/hello.js")
        ]
    },
    output: {
        filename: '[name].js',
        path : dest_dir,
        publicPath : "/assets/",
    },
    module: {
        loaders: [
            {
                test: /\.css$/,
                include: path.join(source_dir, 'css'),
                loader: "style!css"}
        ]
    },
    resolve: {
        root: [
            path.resolve("./vendor"),
            path.resolve("./node_modules")
        ]
    },
    devServer: {
        hot: true,
        port: 8090,
        contentBase: "web/",
        proxy: [{
            path: '/*/',
            target: 'http://localhost:80',
        }]
    }
};

