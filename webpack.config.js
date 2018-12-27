var HtmlWebpackPlugin = require('html-webpack-plugin')
var MiniCssExtractPlugin = require('mini-css-extract-plugin')
var CleanWebpackPlugin = require('clean-webpack-plugin')
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')
var path = require('path')

module.exports = {
    entry:{
        js: './web/index.js',
    },
    output:{
        filename:'[name].[chunkhash].js'
    },
    devServer:{
        contentBase: path.join(__dirname, 'dist'),
        port: 8080
    },
    module:{
        rules:[
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
        new CleanWebpackPlugin(['dist/**/*.*']),
        new HtmlWebpackPlugin({
            template:'./web/index.html',
            filename:'./index.html', // takes output folder as reference
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
