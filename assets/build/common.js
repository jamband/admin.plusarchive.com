const MiniCssExtractPlugin = require("mini-css-extract-plugin");

/** @type {import("webpack").Configuration} */
module.exports = {
  entry: {
    app: "./assets/entries/app.js",
  },
  output: {
    path: __dirname + "/../../web/assets",
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          "css-loader",
          "postcss-loader",
          "sass-loader",
        ],
      },
      {
        test: /\.(png)$/,
        type: "asset/resource",
      },
    ],
  },
};
