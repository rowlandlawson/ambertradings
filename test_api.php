<?php

require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['GEMINI_API_KEY'];

echo "Testing API Key: " . substr($apiKey, 0, 5) . "...\n";

$url = "https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $httpCode\n";

$data = json_decode($response, true);
if (isset($data['models'])) {
    foreach ($data['models'] as $model) {
        if (in_array('generateContent', $model['supportedGenerationMethods'])) {
            echo "Valid Model: " . $model['name'] . "\n";
        }
    }
} else {
    echo "No models found or error: " . substr($response, 0, 500);
}
