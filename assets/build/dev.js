const common = require('./common')
const plugins = require('./plugins')
const { merge } = require('webpack-merge')

module.exports = merge(common, {
  mode: 'development',
  output: {
    filename: '[name].js'
  },
  module: {
    rules: [
      {
        test: /\.(png|woff|woff2)$/,
        use: {
          loader: 'file-loader',
          options: {
            name: '[name].[ext]'
          }
        }
      }
    ]
  },
  plugins: [
    new plugins.CssExtract({
      filename: '[name].css'
    })
  ]
})
