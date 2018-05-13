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
    path: path.resolve(__dirname, '../../web/assets'),
    publicPath: '/assets/',
    jsonpFunction: 'plusarchive'
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [
          plugins.CssExtract.loader,
          {
            loader: 'css-loader'
          },
          {
            loader: 'postcss-loader',
            options: {
              config: {
                path: './client/build/postcss.config.js'
              }
            }
          },
          {
            loader: 'sass-loader'
          }
        ]
      }
    ]
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: 'vendor',
          name: 'vendor',
          chunks: 'all'
        }
      }
    }
  },
  plugins: [
    new webpack.ProvidePlugin({
      Popper: ['popper.js', 'default'],
      Util: 'exports-loader?Util!bootstrap/js/dist/util'
    })
  ]
}
