<?php

session_start();

$url = "http://161.35.73.10:8000/controllers";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$res = curl_exec($curl);
curl_close($curl);

$Controllers = json_decode($res, true);

$DefaultController = "Unknown";

?>