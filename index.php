<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Database configuration

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "info";

// Your API Key
$apiKey = "PMAK-6504074109d92e00424b474f-a79468af05861196d61299ee2f64c4ac28"; // Replace with your actual API key

// Check if the API key is provided in the headers
$headers = getallheaders();
$providedApiKey = isset($headers['HTTP_API_KEY']) ? $headers['HTTP_API_KEY'] : null;

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define an API endpoint to fetch data from the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the provided API key matches the expected API key
    if ($providedApiKey !== $apiKey) {
        http_response_code(401); // Unauthorized
        echo "Unauthorized";
    } else {
        // API key is authorized, proceed to fetch and return data
        echo "$providedApiKey";
        $sql = "SELECT * FROM last"; // Replace with your actual table name
        $result = $conn->query($sql);
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'mobile' => $row['mobile']
                );
            }
            echo json_encode($data);
        } else {
            echo "No data found";
        }
    }
}

// Close the database connection
$conn->close();

// cURL code for making an external API request
$url = 'https://api.example.com/endpoint';
$username = 'manaj1102';
$password = 'Manaj@123456';

$headers = [
    'Authorization: Basic ' . base64_encode($username . ':' . $password)
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Process $response here
?>

</body>
</html>
