const common = require('./common')
const { merge } = require('webpack-merge')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const { WebpackManifestPlugin } = require('webpack-manifest-plugin')

module.exports = merge(common, {
  mode: 'production',
  output: {
    filename: '[name].[contenthash].js',
    assetModuleFilename: '[name][ext]',
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].[contenthash].css'
    }),
    new WebpackManifestPlugin({
      publicPath: '',
      filter: (file) => !file.path.match(/\.(png|woff2)$/)
    })
  ]
})
