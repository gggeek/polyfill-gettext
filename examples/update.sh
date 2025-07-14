#!/bin/sh

TEMPLATE=pigs.pot

xgettext -kngettext:1,2 -k_ -L PHP -o "$TEMPLATE" pigs_dropin.php

if [ "$1" = "-p" ]; then
  msgfmt --statistics "$TEMPLATE"
else
  if [ -f "$1.po" ]; then
	  msgmerge -o ".tmp$1.po" "$1.po" $TEMPLATE
	  mv ".tmp$1.po" "$1.po"
	  msgfmt --statistics "$1.po"
  else
	  echo "Usage: $0 [-p|<basename>]"
  fi
fi
