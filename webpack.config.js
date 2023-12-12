const path = require('path');
module.exports = {
    mode: "production",
    entry: './resources/js/app.js', // We wants our entry point to this path
    output: {
        path: path.join(__dirname, 'assets/build/js'),
        filename: 'dist.js',
        clean : true,
    },
    module: {
        rules: [{
            loader: 'babel-loader',
            test: /\.jsx?$/, // This will match either .js or .jsx
            exclude: /node_modules/
        }, {
            test: /\.s?css$/, // This will match either .scss or .css
            use: [
                'style-loader',
                'css-loader',
                'sass-loader'
            ]
        }]
    },
    watch :true,
    devtool: false,
  

};