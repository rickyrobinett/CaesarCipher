<?php
  
namespace CaesarCipher;

class CaesarCipher {

  private $alphabet;

  // Frequency of letters used in English, taken from Wikipedia.
  // http://en.wikipedia.org/wiki/Letter_frequency
  private $frequency = array(
      'a'=> 0.08167,
      'b'=> 0.01492,
      'c'=> 0.02782,
      'd'=> 0.04253,
      'e'=> 0.130001,
      'f'=> 0.02228,
      'g'=> 0.02015,
      'h'=> 0.06094,
      'i'=> 0.06966,
      'j'=> 0.00153,
      'k'=> 0.00772,
      'l'=> 0.04025,
      'm'=> 0.02406,
      'n'=> 0.06749,
      'o'=> 0.07507,
      'p'=> 0.01929,
      'q'=> 0.00095,
      'r'=> 0.05987,
      's'=> 0.06327,
      't'=> 0.09056,
      'u'=> 0.02758,
      'v'=> 0.00978,
      'w'=> 0.02360,
      'x'=> 0.00150,
      'y'=> 0.01974,
      'z'=> 0.00074
  );

  public function __construct($text = '')
  {
    $this->alphabet = range('a','z');
  }

  /*
   * Applies the Caesar shift cipher
   *
   * @param   string  message
   * @param   int     offset
   *
   * @return string
   */
  private function cipher($message, $offset) {
    $message_array = str_split($message); 
    foreach($message_array as $i=>$letter) {
      if(!ctype_alpha($letter)) continue;
      if(ctype_upper($letter)) {
        $alphabet = range('A','Z');
      } else {
        $alphabet = $this->alphabet;
      }

      $value = array_search($letter, $alphabet);
      $cipher_value = $value + $offset; 
      if($cipher_value > 25) {
        $cipher_value = $cipher_value % 26;
      } else if ( $cipher_value < 0 ) {
        $cipher_value = $cipher_value % 26;
        $cipher_value = $cipher_value + 26;
      }
      $message_array[ $i ] = $alphabet[ $cipher_value ];
    }
    return implode( $message_array );
  } 

  /*
   * Decodes message using Caesar shift cipher
   *
   * @param   string  message
   * @param   int     offset
   *
   * @return string
   */
  public function decode($message, $offset) {
    return $this->cipher($message, $offset * -1);
  }

  /*
   * Encode message using Caesar shift cipher
   *
   * @param   string  message
   * @param   int     offset
   *
   * @return string
   */
  public function encode($message, $offset) {
    return $this->cipher($message, $offset);
  }

  /*
   * Attempts to crack message using frequency of letters in English.
   * 
   * @param   string  message
   *
   * @return string
   */
  public function crack($message) {
    $entropy_values = array();
    $attempt_cache = array();
    foreach(range(0, 25) as $i) {
      $test_cipher = $this->decode($message, $i * -1);
      $entropy_values[ $i ] = $this->calculate_entropy($test_cipher); 
      $attempt_cache[ $i ] = $test_cipher;
    }
    $lowest_entropy = array_keys($entropy_values, max($entropy_values));
    return $attempt_cache[ $lowest_entropy[0] ];
  }

  /*
   * Calculates the entropy of a string based on known frequency of English letters
   *
   * @param   string  entropy_string
   * 
   * @return  string
   */
  private function calculate_entropy($entropy_string) {
    $total = 0;
    for($i =0; $i < strlen($entropy_string); $i++) {
      if(ctype_alpha($entropy_string[$i])) {
        $prob = $this->frequency[ strtolower( $entropy_string[$i] ) ];
        $total += log( $prob ) / log( 2 );
      }
    }
    return $total;
  }
}
