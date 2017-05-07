// app.js
window.$ = window.jQuery = require('jquery')

require('bootstrap-sass/assets/javascripts/bootstrap/button')
require('bootstrap-sass/assets/javascripts/bootstrap/collapse')
require('bootstrap-sass/assets/javascripts/bootstrap/dropdown')
require('bootstrap-sass/assets/javascripts/bootstrap/modal')
require('bootstrap-sass/assets/javascripts/bootstrap/transition')

require('bootstrap-hover-dropdown/bootstrap-hover-dropdown')

require('yii')
require('yii.activeForm')
require('yii.captcha')
require('yii.gridView')
require('yii.validation')
require('yii2-pjax/jquery.pjax.js')

require('masonry-layout/dist/masonry.pkgd')
require('lazysizes/lazysizes')

window.toastr = require('toastr/toastr')

require('selectize/dist/js/standalone/selectize')

require('../js/app.js')

// app icon
require('../images/favicon.png')
require('../images/apple-touch-icon.png')

// app.css
require('../css/app.scss')
