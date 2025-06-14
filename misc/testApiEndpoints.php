<?php

function testEndpoint($url, $method = 'GET', $data = null) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return [
        'response' => $response,
        'httpCode' => $httpCode
    ];
}

// Test example endpoints
$baseUrl = 'http://localhost/ProyectoApi/view/API';

$endpoints = [
    'usuarios' => ['method' => 'GET'],
    'autores' => ['method' => 'GET'],
    'editoriales' => ['method' => 'GET'],
    'categorias' => ['method' => 'GET'],
    'prestamos' => ['method' => 'GET'],
    'detallePrestamos' => ['method' => 'GET'],
    'reservas' => ['method' => 'GET'],
    'multas' => ['method' => 'GET'],
    'historial' => ['method' => 'GET']
];

foreach ($endpoints as $endpoint => $config) {
    $url = "$baseUrl/$endpoint.php";
    $result = testEndpoint($url, $config['method']);

    echo "Testing $endpoint endpoint:\n";
    echo "HTTP Code: " . $result['httpCode'] . "\n";
    echo "Response: " . $result['response'] . "\n\n";
}

?>
