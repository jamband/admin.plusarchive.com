const merge = require('webpack-merge')
const webpack = require('webpack')

module.exports = function() {
  return merge(require('./base')(), {
    plugins: [
      new webpack.DefinePlugin({
        'process.env': {
          'NODE_ENV': JSON.stringify('dev')
        }
      })
    ]
  })
}
