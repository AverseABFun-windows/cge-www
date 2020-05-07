#!/bin/bash
set -eu

# -v mo�na z ciekawo�ci w��czy� (�eby wiedzie� co on w�a�ciwie sprawdza)
#    chocia� wtedy to naprawd� wypisuje mas� tekstu
#
# -o colored te� jest dobre (tylko wymaga konsoli, nie shella Emacsa)
#
# --anchor is needed, although slows down enormously...
#

do_linkchecker ()
{
  linkchecker --config=`pwd`/linkchecker.conf "$@"
}

do_linkchecker https://castle-engine.io/

# do_linkchecker *.html
