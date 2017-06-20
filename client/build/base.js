const plugins = require('./plugins')
const webpack = require('webpack')

module.exports = function (env) {
  return {
    entry: {
      vendor: './entries/vendor.js',
      app: './entries/app.js',
      admin: './entries/admin.js'
    },
    output: {
      path: `${__dirname}/../../web/assets`,
      publicPath: '/assets/'
    },
    resolve: {
      alias: {
        '~yii': `${__dirname}/../../vendor/yiisoft/yii2/assets`
      }
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
            options: { name: env === 'dev' ? '[name].[ext]' : '[name]-[hash].[ext]' }
          }
        }
      ]
    },
    plugins: [
      new webpack.optimize.ModuleConcatenationPlugin(),
      new webpack.optimize.CommonsChunkPlugin({
        name: 'vendor',
        chunks: ['app', 'admin']
      })
    ]
  }
}
