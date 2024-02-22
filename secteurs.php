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
                    <input type="hidden" name="type" value="<?php echo isset(
                        $_GET["type"]
                    )
                        ? $_GET["type"]
                        : ""; ?>">

                    <div class="form-row">

                         <div class="col-md-3">
                            <label for="Secteur">Secteure</label>
                            <select class="form-control" name="Secteur" id="Secteur">
                                <option value="" selected >--All--</option>
                                <option value="Secteur 1 - AF1">Secteur 1 - AF1</option>
                                <option value="Secteur 2 - AF1">Secteur 2 - AF1</option>
                                <option value="Secteur 3 - AF1">Secteur 3 - AF1</option>
                                <option value="Secteur 4 - AF1">Secteur 4 - AF1</option>
                                <option value="Secteur 1 - AF2">Secteur 1 - AF2</option>
                                <option value="Secteur 2 - AF2">Secteur 2 - AF2</option>
                                <option value="Secteur 3 - AF2">Secteur 3 - AF2</option>
                                <option value="Secteur 4 - AF2">Secteur 4 - AF2</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required value="<?php echo isset(
                                $_GET["start_date"]
                            )
                                ? $_GET["start_date"]
                                : ""; ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" required value="<?php echo isset(
                                $_GET["end_date"]
                            )
                                ? $_GET["end_date"]
                                : ""; ?>">
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
                <div id='placeholder' class='d-none'>
                  <div class="row justify-content-center mb-4">
                                    <button type="button" onclick="toggle(0)" id="tables" class="btn btn-light mx-5">Tableaux</button>
                                    <button type="button" onclick="toggle(1)" id="visualisations" class="btn btn-secondary">Graphe</button>
                                  </div>
                                  <div id="plotly" class="d-none"></div>
                  </div>     



                <?php
                require_once "connection.php";

                if ($_SERVER["REQUEST_METHOD"] === "GET") {
                    $selectedPuit = isset($_GET["Secteur"])
                        ? $_GET["Secteur"]
                        : "";
                    $startDate = isset($_GET["start_date"])
                        ? $_GET["start_date"]
                        : "";
                    $endDate = isset($_GET["end_date"])
                        ? $_GET["end_date"]
                        : "";
                    $type = isset($_GET["type"]) ? $_GET["type"] : "";

                    // Initialize the query
                    $query = "";
                    $query2 = "";
                    $query3 = "";

                    if ($type === "Cumule") {
                        $query = "SELECT Secteur, besoin_eau,volume_eau,engre,duree_irrigation,duree_fertigation,last_update
                                  FROM secteur_cumul
                                  WHERE (Secteur, last_update) IN (
                                      SELECT Secteur, MAX(last_update) AS MaxDate
                                      FROM secteur_cumul
                                      GROUP BY Secteur
                                  )  ORDER BY last_update";

                        if (!empty($startDate) && !empty($endDate)) {
                            $query = "SELECT Secteur, besoin_eau,volume_eau,engre,duree_irrigation,duree_fertigation,last_update 
                            FROM secteur_cumul
                                      WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                      AND (Secteur, last_update) IN (
                                        SELECT Secteur, MAX(last_update) AS MaxDate
                                        FROM secteur_cumul
                                        WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                        GROUP BY Secteur 
                                      ) ORDER BY last_update ";
                        }

                        if (
                            !empty($startDate) &&
                            !empty($endDate) &&
                            !empty($selectedPuit)
                        ) {
                            $query = "SELECT *
                                  FROM secteur_cumul
                                  WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') AND Secteur = '$selectedPuit' ORDER BY last_update
                                  ";
                        }
                    } elseif ($type === "Pression") {
                        $query = "SELECT Secteur, pression_avant_filtre, pression_apres_filtre, last_update 
                                  FROM secteur_detail
                                  WHERE (Secteur, last_update) IN (
                                      SELECT Secteur, MAX(last_update) AS MaxDate
                                      FROM secteur_detail
                                      GROUP BY Secteur
                                  ) ORDER BY last_update";

                        if (!empty($startDate) && !empty($endDate)) {
                            $query = "SELECT Secteur, pression_avant_filtre, pression_apres_filtre,last_update
                            FROM secteur_detail
                                    WHERE (Secteur, last_update) IN (
                                        SELECT Secteur, MAX(last_update) AS MaxDate
                                        FROM secteur_detail
                                        WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                        GROUP BY Secteur
                                    )
                                    ORDER BY last_update DESC";
                        }

                        if (
                            !empty($startDate) &&
                            !empty($endDate) &&
                            !empty($selectedPuit)
                        ) {
                            $query = "SELECT *
              FROM secteur_detail
              WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') AND Secteur = '$selectedPuit' AND pression_apres_filtre <> 0 AND pression_avant_filtre <> 0 ORDER BY last_update
              ";

                            $query2 = "SELECT c.Secteur,c.pression_apres_filtre, mc.pression_avant_filtre, c.last_update
                       FROM secteur_detail c
                       JOIN (
                           SELECT Secteur, MAX(pression_avant_filtre) AS pression_avant_filtre
                           FROM secteur_detail
                           WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') AND Secteur = '$selectedPuit'
                           
                       ) mc ON c.Secteur = mc.Secteur AND c.pression_avant_filtre = mc.pression_avant_filtre
                       WHERE STR_TO_DATE(c.last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') ORDER BY c.last_update ";

                            //   fro Presion apre filter pression_avant_filtre

                            $query3 = "SELECT c.Secteur,c.pression_avant_filtre, mc.pression_apres_filtre, c.last_update
                      FROM secteur_detail c
                      JOIN (
                          SELECT Secteur, MAX(pression_apres_filtre) AS pression_apres_filtre
                          FROM secteur_detail
                          WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') AND Secteur = '$selectedPuit'
                           
                      ) mc ON c.Secteur = mc.Secteur AND c.pression_apres_filtre = mc.pression_apres_filtre
                      WHERE STR_TO_DATE(c.last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')  ORDER BY c.last_update";
                        }
                    } elseif ($type === "Temps") {
                        $query = "SELECT Secteur, temps_ouverture, last_update 
                                  FROM secteur_to
                                  WHERE (Secteur, last_update) IN (
                                      SELECT Secteur, MAX(last_update) AS MaxDate
                                      FROM secteur_to
                                      GROUP BY Secteur
                                  ) ORDER BY last_update";

                        if (!empty($startDate) && !empty($endDate)) {
                            $query = "SELECT Secteur, temps_ouverture,last_update
                            FROM secteur_to
                                    WHERE (Secteur, last_update) IN (
                                        SELECT Secteur, MAX(last_update) AS MaxDate
                                        FROM secteur_to
                                        WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                                        GROUP BY Secteur
                                    )
                                    ORDER BY last_update DESC";
                        }

                        if (
                            !empty($startDate) &&
                            !empty($endDate) &&
                            !empty($selectedPuit)
                        ) {
                            $query = "SELECT *
                          FROM secteur_to
                          WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') AND Secteur = '$selectedPuit'
                          ORDER BY last_update
                          ";
                        }
                    }
                    if ($query) {
                        $result = $conn->query($query);
                    }
                    if ($query2) {
                        $result2 = $conn->query($query2);
                    }
                    if ($query3) {
                        $result3 = $conn->query($query3);
                    }
                }
                ?>
                  
                   

                <div id='groupTable'>

                    <!-- Max Pression Apre filter-->
                    
                    
                    <?php if (
                        $type === "Pression" &&
                        !empty($startDate) &&
                        !empty($endDate) &&
                        !empty($selectedPuit)
                    ) { ?>
                <h3>Max Value Pression avant filtre (bar)</h3>
                <table id="myTable2" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                
                 <th> Max Pression avant filtre (bar)</th>
                 <th> Pression après filtre (bar)</th>
                 
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["last_update"] . "</td>";
                echo "<td>" . $row["pression_avant_filtre"] . "</td>";
                echo "<td>" . $row["pression_apres_filtre"] . "</td>";

                echo "</tr>";
            } ?>
        </tbody>
    </table>
<?php } ?>
             
             
             
             
                    <!-- presion apre filter-->
                    
                    
                    
    <?php if (
        $type === "Pression" &&
        !empty($startDate) &&
        !empty($endDate) &&
        !empty($selectedPuit)
    ) { ?>
    <h3>Max Value Pression après filtre (bar)</h3>
    <table id="myTable2" class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>  Pression avant filtre (bar)</th>
                <th> Max Pression après filtre (bar)</th> 
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result3->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["last_update"] . "</td>";
                echo "<td>" . $row["pression_avant_filtre"] . "</td>";
                echo "<td>" . $row["pression_apres_filtre"] . "</td>";

                echo "</tr>";
            } ?>
        </tbody>
    </table>
<?php } ?>
             
             
                    <!---->
         
