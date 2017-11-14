var dropdownHover = function () {
  $('.dropdown-hover').dropdownHover({
    'delay': 300,
    'close-others': false
  });
}

$(dropdownHover);
$(document).on('pjax:success', dropdownHover);
