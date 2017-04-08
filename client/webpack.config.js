const path = require('path')
const webpack = require('webpack')

const LicensePlugin = require('license-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const ManifestPlugin = require('webpack-manifest-plugin')
const CompressionPlugin = require('compression-webpack-plugin')

module.exports = {
  entry: {
    app: './entries/app.js'
  },
  output: {
    path: path.resolve(__dirname, '../web/assets'),
    publicPath: '/assets/',
    filename: '[name]-[hash].js'
  },
  module: {
    rules: [
      {
        test: require.resolve('jquery'),
        use: [
          {
            loader: 'expose-loader',
            options: 'jQuery'
          },
          {
            loader: 'expose-loader',
            options: '$'
          }
        ]
      },
      {
        test: require.resolve('toastr'),
        use: {
          loader: 'expose-loader',
          options: 'toastr'
        }
      },
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract([
          'css-loader',
          'postcss-loader',
          'sass-loader'
        ])
      },
      {
        test: /\.(eot|woff2?|svg|ttf)([\?]?.*)$/,
        use: 'file-loader'
      },
      {
        test: /favicon\.ico|icon\.png$/,
        use: {
          loader: 'file-loader',
          options: {
            name: '[name]-[hash].[ext]'
          }
        }
      }
    ]
  },
  plugins: [
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        warnings: false
      },
      output: {
        comments: false
      }
    }),
    new LicensePlugin({
      pattern: /^(.*)$/
    }),
    new ExtractTextPlugin({
      filename: '[name]-[contenthash].css'
    }),
    new ManifestPlugin(),
    new CompressionPlugin({
      test: /\.(js|css)/
    })
  ]
}
