const baseConfig = require('./base')
const plugins = require('./plugins')
const merge = require('webpack-merge')

module.exports = function (env) {
  return merge.smart(baseConfig(env), {
    output: {
      filename: '[name].js'
    },
    plugins: [
      new plugins.ExtractText({
        filename: '[name].css'
      })
    ]
  })
}
