<!DOCTYPE html>
<html>

<head>
    <title>Data Display and Export to Excel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
    /* phon scren*/
        @media (max-width: 550px) {
            #sidebar {
                background-color: #333;
                color: #fff;
                padding: 20px;
                /* width: 100px; */
                /* Adjust the width as needed */
                 height: 100vh; 
                /* Full height of the viewport */
                position: fixed;
            }

            #content {
                flex: 1;
                padding: 20px;
                margin-left: 137px;

            }
        }
        .serch{
            margin-top:32px;
        }
        /* laptop scren*/

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styles */
        #sidebar {
            background-color: #333;
            color: #fff;
            padding: 20px;
            height: 100vh;
        }

        #sidebar a {
            color: #fff;
            text-decoration: none;
        }

        #sidebar a:hover {
            background-color: #4CAF50;
            border-radius: 5px;
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            background-color: transparent;
            border: none;
            text-align: left;
            padding: 7px;
            font-size: 16px;
            cursor: pointer;
            color: #fff;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #4CAF50;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Content Styles */
        #content {
            padding: 20px;
        }

        /* Form Styles */
        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        /* Table Styles */
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
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                Home
                            </a>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" href="phase.php">
                                Phase
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="fil.php">
                                Et0
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="traffic.php">
                                Traffic
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="consommation.php">
                                Consommation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gui.php">
                                GUI
                            </a>
                        </li>
                        <li class="dropdown">
                            <button class="dropdown">Puits</button>
                            <div class="dropdown-content">
                                <a href="Puit.php?type=debit">Debit</a>
                                <a href="Puit.php?type=volume">Volume</a>
                            </div>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="Secteurs.php">
                                Secteures
                            </a> -->
                        <li class="dropdown">
                            <button class="dropdown">Secteur</button>
                            <div class="dropdown-content">
                                <a href="secteurs.php?type=Cumule">Cumul</a>
                                <a href="secteurs.php?type=Pression">Pression</a>
                                <a href="estimation.php">Estimation</a>
                                <a href="secteurs.php?type=Temps">Temps</a>
                            </div>
                        </li>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="content">
                <!-- Filter Form -->
                <form method="GET" action=""id="yourForm">
                    <input type="hidden" name="type" value="<?php echo isset($_GET['type']) ? $_GET['type'] : ''; ?>">

                    <div class="form-row">

                    <div class="col-md-2">
                        
                        <label for="puit">Puit</label>
                        <select class="form-control" name="puit" id="puit">
                            <option value="" selected >--All Puit--</option>
                            <option value="PUIT6">Puit 6</option>
                            <option value="PUIT3">Puit 3</option>
                            <option value="PUIT7">Puit 7</option>
                            <option value="PUIT8">Puit 8</option>
                        </select>
                    </div>

                        <div class="col-md-2">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" required value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                        </div>
                        
                        
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary form-control serch">Search</button>
                        </div>
                        
                            
                            <!---->
                            <div class="col-md-2">
                                <button onclick="exportData()" class="btn btn-success form-control serch">Export </button>  
                            </div>
                    </div>
                    <br>
                   
                </form>
                

                <?php

                require_once 'connection.php';
               $selectedPui = isset($_POST['selected_puit']) ? $_POST['selected_puit'] : '';


                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $selectedPuit = isset($_GET['puit']) ? $_GET['puit'] : '';
                    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                    $type = isset($_GET['type']) ? $_GET['type'] : '';

                    // Initialize the query
                    $query = "";
                    if ($type === 'debit') {
                        $query = "SELECT puit, debit, last_update as Date
                                  FROM debit
                                  WHERE (puit, last_update) IN (
                                      SELECT puit, MAX(last_update) AS MaxDate
                                      FROM debit
                                      GROUP BY puit
                                  ) ORDER BY Date";
                        if (!empty($startDate) && !empty($endDate)) {
                            $query = "SELECT puit, debit, last_update as Date
                                      FROM debit
                                      WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                      AND (puit, last_update) IN (
                                          SELECT puit, MAX(last_update) AS MaxDate
                                          FROM debit
                                          WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                          GROUP BY puit 
                                      ) ORDER BY Date";
                        }


                        
                        
                        
                        if (!empty($startDate) && !empty($endDate) && !empty($selectedPuit)) {
                            $query = "SELECT debit.puit, debit.debit,last_update as Date, HOUR(debit.last_update) AS Hour, MAX(debit.last_update) AS MaxDate
                                      FROM debit
                                      WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                      AND puit = '$selectedPuit'
                                      GROUP BY debit.Puit, HOUR(debit.last_update)
                                      ORDER BY MaxDate DESC";
                        }
                     

                    } elseif ($type === 'volume') {
                        $query = "SELECT puit, volume, last_update as Date
                                        FROM volume
                                        WHERE (puit, last_update) IN (
                                            SELECT puit, MAX(last_update) AS MaxDate
                                            FROM volume
                                            GROUP BY puit
                                        ) ORDER BY Date";

                        if (!empty($startDate) && !empty($endDate)) {
                            $query = "SELECT puit, volume,last_update as Date
                                    FROM volume
                                    WHERE (puit, last_update) IN (
                                        SELECT puit, MAX(last_update) AS MaxDate
                                        FROM volume
                                        WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                        GROUP BY puit
                                    )
                                    ORDER BY Date DESC";
                        }

                        
                        if (!empty($startDate) && !empty($endDate) && !empty($selectedPuit)) {
    $query = "SELECT puit, volume, last_update as Date
FROM volume
WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') AND puit = '$selectedPuit'  ORDER BY Date
";
}                      
                    }

                    $result = $conn->query($query);
                }

                ?>

  <div class="row justify-content-center mb-4">
    <button type="button" onclick="toggle(0)" id="tables" class="btn btn-light mx-5">Tableaux</button>
    <button type="button" onclick="toggle(1)" id="visualisations" class="btn btn-secondary">Graphe</button>
  </div>
  <div id="plotly" class="d-none"></div>
