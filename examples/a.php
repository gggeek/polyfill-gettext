<pre>
<?php

var_dump(setlocale(LC_ALL, '0'));
var_dump(setlocale(LC_ALL, 0));

var_dump(setlocale(LC_MESSAGES, 0));
var_dump(setlocale(LC_MESSAGES, ''));

echo "\n";

foreach(explode(';', setlocale(LC_ALL, '0')) as $l) {
  $p = explode('=', $l, 2);
  echo "$p[0] : $p[1]\n";
  if (defined($p[0])) {
    echo "  Const {$p[0]} is defined and its value is " . constant($p[0]) . "\n";
  } else {
    echo "  Const {$p[0]} is not defined\n";
  }
  if ($p[0] === 'LC_MESSAGES') {
    echo "*** FOUND: {$p[1]} ***\n";
  }
}
