<?php
class DataController extends Controller {
  public function actionIndex()
  {

  }

  public function actionEncryption1()
  {
    // Store a string into the variable which
    // need to be Encrypted
    $simple_string = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consectetur
    lectus eu lorem sagittis at laoreet libero blandit. Morbi a purus et nulla
    posuere mattis. Pellentesque nulla mauris, consequat eleifend bibendum sed,
    luctus ut turpis. Praesent quis augue in tellus rutrum tempor. Morbi porttitor
    elementum mollis. Nulla in lacus est. Cras gravida dapibus dolor, non eleifend
    urna bibendum ut. Nam tempor pharetra neque, sit amet laoreet dui semper ut.
    Donec tincidunt ultrices dui, ac bibendum eros facilisis sit amet. Cum sociis
    natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed
    congue imperdiet augue quis ullamcorper. Phasellus imperdiet bibendum ornare.
    Integer erat velit, venenatis vitae tempus sed, ultricies sit amet nulla.
    Mauris diam dolor, feugiat quis ornare eu, vehicula sed dui. Suspendisse mi 
    ligula, lobortis non ultricies sit amet, aliquet ac lectus. Mauris porttitor 
    lobortis tellus at fermentum.
    
    Donec pulvinar auctor sapien, quis interdum nisl pharetra vel. Donec aliquet 
    neque quis neque consectetur id tempus lacus porttitor. Aliquam molestie justo 
    ut ligula vulputate ut sagittis lacus blandit. Donec rutrum posuere odio, vitae 
    tempor tellus placerat posuere. Vivamus accumsan turpis eget nibh luctus 
    placerat. Nullam aliquam tincidunt erat in dapibus. Pellentesque sollicitudin 
    porttitor consequat. Curabitur lacinia scelerisque est, at mollis enim bibendum 
    eget. Nam tortor mi, mattis sed
    ";
      
    // Display the original string
    echo "Original String: " . $simple_string." <br/><br/>";
      
    // Store the cipher method
    $ciphering = "AES-128-CTR";
      
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
      
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
      
    // Store the encryption key
    $encryption_key = "GeeksforGeeks";
      
    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt($simple_string, $ciphering,
                $encryption_key, $options, $encryption_iv);
      
    // Display the encrypted string
    echo "Encrypted String: " . $encryption . " <br/><br/>";
      
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
      
    // Store the decryption key
    $decryption_key = "GeeksforGeeks";
      
    // Use openssl_decrypt() function to decrypt the data
    $decryption=openssl_decrypt ($encryption, $ciphering, 
            $decryption_key, $options, $decryption_iv);
      
    // Display the decrypted string
    echo "Decrypted String: " . $decryption." <br/>";
    //-------------------------------------------------------------------------------------
    echo "<br/>Example 2: Below example illustrate the encryption and decryption of string. 
    Here string to be encrypted and decrypted string will be same but the encrypted string 
    is randomly changed respectively.<br/>";
    // Store a string into the variable which
// need to be Encrypted
$simple_string = "Welcome to GeeksforGeeks";
  
// Display the original string
echo "Original String: " . $simple_string . " <br/><br/>";
  
// Store cipher method
$ciphering = "BF-CBC";
  
// Use OpenSSl encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
  
// Use random_bytes() function which gives
// randomly 16 digit values
$encryption_iv = random_bytes($iv_length);
  
// Alternatively, we can use any 16 digit
// characters or numeric for iv
$encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
  
// Encryption of string process starts
$encryption = openssl_encrypt($simple_string, $ciphering,
        $encryption_key, $options, $encryption_iv);
  
// Display the encrypted string
echo "Encrypted String: " . $encryption . " <br/><br/>";
  
// Decryption of string process starts
// Used random_bytes() which gives randomly
// 16 digit values
$decryption_iv = random_bytes($iv_length);
  
// Store the decryption key
$decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
  
// Descrypt the string
$decryption = openssl_decrypt ($encryption, $ciphering,
            $decryption_key, $options, $encryption_iv);
  
// Display the decrypted string
echo "Decrypted String: " . $decryption."  <br/><br/>";
  }

}

/**
 * EOF
*/
