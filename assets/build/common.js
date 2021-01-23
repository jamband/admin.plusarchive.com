const plugins = require('./plugins')

module.exports = {
  entry: {
    vendor: './assets/entries/vendor.js',
    app: './assets/entries/app.js',
    admin: './assets/entries/admin.js'
  },
  output: {
    path: __dirname + '/../../web/assets',
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
              postcssOptions: {
                plugins: [
                  require('autoprefixer')()
                ]
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
  }
}
