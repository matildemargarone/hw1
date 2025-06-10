<?php
header('Content-Type: application/json');

// Chiave e endpoint
$apiKey = "secret"; // Sostituisci con la tua chiave vera
$url = 'https://mrgml-maau95oz-eastus2.cognitiveservices.azure.com/openai/deployments/gpt-4/chat/completions?api-version=2025-01-01-preview';

// Leggi il body JSON ricevuto dal client
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Verifica validità
if (!$data || !isset($data['messages'])) {
    echo json_encode(['error' => 'Dati non validi']);
    exit;
}

// Inizializza cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'api-key: ' . $apiKey
]);

// Esegui
$response = curl_exec($ch);

// Errori cURL
if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    echo $response;
}

curl_close($ch);
?>
