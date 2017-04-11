const webpack = require('webpack')
const merge = require('webpack-merge')
const CompressionPlugin = require('compression-webpack-plugin')

module.exports = function() {
  return merge(require('./base')(), {
    plugins: [
      new webpack.DefinePlugin({
        'process.env': {
          'NODE_ENV': JSON.stringify('prod')
        }
      }),
      new webpack.LoaderOptionsPlugin({
        minimize: true,
        debug: false
      }),
      new webpack.optimize.UglifyJsPlugin({
        output: {
          comments: false
        }
      }),
      new CompressionPlugin({
        test: /\.(js|css)/
      })
    ]
  })
}
