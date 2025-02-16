#!/bin/bash
set -eu

# Check some webpages working OK on https://castle-engine.io/

check_url_success ()
{
  URL="$1"
  shift 1
  echo "Checking ${URL}"
  # tries=1, to warn me as soon as 1 failure occurs.
  # See https://bugs.debian.org/cgi-bin/bugreport.cgi?bug=181150,
  # tries=1 means to try once it seems.
  wget --no-check-certificate --tries=1 --output-document /dev/null "$@" "${URL}"
}

check_url_success http://castle-engine.io/
check_url_success https://castle-engine.io/
check_url_success https://castle-engine.io/index.php
check_url_success https://castle-engine.io/features.php
check_url_success https://castle-engine.io/wp/
check_url_success https://castle-engine.io/wp/wp-admin/
check_url_success https://castle-engine.io/wp/feed/
check_url_success https://castle-engine.io/wp/2017/02/18/castle-game-engine-6-0-release/
check_url_success https://castle-engine.io/wp/2017/02/
check_url_success https://castle-engine.io/wp/?s=release
check_url_success https://castle-engine.io/latest.zip

check_url_success http://www.castle-engine.io/manual_up.php
check_url_success https://www.castle-engine.io/manual_up.php
check_url_success http://castle-engine.io/manual_up.php
check_url_success https://castle-engine.io/manual_up.php
check_url_success https://castle-engine.io/build_tool
check_url_success https://castle-engine.io/Build%20Tool
