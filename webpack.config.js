var path = require('path');
var webpack = require('webpack');
var source_dir = path.resolve(__dirname, 'app/Resources/AppBundle/assets');
var dest_dir = path.resolve(__dirname, 'web/assets/');
var bower = path.resolve(__dirname,'vendor/bower_components');
var node = path.resolve(__dirname,'node_modules');

var config = {
    entry: {
        jquery: [
            path.resolve(bower, "jquery/dist/jquery.js")
        ],
        vendor: [
            // // path.resolve(bower, "bootstrap/less/bootstrap.less"),
            // path.resolve(bower, "bootstrap/dist/js/bootstrap.js"),
            path.resolve(bower, "Materialize/sass/materialize.scss"),
            path.resolve(bower, "Materialize/dist/js/materialize.js")
        ],
        main: [
            path.resolve(source_dir, "js/main.js"),
            path.resolve(source_dir, "css/main.scss")
        ]
    },
    output: {
        filename: '[name].js',
        path: dest_dir + "/",
        publicPath:  "http://localhost:8090/assets/"
    },
    devtool: 'source-maps',
    module: {
        loaders: [
            {
                test: /\.css$/,
                include: path.resolve(source_dir, 'css'),
                loader: "style!css"
            },
            {
                test: /\.(scss|sass)$/,
                loader: "style!css!sass"
            },
            {
                test: /\.less$/,
                loader: "style!css!less"
            },
            {
                test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                loader: "url-loader"
            },
            {
                test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                loader: "file-loader"
            }
        ]
    },
    resolve: {
        root: __dirname,
        modulesDirectories: ['node_modules', 'vendor/bower_components'],
        alias: {
            jquery: "vendor/bower_components/jquery/src/jquery.js",
            hammerjs: "vendor/bower_components/Materialize/js/hammer.min.js"
        }
    },
    resolveLoader: {
        root: [node, bower]
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new webpack.ResolverPlugin(
            new webpack.ResolverPlugin.DirectoryDescriptionFilePlugin(".bower.json", ["main"])
        )
        // new webpack.ProvidePlugin({
        //     $: "jquery",
        //     jQuery: "jquery",
        // })
    ]
};

module.exports = config;