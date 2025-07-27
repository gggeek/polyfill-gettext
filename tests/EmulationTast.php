<?php

include_once __DIR__ . '/PolyfillTestCase.php';

/**
 * Tests checking the conformity of the emulated calls with the php native extension
 */
class EmulationTest extends PGettext_PolyfillTestCase
{
  public function test_bind_textdomain_codeset() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_bindtextdomain() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_dcgettext() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_dcngettext() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_dgettext() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_dngettext() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_gettext() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_ngettext() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }

  public function test_textdomain() {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
  }
}
