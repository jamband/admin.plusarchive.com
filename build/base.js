const path = require('path')
const plugins = require('./plugins')
const webpack = require('webpack')

module.exports = {
  entry: {
    vendor: './client/entries/vendor.js',
    app: './client/entries/app.js',
    admin: './client/entries/admin.js'
  },
  output: {
    path: path.resolve(__dirname, '../web/assets'),
    publicPath: '/assets/',
    jsonpFunction: 'plusarchive'
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: plugins.ExtractText.extract([
          'css-loader', 'postcss-loader', 'sass-loader'
        ])
      },
      {
        test: /\.(png|eot|woff|woff2|svg|ttf)$/,
        use: {
          loader: 'file-loader',
          options: {
            name: process.env.NODE_ENV === 'production'
              ? '[name]-[hash].[ext]'
              : '[name].[ext]'
          }
        }
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      Popper: ['popper.js', 'default'],
      Util: 'exports-loader?Util!bootstrap/js/dist/util'
    }),
    new webpack.optimize.ModuleConcatenationPlugin(),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendor',
      chunks: ['app', 'admin']
    })
  ]
}
