var path = require('path');
var webpack = require('webpack');
var webpackDevServer=require('webpack-dev-server');
var port = 8090;
var source_dir = path.resolve(__dirname, 'app/Resources/AppBundle/assets');
var dest_dir = path.resolve(__dirname, 'web/assets');
var bower = path.resolve(__dirname,'vendor/bower_components');
var node = path.resolve(__dirname,'node_modules');

var config = {
    entry: {
        main: [
            'webpack-dev-server/client?http://localhost:8090',
            'webpack/hot/dev-server',
            path.resolve(source_dir, "js/hello.js"),
            path.resolve(source_dir, "css/hello.css"),
        ],
        vendor: [
            'webpack-dev-server/client?http://localhost:8090',
            'webpack/hot/dev-server',
            path.resolve(bower, "jquery/dist/jquery.js"),
            path.resolve(bower, "bootstrap/less/bootstrap.less"),
            path.resolve(bower, "bootstrap/dist/js/bootstrap.js"),
            path.resolve(bower, "Materialize/sass/materialize.scss"),
            path.resolve(bower, "Materialize/dist/js/materialize.js"),
        ]
    },
    output: {
        filename: '[name].js',
        path: dest_dir,
        publicPath: "http://localhost:8090/assets/"
    },
    module: {
        loaders: [
            {
                test: /\.css$/,
                include: path.resolve(source_dir, 'css'),
                loader: "style!css"
            },
            {
                test: /\.scss$/,
                loader: "style!css!sass"
            },
            {
                test: /\.less$/,
                loader: "style!css!less"
            },
            {
                test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                loader: "url-loader?limit=10000&mimetype=application/font-woff"
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
            hammerjs: "vendor/bower_components/Materialize/js/hammer.min.js"
        },
    },
    resolveLoader: {
        root: [node, bower]
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new webpack.ResolverPlugin(
            new webpack.ResolverPlugin.DirectoryDescriptionFilePlugin(".bower.json", ["main"])
        ),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            // "Hammer": "hammerjs/hammer"
        }),

    ],
};

var devServer = new webpackDevServer(webpack(config), {
    hot: true,
    publicPath: "http://localhost:8090/assets/",
    contentBase: "web/",
    headers: {"X-Custom-Header": "yes"},
    stats: {colors: true}
    }
);

devServer.listen(
    8090,
    'localhost',
    function (err, result) {
        if (err) {
            console.log(err);
        }
        console.log('Listening at localhost:'+port);
    }
);

module.exports = config;