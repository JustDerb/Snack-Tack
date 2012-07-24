<?php
function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}

$result = parse_signed_request($_REQUEST['signed_request'],"9367c3a6f4bfd318cf405d014841ea41");


//Write to file (Need to set de-authorized flag in database so we don't lose events)
$myFile = "deauthorize.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $result["user_id"] . "\n");
fclose($fh);

?>
