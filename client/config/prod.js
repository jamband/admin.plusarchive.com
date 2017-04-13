const baseConfig = require('./base')
const plugins = require('./plugins')
const webpack = require('webpack')
const merge = require('webpack-merge')

module.exports = function (env) {
  return merge.smart(baseConfig(env), {
    output: {
      filename: '[name]-[hash].js'
    },
    plugins: [
      new webpack.LoaderOptionsPlugin({
        minimize: true,
        debug: false
      }),
      new webpack.optimize.UglifyJsPlugin({
        output: {
          comments: false
        }
      }),
      new plugins.ExtractText({
        filename: '[name]-[contenthash].css'
      }),
      new plugins.License({
        pattern: /^(.*)$/
      }),
      new plugins.Manifest(),
      new plugins.Compression({
        test: /\.(js|css)/
      })
    ]
  })
}
