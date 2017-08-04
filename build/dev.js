const baseConfig = require('./base')
const plugins = require('./plugins')
const merge = require('webpack-merge')

module.exports = merge.smart(baseConfig, {
  output: {
    filename: '[name].js'
  },
  plugins: [
    new plugins.ExtractText({
      filename: '[name].css'
    })
  ]
})
