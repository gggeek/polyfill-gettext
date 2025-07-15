<?php
/*
   Copyright (c) 2003,2004,2005,2009 Danilo Segan <danilo@kvota.net>.
   Copyright (c) 2005,2006 Steven Armstrong <sa@c-area.ch>

   This file is part of Polyfill-Gettext.

   Polyfill-Gettextt is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   Polyfill-Gettext is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Polyfill-Gettext; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

error_reporting(E_ALL | E_STRICT);

require_once(__DIR__ . '/../vendor/autoload.php');

// define constants
define('PROJECT_DIR', __DIR__);
define('LOCALE_DIR', PROJECT_DIR .'/locale');
define('DEFAULT_LOCALE', setlocale(5, 0));

use PGetText\T;

$supported_locales = array(DEFAULT_LOCALE, 'en_US', 'sr_RS', 'de_CH', 'esperanto');
$encoding = 'UTF-8';

$locale = (isset($_GET['lang']) && in_array($_GET['lang'], $supported_locales)) ? $_GET['lang'] : DEFAULT_LOCALE;

// gettext setup
// note: according to the php manual, you might need the `putenv` call as well as `setlocale`
//putenv("LC_ALL=$locale");
$setlocale_success = setlocale(LC_ALL, $locale);
// Set the text domain as 'messages'
$domain = 'messages';
bindtextdomain($domain, LOCALE_DIR);
bind_textdomain_codeset($domain, $encoding);
textdomain($domain);

header("Content-type: text/html; charset=$encoding");
?><html lang="en">
<head>
<title>Polyfill-Gettext drop-in example</title>
</head>
<body>
<h1>Polyfill-Gettext as a drop-in replacement</h1>
<p>Example showing how to use Polyfill-Gettext as a drop-in replacement for the native gettext library.</p>
<?php

if (extension_loaded('gettext')) {
  print "<p>NB: The native gettext extension is active on this PHP installation</p>\n";
} else {
  print "<p>NB: The native gettext extension is not active on this PHP installation</p>\n";
}

print "<p>";
foreach($supported_locales as $l) {
	print "[<a href=\"?lang=$l\">$l</a>] ";
}
print "</p>\n";

if (extension_loaded('gettext')) {
  if ($setlocale_success) {
    print "<p>Locale '" . htmlspecialchars($locale) . "' is supported by your system.</p>\n";
  }
  else {
    print "<p>Locale '" . htmlspecialchars($locale) . "' is <strong>not</strong> supported on your system, using the default locale '". DEFAULT_LOCALE ."'.</p>\n";
  }
} else {
  if (T::locale_emulation()) {
    print "<p>Using polyfill-gettext to emulate the gettext API.</p>\n";
  }
  else {
    print "<p>Using an alternative gettext implementation.</p>\n";
  }
}

?>

<hr />

<?php
// using either Polyfill-Gettext or plain gettext
print "<pre>";
print _("This is how the story goes.\n\n");
for ($number=6; $number>=0; $number--) {
  printf(ngettext("%d pig went to the market\n", "%d pigs went to the market\n", $number), $number);
}
print "</pre>\n";
?>

<hr />
<p>&laquo; <a href="./index.php">back</a></p>
</body>
</html>
