<?php
/*
   Copyright (c) 2005 Steven Armstrong <sa at c-area dot ch>
   Copyright (c) 2009 Danilo Segan <danilo@kvota.net>

   Drop in replacement for native gettext.

   This file is part of Polyfill-Gettext.

   Polyfill-Gettext is free software; you can redistribute it and/or modify
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

use PGetText\T;


// LC_MESSAGES is not available if php has not been compiled with libintl,
// while the other constants are always available.
if (!defined('LC_MESSAGES')) {
  define('LC_MESSAGES',	5);
}

// *** Wrappers used as a drop in replacement for the standard gettext functions ***

if (!function_exists('gettext')) {

  /**
   * @param string $message
   * @return string
   */
  function _($message) {
    return gettext($message);
  }

  /**
   * @param string $domain
   * @param string|null $codeset
   * @return string|false
   */
  function  bind_textdomain_codeset($domain, $codeset = null) {
    return T::_bind_textdomain_codeset($domain, $codeset);
  }

  /**
   * @param string $domain
   * @param string|null $directory
   * @return string|false
   */
  function  bindtextdomain($domain, $directory = null) {
    return T::_bindtextdomain($domain, $directory);
  }

  /**
   * @param string $domain
   * @param string $message
   * @param int $category
   * @return string
   */
  function dcgettext($domain, $message, $category) {
    return T::_dcgettext($domain, $message, $category);
  }

  /**
   * @param string $domain
   * @param string $singular
   * @param string $plural
   * @param int $count
   * @param int $category
   * @return string
   */
  function dcngettext($domain, $singular, $plural, $count, $category) {
    return T::_dcngettext($domain, $singular, $plural, $count, $category);
  }

  /**
   * @param string $domain
   * @param string $message
   * @return string
   */
  function dgettext($domain, $message) {
    return T::_dgettext($domain, $message);
  }

  /**
   * @param string $domain
   * @param string $singular
   * @param string $plural
   * @param int $count
   * @return string
   */
  function dngettext($domain, $singular, $plural, $count) {
    return T::_dngettext($domain, $singular, $plural, $count);
  }

  /**
   * @param string $message
   * @return string
   */
  function gettext($message) {
    return T::_gettext($message);
  }

  /**
   * @param string $singular
   * @param string $plural
   * @param int $count
   * @return string
   */
  function ngettext($singular, $plural, $count) {
    return T::_ngettext($singular, $plural, $count);
  }

  /**
   * @param string|null $domain
   * @return string
   */
  function textdomain($domain = null) {
    return T::_textdomain($domain);
  }
}

/// @todo is it possible that `setlocale` is not available? It is defined in ext/standard/string.c...
if (!function_exists('setlocale')) {
  /**
   * @param int $category
   * @param string $locale
   * @param ...
   * @return string
   */
  function  setlocale($category, $locale)
  {
    return call_user_func_array(array('T', 'setlocale'), func_get_args());
  }
}
