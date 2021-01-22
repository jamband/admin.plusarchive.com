module.exports = {
  Compression: require('compression-webpack-plugin'),
  CssExtract: require('mini-css-extract-plugin'),
  License: require('license-webpack-plugin').LicenseWebpackPlugin,
  Manifest: require('webpack-manifest-plugin').WebpackManifestPlugin,
  OptimizeCssAssets: require('optimize-css-assets-webpack-plugin'),
  Terser: require('terser-webpack-plugin')
}
