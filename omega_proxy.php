<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
$hedef = isset($_GET['url']) ? $_GET['url'] : 'https://www.iddaa.com/program/futbol';
$izinliler = ['football-data.co.uk', 'espn.com', 'iddaa.com', 'mackolik.com'];
$yetkili = false;
foreach ($izinliler as $alan) { if (strpos($hedef, $alan) !== false) { $yetkili = true; break; } }
if (!$yetkili) { http_response_code(403); exit('Yetkisiz URL'); }
$ctx = stream_context_create(['http' => ['timeout' => 8, 'header' => "User-Agent: Mozilla/5.0\r\nReferer: https://www.iddaa.com/\r\n"], 'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
$veri = @file_get_contents($hedef, false, $ctx);
if ($veri !== false) { echo $veri; } else { http_response_code(502); echo ""; }
?>