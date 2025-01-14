<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['center_no'])) {
    $center_no = $_POST['center_no'];
    
    // Make request to your API
    $api_url = "https://2dd4-41-182-169-3.ngrok-free.app/center_no/?center_no=" . urlencode($center_no);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Failed to fetch data']);
        exit;
    }
    
    curl_close($ch);
    
    // Forward the API response
    echo $response;
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>