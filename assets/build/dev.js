const common = require('./common')
const plugins = require('./plugins')
const merge = require('webpack-merge')

module.exports = merge.smart(common, {
  mode: 'development',
  output: {
    filename: '[name].js'
  },
  module: {
    rules: [
      {
        test: /\.(png|eot|woff|woff2|svg|ttf)$/,
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
