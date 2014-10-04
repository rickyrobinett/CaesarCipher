<?php

require(__DIR__ . '/../vendor/autoload.php');

use CaesarCipher\CaesarCipher;

class CaesarCipherTests extends \PHPUnit_Framework_TestCase {
  public function testCipherWithOffset() {
    $cipher = new CaesarCipher();
    $message = "Twilio";
    $test_cipher = $cipher->encode($message,1);
    $this->assertEquals($test_cipher, "Uxjmjp");
  } 

  public function testLongCipherWithOffset() {
    $cipher = new CaesarCipher();
    $message = "We lack the motion to move to the new beat!";
    $test_cipher = $cipher->encode($message, 5);
    $this->assertEquals($test_cipher, "Bj qfhp ymj rtynts yt rtaj yt ymj sjb gjfy!");
  }

  public function testDecodeWithOffset() {
    $cipher = new CaesarCipher();
    $message = "Uxjmjp";
    $test_cipher = $cipher->decode($message,1);
    $this->assertEquals($test_cipher, "Twilio");
  }
  
  public function testLongPhraseWithOffset() {
    $cipher = new CaesarCipher();
    $message = "Bj qfhp ymj rtynts yt rtaj yt ymj sjb gjfy!";
    $test_cipher = $cipher->decode($message, 5);
    $this->assertEquals($test_cipher, "We lack the motion to move to the new beat!");
  }

  public function testCrack() {
    $cipher = new CaesarCipher();
    $cipher_text = "Bj qfhp ymj rtynts yt rtaj yt ymj sjb gjfy!";
    $plaintext = "We lack the motion to move to the new beat!";
    $crack_text = $cipher->crack($cipher_text);
    $this->assertEquals($plaintext, $crack_text);
  }

  public function testCrackOneWord() {
    $cipher = new CaesarCipher();
    $cipher_text = "Yxo";
    $plaintext = "One";
    $crack_text = $cipher->crack($cipher_text);
    $this->assertEquals($plaintext, $crack_text);
  }
}
