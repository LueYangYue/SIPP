<?php // Allow frontend (GitHub Pages and DigitalOcean App) to fetch data from this API safely
header("Access-Control-Allow-Origin: https://LueYangYue.github.io, https://sipp-app-l284a.ondigitalocean.app");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
?>