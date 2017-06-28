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
  						'originalContentUrl' => 'https://pm.pwa.co.th/picture/P/P02790.jpg',
 						'previewImageUrl' => 'https://pm.pwa.co.th/picture/P/P02790.jpg'
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

	

