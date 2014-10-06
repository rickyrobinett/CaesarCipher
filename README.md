Caesar Cipher
=============
A PHP Port of Rob Spectre's [Python Caesar Cipher library](https://github.com/RobSpectre/Caesar-Cipher). Encode, decode and crack messages with [Caesar Shift Cipher](http://www.wikiwand.com/en/Caesar_cipher).

[![Build Status](https://travis-ci.org/rickyrobinett/CaesarCipher.svg?branch=master)](https://travis-ci.org/rickyrobinett/CaesarCipher)
[![Coverage Status](https://img.shields.io/coveralls/rickyrobinett/CaesarCipher.svg)](https://coveralls.io/r/rickyrobinett/CaesarCipher?branch=master)
[![Total Downloads](http://img.shields.io/packagist/dt/caesarcipher/caesarcipher.svg)](https://packagist.org/packages/caesarcipher/caesarcipher)

## Installation
You can install this library using composer
```bash
composer require caesarcipher/caesarcipher
```

## Usage
Encoding a message with an offset:
```php
$cipher = new CaesarCipher();
$message = "Brooklyn";
$cipher->encode($message,5);
```

Decoding a ciphertext with an offset:
```php
$cipher = new CaesarCipher();
$message = "Uxjmjp";
$cipher->decode($message,5);
```

Cracking a ciphertext without knowing the offset:
```php
$cipher = new CaesarCipher();
$cipher_text = "Bj qfhp ymj rtynts yt rtaj yt ymj sjb gjfy!";
$crack_text = $cipher->crack($cipher_text);
```
