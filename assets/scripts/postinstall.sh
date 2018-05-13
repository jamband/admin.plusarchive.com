#!/bin/bash

SELECTIZE_DIR=node_modules/selectize/dist/css
CSS_FILE=${SELECTIZE_DIR}/selectize.bootstrap3.css

if [ -e "$CSS_FILE" ]; then
  mv ${CSS_FILE} ${SELECTIZE_DIR}/selectize.bootstrap3.scss
fi
