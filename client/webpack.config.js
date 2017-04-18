module.exports = function (env) {
  return require(`./config/${env}.js`)(env)
}
