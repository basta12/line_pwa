<?php
$access_token = '72R8yvYS3LrDrchnoN5IKWCYg6K8MKylUDE9lLBwlgqgaSuXAc9HAelnUdsJJgdGE+TZg38Cgt5EjYNGKWHzUou0nUlss8A4e+kPuGfBtgD9Nh+5NFkX/WMAVYe2b2idvXDvo5oabXsaLBiALNbBQwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
