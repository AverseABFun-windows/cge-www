#!/bin/bash
set -eu

# Get resources from https://getbootstrap.com/docs/4.3/getting-started/introduction/
# for offline viewing

rm -f *.css *.js

wget https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
wget https://code.jquery.com/jquery-3.3.1.min.js
wget https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
wget https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
