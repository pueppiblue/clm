var config = require("./webpack.config.js");
var webpack = require('webpack');
var port = '8090';

var webpackDevServer=require('webpack-dev-server');

config.entry.main.unshift(
    "webpack-dev-server/client?http://localhost:" + port + "/", "webpack/hot/dev-server"
);

var devServer = new webpackDevServer(webpack(config), {
        hot: true,
        publicPath: "http://localhost:" + port + "/assets/",
        contentBase: "web/",
        headers: {"X-Custom-Header": "yes"},
        stats: {colors: true}
    }
);

devServer.listen(
    port,
    'localhost',
    function (err, result) {
        if (err) {
            console.log(err);
        }
        console.log('Listening at localhost:' + port);
    }
);
