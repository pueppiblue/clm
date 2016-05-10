var path = require('path');
var webpack = require('webpack');
var source_dir = path.join(__dirname, 'app/Resources/AppBundle/assets');
var dest_dir = path.join(__dirname, 'web');

module.exports = {
    entry: [
        path.join(source_dir,"js/hello.js")
        ],
    output: {
        path: dest_dir+"/js",
        filename: "clm_main.js"
    },
    module: {
        loaders: [
            {test: /\.css$/, loader: "style!css"}
        ]
    }
};
