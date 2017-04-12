const merge = require('webpack-merge')
const webpack = require('webpack')

module.exports = function() {
  return merge(require('./base')(), {
    plugins: [
      new webpack.EnvironmentPlugin({
        NODE_ENV: 'dev'
      })
    ]
  })
}