<div id="tableGroup">

  
  <h3>Puits</h3>
  <table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <?php if ($type === 'debit' && $startDate && $endDate && $selectedPuit) { ?>
                <th>Date</th>
                <th>Débit (m3/h)</th>
                
            <?php } elseif ($type === 'volume' && $startDate && $endDate && $selectedPuit) { ?>
                <th>Date</th>
                <th>Volume d'eau (m3)</th>
                
            <?php } elseif ($type === 'debit' && (!$startDate || !$endDate || !$selectedPuit)) { ?>
                <th>Date</th>
                <th>Puit</th>
                <th>Débit (m3/h)</th>
                
            <?php } elseif ($type === 'volume' && (!$startDate || !$endDate || !$selectedPuit)) { ?>
                <th>Date</th>
                <th>Puit</th>
                <th>Volume d'eau (m3)</th>
                
            <?php } else { ?>
                <th>Date</th>
                <th>Puit</th>
                <th>Débit (m3/h)</th>
                <th>Volume d'eau (m3)</th>
                
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $dataArray = array();
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                
                if (($type === 'debit' && $startDate && $endDate && $selectedPuit) || ($type === 'volume' && $startDate && $endDate && $selectedPuit)) {
                    echo "<td>" . $row['Date'] . "</td>";
                    if ($type === 'debit') {
                        echo "<td>" . $row['debit'] . "</td>";
                    } elseif ($type === 'volume') {
                        echo "<td>" . $row['volume'] . "</td>";
                    }
                    $dataArray[] = array(
                      'timestamp' => $row['Date'],
                      'value' => $row[$type]
                    );
                } else {
                  $dataArray[] = array(
                    'timestamp' => $row['Date'],
                    'puit' => $row['puit'],
                    'value' => $row[$type]
                  );
                    echo "<td>" . $row['Date'] . "</td>";
                    if ($type === 'volume') {
                        echo "<td>" . $row['puit'] . "</td>";
                        echo "<td>" . $row['volume'] . "</td>";
                    }
                    
                    if ($type === 'debit') {
                        echo "<td>" . $row['puit'] . "</td>";
                        echo "<td>" . $row['debit'] . "</td>";
                    }
                    
                }
                echo "</tr>";
                $jsonData = json_encode($dataArray);
            }
        } else {
            echo "<tr><td colspan='4'>No data found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</div>

               
            </main>
        </div>
    </div>
    
    <script>
        function exportData() {
            const table = document.querySelector('#myTable');
            const tableData = [];


            table.querySelectorAll('tr').forEach(row => {
                const rowData = [];
                row.querySelectorAll('th, td').forEach(cell => {
                    rowData.push(cell.textContent);
                });
                tableData.push(rowData);
            });


            const worksheet = XLSX.utils.aoa_to_sheet(tableData);

            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
            XLSX.writeFile(workbook, 'Puit.xlsx');
        }
        // 

      //     
      window.onload = function() {
        // Check if a selected option is saved in local storage
        var saved = localStorage.getItem('puit');

        // If there is a saved option, select it in the dropdown
        if (saved) {
          document.getElementById('puit').value = saved;
        }

        // When the form is submitted, save the selected option in local storage
        document.getElementById('yourForm').onsubmit = function() {
          var selected = document.getElementById('puit').value;
          localStorage.setItem('puit', selected);
        }

        // Add event listeners to the links
        var links = document.getElementsByTagName('a');
        for (var i = 0; i < links.length; i++) {
          links[i].addEventListener('click', function() {
            // Clear the local storage when a link is clicked
            localStorage.clear();
          });
        }
      }

    </script>


<script type='text/javascript'>
        
        const dataArray = <?php echo $jsonData; ?>;
        const timestamps = [];
        const values = []; 
        let title;

        dataArray.forEach(function(item) {
            timestamps.push(item.timestamp);
            values.push(item.value);
        });

        // Define the trace for the line chart
        const trace1 = {
            x: timestamps,
            y: values,
            mode: 'lines+markers',
            type: 'scatter'
        };

        const data = [trace1];
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        if (urlParams.get('type') == 'debit'){
          title = 'Debit (m3/h)'
        }
        else {
          title = 'Volume (m3)'
        }
        const layout = {
            xaxis: {
                title: 'Last Update'
            },
            yaxis: {
                title: title,
                fixedrange: true,
                rangemode: "tozero"
            }
        };

        // Plot the chart
        function toggle(id) {
          if (id==0){
            document.getElementById("tables").classList.replace('btn-secondary', 'btn-light')
            document.getElementById("visualisations").classList.replace('btn-light','btn-secondary')
            document.getElementById("tableGroup").classList.remove('d-none')
            document.getElementById("plotly").classList.add("d-none")
          }else{
            document.getElementById("tables").classList.replace('btn-light','btn-secondary')
            document.getElementById("visualisations").classList.replace('btn-secondary', 'btn-light')
            document.getElementById("tableGroup").classList.add('d-none')
            document.getElementById("plotly").classList.remove("d-none")
            Plotly.newPlot('plotly', data, layout,{
              scrollZoom: true,displaylogo: false
            });
          }
        }
    </script>

</body>

</html>