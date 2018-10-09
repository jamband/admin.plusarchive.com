module.exports = {
  Compression: require('compression-webpack-plugin'),
  CssExtract: require('mini-css-extract-plugin'),
  License: require('license-webpack-plugin').LicenseWebpackPlugin,
  Manifest: require('webpack-manifest-plugin'),
  OptimizeCssAssets: require('optimize-css-assets-webpack-plugin'),
  UglifyJs: require('uglifyjs-webpack-plugin')
}
