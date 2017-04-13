const path = require('path')
const plugins = require('./plugins')

module.exports = function (env) {
  return {
    entry: {
      app: './entries/app.js'
    },
    output: {
      path: path.resolve(__dirname, '../../web/assets'),
      publicPath: '/assets/'
    },
    resolve: {
      modules: [
        'node_modules',
        path.resolve(__dirname, '../../vendor/yiisoft/yii2/assets')
      ]
    },
    module: {
      rules: [
        {
          test: require.resolve('jquery'),
          use: [
            { loader: 'expose-loader', options: 'jQuery' },
            { loader: 'expose-loader', options: '$' }
          ]
        },
        {
          test: require.resolve('toastr'),
          use: { loader: 'expose-loader', options: 'toastr' }
        },
        {
          test: /\.scss$/,
          use: plugins.ExtractText.extract([
            'css-loader', 'postcss-loader', 'sass-loader'
          ])
        },
        {
          test: /\.(eot|woff2?|svg|ttf)$/,
          use: 'file-loader'
        },
        {
          test: /(favicon|apple-touch-icon)\.png$/,
          use: {
            loader: 'file-loader',
            options: { name: env === 'dev' ? '[name].[ext]' : '[name]-[hash].[ext]' }
          }
        }
      ]
    }
  }
}
