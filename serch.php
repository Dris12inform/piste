<!DOCTYPE html>
<html>

<head>
    <title>Data Display and Search</title>
    <style>
        /* Add CSS styles for tables */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
 
<form method="GET" action="serch.php">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">
        <input type="submit" name="search" value="Search">
    </form>
    
    <form action="">
    <a href="export.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>">Export to Excel</a>

    </form>

    <?php
    require_once 'serch.php';
    require_once './src/phpspreadsheet/Spreadsheet.php';
    require_once 'connection.php';

    $whereClause = "";
    $start_date = "";
    $end_date = "";

  
if (isset($_GET['search'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    if (!empty($start_date) && !empty($end_date)) {
        $whereClause = "WHERE Date BETWEEN '$start_date' AND '$end_date'";
    } else {
        echo '<div id="warning" style="background-color: #ffeeba; color: #856404; padding: 10px; border: 1px solid #ffeeba;">Warning: You should select both start and end dates.</div>';
        echo '<script>
                setTimeout(function() {
                    var warningDiv = document.getElementById("warning");
                    if (warningDiv) {
                        warningDiv.style.display = "none";
                    }
                }, 1000); 
              </script>';
    }
}


    

    $query = "SELECT * FROM les_phase $whereClause";
    $query2 = "SELECT * FROM les_puits $whereClause";
    $query3 = "SELECT * FROM les_secteur $whereClause";
    $query4 = "SELECT * FROM debit $whereClause";
    $query5 = "SELECT * FROM volume_secteur $whereClause";

    //
    

    // Retrieve data from MySQL for each table
    $result = $conn->query($query);
    $result2 = $conn->query($query2);
    $result3 = $conn->query($query3);
    $result4 = $conn->query($query4);
    $result5 = $conn->query($query5);

    // Display the data in tables
    echo "<h3>Table Phase</h3>";
    echo "<table border='1'>
                <tr>
                    <th>Phase</th>
                    <th>Courant</th>
                    <th>Date</th>
                </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Phase'] . "</td>";
        echo "<td>" . $row['Courant'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // debit table 
    echo "<h3>Table Debits</h3>";
    echo "<table border='1'>
    <tr>
        <th>Debit</th>
        <th>Date</th>
    </tr>";

    while ($row = $result4->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Debit'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // table Les Puits
    echo "<h3>Table Puits</h3>";
    echo "<table border='1'>

<th>Puit</th>
<th>Volume d'eau (m3)</th>
<th>état (1:Marche, 0:Arret)</th>
<th>Date</th>
</tr>";

    while ($row = $result2->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" . $row['Puit'] . "</td>";
        echo "<td>" . $row['Volume_deau'] . "</td>";
        echo "<td>" . $row['Etat'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";


    // table Les Sectur
    echo "<h3>Table Sectures</h3>";
    echo "<table border='1'>

<th>Secteur</th>
<th>Besoin d'eau (m3)</th>
<th>Pression avant filtre (bar)</th>
<th>Pression après filtre (bar)</th>
<th>Surface (Ha)</th>
<th>Date</th>

</tr>";

    while ($row = $result3->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" . $row['Secteur'] . "</td>";
        echo "<td>" . $row['Besoin_deau'] . "</td>";
        echo "<td>" . $row['Pression_avant_filtre'] . "</td>";
        echo "<td>" . $row['Pression_après_filtre'] . "</td>";
        echo "<td>" . $row['Surface'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";

        echo "</tr>";
    }

    echo "</table>";

    // volume_sectur
    echo "<h3>volume Sectur</h3>";
    echo "<table border='1'>


<th>Volume d'eau (m3)</th>
<th>Durée d'irrigation (H min sec)</th>
<th>Durée de fertigation (H min sec)</th>
<th>Date</th>

</tr>";

    while ($row = $result5->fetch_assoc()) {
        echo "<tr>";

        
        
        echo "<td>" . $row['Volume_deau'] . "</td>";
        echo "<td>" . $row['Durée_dirrigation'] . "</td>";
        echo "<td>" . $row['Durée_de_fertigation'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";

        echo "</tr>";
    }

    echo "</table>";


    // Close the database connection
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>