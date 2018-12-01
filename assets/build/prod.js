const common = require('./common')
const plugins = require('./plugins')
const merge = require('webpack-merge')

module.exports = merge.smart(common, {
  mode: 'production',
  output: {
    filename: '[name]-[hash].js'
  },
  module: {
    rules: [
      {
        test: /\.(png|woff|woff2)$/,
        use: {
          loader: 'file-loader',
          options: {
            name: '[name]-[hash].[ext]'
          }
        }
      }
    ]
  },
  optimization: {
    minimizer: [
      new plugins.Terser({
        terserOptions: {
          output: {
            comments: false
          }
        }
      })
    ]
  },
  plugins: [
    new plugins.Compression({
      test: /\.(js|css)$/
    }),
    new plugins.CssExtract({
      filename: '[name]-[contenthash].css'
    }),
    new plugins.License({
      pattern: /^(.*)$/,
      perChunkOutput: false
    }),
    new plugins.Manifest({
    }),
    new plugins.OptimizeCssAssets({
    })
  ]
})
