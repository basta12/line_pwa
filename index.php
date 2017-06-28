<?php
$access_token = '72R8yvYS3LrDrchnoN5IKWCYg6K8MKylUDE9lLBwlgqgaSuXAc9HAelnUdsJJgdGE+TZg38Cgt5EjYNGKWHzUou0nUlss8A4e+kPuGfBtgD9Nh+5NFkX/WMAVYe2b2idvXDvo5oabXsaLBiALNbBQwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$text = $event['message']['text'];
			if($text == 'ขอดูรูป'){				
				$replyToken = $event['replyToken'];
				$messages = [
						'type'=> 'image',
  						'originalContentUrl' => 'http://nrwms.pwa.co.th/WebPortal/Scripts/fileman/Uploads/pump2.jpg',
 						'previewImageUrl' => 'http://nrwms.pwa.co.th/WebPortal/Scripts/fileman/Uploads/pump2.jpg'
				];
				$url = 'https://api.line.me/v2/bot/message/reply';
				
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				
				$post = json_encode($data);
			}
			
		
		
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
getGoogleImg();

function getGoogleImg($k) {
	$url = "https://lh4.ggpht.com/An8v98KQi85Obs2-240UGSPeIyyq9mOwRvxbXzxMvvqloIOmUN3scTVN9nX3-q128Eg=h900";
	$web_page = file_get_contents( str_replace("##query##",urlencode($k), $url ));
 
	$tieni = stristr($web_page,"dyn.setResults(");
	$tieni = str_replace( "dyn.setResults(","", str_replace(stristr($tieni,");"),"",$tieni) );
	$tieni = str_replace("[]","",$tieni);
	$m = preg_split("/[\[\]]/",$tieni);
	$x = array();
	for($i=0;$i<count($m);$i++) {
		$m[$i] = str_replace("/imgres?imgurl\\x3d","",$m[$i]);
		$m[$i] = str_replace(stristr($m[$i],"\\x26imgrefurl"),"",$m[$i]);
		$m[$i] = preg_replace("/^\"/i","",$m[$i]);
		$m[$i] = preg_replace("/^,/i","",$m[$i]);
		if ($m[$i]!="") array_push($x,$m[$i]);
	}
	return $x;
}
