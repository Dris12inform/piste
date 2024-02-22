<?php
function get_data_from_database() {
    $connection = new mysqli("localhost", "pisteinnovation_pisteinnovation", "Agadir@2020", "pisteinnovation_irrigation");
    
    // Check if the connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
        echo "connect";
    }
    
    // Define the SQL query
    $sql = "SELECT champs, value FROM champs_value";
    
    // Execute the query
    $result = $connection->query($sql);
    
    // Prepare an array to store the results
    $results = [];
    
    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Loop through each row in the result set
        while($row = $result->fetch_assoc()) {
            // Add the row to the results array
            $results[$row["champs"]] = $row["value"];
        }
    } else {
        echo "0 results";
    }
    
    // Close the database connection
    $connection->close();
    
    // Return the results array
    return $results;
}

$data = get_data_from_database();

// This will return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
