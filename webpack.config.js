var HtmlWebpackPlugin = require('html-webpack-plugin')
var MiniCssExtractPlugin = require('mini-css-extract-plugin')
var CleanWebpackPlugin = require('clean-webpack-plugin')
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')
var VueLoaderPlugin = require('vue-loader/lib/plugin')
var path = require('path')

var outputPath = path.join(__dirname, 'public') 

module.exports = {
    entry:{
        js: './src/Frontend/index.js',
    },
    output:{
        filename:'[name].[chunkhash].js',
        path: outputPath

    },
    devServer:{
        contentBase: outputPath,
        port: 8080
    },
    devtool: 'eval-source-map',
    module:{
        rules:[
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test:/\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader'
                }
            },
            {
                test:/\.html$/,
                use: [
                    {
                        loader:'html-loader',
                        options: {minimize: true}
                    }
                ]
            },
            {
                test:/\.(css|scss)$/,
                use: [
                    'vue-style-loader',
                    'style-loader',
                    MiniCssExtractPlugin.loader,
                    'css-loader?sourceMap',
                    'postcss-loader?sourceMap',
                    'resolve-url-loader',
                    'sass-loader?outputStyle=compressed&sourceMap'
                ]
            },
            {
                test: /\.(jpe?g|png|gif|svg|webpg)$/i,
                use: [
                    'file-loader?name=assets/[name].[ext]',
                    'image-webpack-loader?bypassOnDebug'
                ]
            },
            {
                test: /\.(ttf|eot|woff?2|mp4)$/i,
                use: 'file-loader?name=assets/[name].[ext]'
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin(),
        new CleanWebpackPlugin(
            ['public'],
            {
                exclude: ['index.php']
            }
        ),
        new HtmlWebpackPlugin({
            template:'./src/Frontend/index.html',
            filename:'index.html', // takes output folder as reference
            hash: true,
            chunks: ['js']
        }),
        new MiniCssExtractPlugin({
            filename:'[name].css',
            chunkFilename:'[id].css' // avoid cache
        }),
        new OptimizeCssAssetsPlugin({
            cssProcessorPluginOptions: {
                preset: ['default', {discardComments: { removeAll: true}}]
            }
        })
    ]
}
