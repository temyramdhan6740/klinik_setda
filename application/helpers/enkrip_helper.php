<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function enkrip($param)
{
    // Store the cipher method
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $options = 0;
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "kudaliar";
    return openssl_encrypt(
        $param,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );
}

function dekrip($param)
{
    $ciphering = "AES-128-CTR";
    $decryption_iv = '1234567891011121';
    $options = 0;

    // Store the decryption key
    $decryption_key = "kudaliar";
    return openssl_decrypt(
        $param,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );
}