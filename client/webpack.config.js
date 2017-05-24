module.exports = function (env) {
  return require(`./build/${env}.js`)(env)
}
