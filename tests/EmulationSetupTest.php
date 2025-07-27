<?php

include_once __DIR__ . '/PolyfillTestCase.php';

use PGettext\T;

/**
 * Tests checking the conformity of the emulated calls with the php native extension - gettext setup
 */
class EmulationSetupTest extends PGettext_PolyfillTestCase
{
  static $domain = 'messages';

  /**
   * @dataProvider bind_textdomain_codeset_provider
   */
  public function test_bind_textdomain_codeset($domain, $codeset) {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
    $ret = T::_bind_textdomain_codeset($domain, $codeset);
    $eret = bind_textdomain_codeset($domain, $codeset);
    $this->assertEquals($eret, $ret);
  }

  public function bind_textdomain_codeset_provider() {
    $textDomains = array(
      null,
      '',
      -1,
      0,
      1,
      /// @todo fix these cases - raise + expect an error `textdomain(): Argument #1 ($domain) must be of type ?string, array given`
      //array(),
      //new stdClass(),
      'xxx-XXX',
      'C'
    );
    $codesets = array(
      null,
      '',
      -1,
      0,
      1,
      /// @todo fix these cases - expect an error
      //array(),
      //new stdClass(),
      'xxx-XXX',
      'UTF-8',
      'iso-8859-1'
    );

    $sets = array();
    foreach($textDomains as $textDomain) {
      foreach ($codesets as $codeset) {
        $sets[] = array($textDomain, $codeset);
      }
    }
    return $sets;
  }

  /**
   * @dataProvider bindtextdomain_provider
   */
  public function test_bindtextdomain($domain, $directory) {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
    $ret = T::_bindtextdomain($domain, $directory);
    $eret = bindtextdomain($domain, $directory);
    $this->assertEquals($eret, $ret);
  }

  public function bindtextdomain_provider() {
    return array(
      /*array(null),
      array(''),
      array(-1),
      array(0),
      array(1),
      array(array()),
      array(new stdClass()),
      array('xxx-XXX'),
      array('C'),*/
    );
  }

  /**
   * @dataProvider textdomain_provider
   */
  public function test_textdomain($domain) {
    if (!extension_loaded('gettext')) {
      $this->markTestSkipped('this test requires the gettext extension');
    }
    $ret = T::_textdomain($domain);
    $eret = textdomain($domain);
    $this->assertEquals($eret, $ret);
  }

  public function textdomain_provider() {
    return array(
      array(null),
      /// @todo fix this case
      //array(''),
      array(-1),
      /// @todo fix this case
      //array(0),
      array(1),
      /// @todo fix these cases - raise + expect an error
      //array(array()),
      //array(new stdClass()),
      array(static::$domain),
    );
  }
}
