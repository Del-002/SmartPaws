<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.promotexter.com/sms/send");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"apiKey\": \"fe1c5be79c3d74353d04922d116a6f8a\",
  \"apiSecret\": \"cd531606c1ce17e7628b81591174d09c\",
  \"from\": \"PTXTrial\",
  \"to\": \"+639089573946\",
  \"text\": \"Gumana siya yel gumagana\"
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json"
));

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);
?>