<h3>Secteures</h3>




<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <?php $rowNumber = 0; ?>
        <tr>
            <?php if (
                $type === "Cumule" &&
                $startDate &&
                $endDate &&
                $selectedPuit
            ) { ?>
                <th>Date</th>
                <!-- <th>Secteur</th> -->
                <th>Besoin d'eau (m3)</th>
                <th>Volume d'eau (m3)</th>
                <th>Engrais (l)</th>
                <th>Durée d'irrigation (H min sec)</th>
                <th>Durée de fertigation (H min sec)</th>
                
            <?php } elseif (
                $type === "Cumule" &&
                (!$startDate || !$endDate || !$selectedPuit)
            ) { ?>
                <th>Date</th>
                <th>Secteur</th>
                <th>Besoin d'eau (m3)</th>
                <th>Volume d'eau (m3)</th>
                <th>Engrais (l) </th>
                <th>Durée d'irrigation (H min sec)</th>
                <th>Durée de fertigation (H min sec)</th>
                
            <?php } elseif (
                $type === "Pression" &&
                $startDate &&
                $endDate &&
                $selectedPuit
            ) { ?>
                <th>Date</th>
                <!-- <th>Secteur</th> -->
                <th>Pression avant filtre (bar)</th>
                <th>Pression après filtre (bar)</th>
                
            <?php } elseif (
                $type === "Pression" &&
                (!$startDate || !$endDate || !$selectedPuit)
            ) { ?>
                <th>Date</th>
                <th>Secteur</th>
                <th>Pression avant filtre (bar)</th>
                <th>Pression après filtre (bar)</th>
                
            <?php } elseif (
                $type === "Temps" &&
                $startDate &&
                $endDate &&
                $selectedPuit
            ) { ?>
                <!--<th>Date</th>-->
                <th>Nombre de fois</th>
                <th>Temps d'ouverture</th>
                
            <?php } elseif (
                $type === "Temps" &&
                (!$startDate || !$endDate || !$selectedPuit)
            ) { ?>
                <th>Date</th>
                <th>Secteur</th>
                <th>Temps d'ouverture</th>
                
            <?php } else { ?>

            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0) {
            $dataArray = [];

            while ($row = $result->fetch_assoc()) {
                $rowNumber++;
                echo "<tr>";
                if (
                    ($type === "Cumule" &&
                        $startDate &&
                        $endDate &&
                        $selectedPuit) ||
                    ($type === "Pression" &&
                        $startDate &&
                        $endDate &&
                        $selectedPuit) ||
                    ($type === "Temps" &&
                        $startDate &&
                        $endDate &&
                        $selectedPuit)
                ) {
                    // echo "<td>" . $row['last_update'] . "</td>";
                    if ($type === "Cumule") {
                        $dataArray[] = [
                            "timestamp" => $row["last_update"],
                            "besoin_eau" => $row["besoin_eau"],
                            "volume_eau" => $row["volume_eau"],
                        ];
                        echo "<td>" . $row["last_update"] . "</td>";
                        echo "<td style='background-color: #5d91ff6b;'>" .
                            $row["besoin_eau"] .
                            "</td>";

                        echo "<td>" . $row["volume_eau"] . "</td>";
                        echo "<td>" . $row["engre"] . "</td>";
                        echo "<td>" . $row["duree_irrigation"] . "</td>";
                        echo "<td>" . $row["duree_fertigation"] . "</td>";
                    } elseif ($type === "Pression") {
                        $dataArray[] = [
                            "timestamp" => $row["last_update"],
                            "pression_avant_filtre" =>
                                $row["pression_avant_filtre"],
                            "pression_apres_filtre" =>
                                $row["pression_apres_filtre"],
                        ];
                        echo "<td>" . $row["last_update"] . "</td>";
                        echo "<td>" . $row["pression_avant_filtre"] . "</td>";
                        echo "<td>" . $row["pression_apres_filtre"] . "</td>";
                    } elseif ($type === "Temps") {
                        // echo "<td>" . $row['last_update'] . "</td>";
                        echo "<td>" . $rowNumber . "</td>";
                        echo "<td>" . $row["temps_ouverture"] . "</td>";
                    }
                } else {
                    echo "<td>" . $row["last_update"] . "</td>";
                    if ($type === "Cumule") {
                        echo "<td>" . $row["Secteur"] . "</td>";
                        echo "<td style='background-color: #5d91ff6b;'>" .
                            $row["besoin_eau"] .
                            "</td>";
                        echo "<td>" . $row["volume_eau"] . "</td>";
                        echo "<td>" . $row["engre"] . "</td>";
                        echo "<td>" . $row["duree_irrigation"] . "</td>";
                        echo "<td>" . $row["duree_fertigation"] . "</td>";
                    }

                    if ($type === "Pression") {
                        echo "<td>" . $row["Secteur"] . "</td>";
                        echo "<td>" . $row["pression_avant_filtre"] . "</td>";
                        echo "<td>" . $row["pression_apres_filtre"] . "</td>";
                    }
                    if ($type === "Temps") {
                        echo "<td>" . $row["Secteur"] . "</td>";
                        echo "<td>" . $row["temps_ouverture"] . "</td>";
                    }
                }

                echo "</tr>";
            }
            $jsonData = json_encode($dataArray);
        } else {
            echo "<tr><td colspan='4'>No data found.</td></tr>";
        } ?>
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
            XLSX.writeFile(workbook, 'Secteur.xlsx');
        }
        

        window.onload = function() {
          // Check if a selected option is saved in local storage
          var saved = localStorage.getItem('Secteur');

          // If there is a saved option, select it in the dropdown
          if (saved) {
            document.getElementById('Secteur').value = saved;
          }

          // When the form is submitted, save the selected option in local storage
          document.getElementById('yourForm').onsubmit = function() {
            var selected = document.getElementById('Secteur').value;
            localStorage.setItem('Secteur', selected);
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
        const data1 = []; 
        const data2 = []; 
        let name1;
        let name2;
        let title;
        let trace1;
        let trace2;
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        if (urlParams.get('type') == 'Cumule'){
          document.getElementById("placeholder").classList.remove("d-none")
          name1 = 'Volume Eau';
          name2 = 'Besoin Eau';
          title = 'Eau (m3)'
          dataArray.forEach(function(item) {
            timestamps.push(item.timestamp);
            data1.push(item.volume_eau);
            data2.push(item.besoin_eau);
        });
        trace1 = {
            x: timestamps,
            y: data1,
            type: 'bar',
            name:name1
        };

        trace2 = {
            x: timestamps,
            y: data2,
            type: 'bar',
            name:name2
        };
        }else if (urlParams.get('type') == 'Pression') {
          title = 'Pression (bar)'
          document.getElementById("placeholder").classList.remove("d-none")
          name1 = 'Pression avant filtre';
          name2 = 'Pression apres filtre';
          dataArray.forEach(function(item) {
            timestamps.push(item.timestamp);
            data1.push(item.pression_avant_filtre);
            data2.push(item.pression_apres_filtre);
        });
        trace1 = {
            x: timestamps,
            y: data1,
            mode: 'lines+markers',
            type: 'scatter',
            name:name1
        };

        trace2 = {
            x: timestamps,
            y: data2,
            mode: 'lines+markers',
            type: 'scatter',
            name:name2
        };
        }
        

        // Define the trace for the line chart
        

        

        const data = [trace1,trace2];

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
            document.getElementById("groupTable").classList.remove('d-none')
            document.getElementById("plotly").classList.add("d-none")
          }else{
            document.getElementById("tables").classList.replace('btn-light','btn-secondary')
            document.getElementById("visualisations").classList.replace('btn-secondary', 'btn-light')
            document.getElementById("groupTable").classList.add('d-none')
            document.getElementById("plotly").classList.remove("d-none")
            Plotly.newPlot('plotly', data, layout,{
              scrollZoom: true,displaylogo: false
            });
          }
        }
    </script>
</body>

</html>