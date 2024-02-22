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
                            <a class="nav-link" href="Et0.php">
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

                    

                        <div class="col-md-3">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                        </div>
                        <div class="col-md-3">
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
                   
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $selectedPuit = isset($_GET['puit']) ? $_GET['puit'] : '';
                    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                    $type = isset($_GET['type']) ? $_GET['type'] : '';

                    $query = "";
                    // Initialize the query
                    $query = "SELECT entree, sortie_estimee, sortie_reel, last_update as Date
                    FROM trafic
                    WHERE (entree, last_update) IN (
                        SELECT entree, MAX(last_update) AS MaxDate
                        FROM courant
                            ) ORDER BY last_update";





                    if (!empty($startDate) && !empty($endDate)) {
                        $query = "SELECT entree, sortie_estimee, sortie_reel, last_update as Date
                        FROM trafic
                        WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                        AND entree IN (
                            SELECT entree
                            FROM trafic
                            WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                        ) ORDER BY last_update";
              
                        }
                    } else {
                        echo "nothing found";
                    }

                    $result = $conn->query($query);
                


                ?>

                <!-- <?php echo $query ?> -->
                 <div class="row justify-content-center mb-4">
    <button type="button" onclick="toggle(0)" id="tables" class="btn btn-light mx-5">Tableaux</button>
    <button type="button" onclick="toggle(1)" id="visualisations" class="btn btn-secondary">Graphe</button>
  </div>
  <div id="plotly" class="d-none"></div>
                <table id="myTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <!--<th>Phase</th>-->
                            <th>Date</th>
                            <th>entree (m3)</th>
                            <th>sortie_reel (m3)</th>
                            <th>sortie_estimee (m3)</th>
                          
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if ($result->num_rows > 0) {
                      $dataArray = array();
                        while ($row = $result->fetch_assoc()) {
                            $dataArray[] = array(
                              'timestamp' => $row['Date'],
                              'entree' => $row['entree'],
                              'sortie_reel' => $row['sortie_reel'],
                              'sortie_estimee' => $row['sortie_estimee']
                            );
                            echo "<tr>";
                            // echo "<td>" . $row['phase'] . "</td>";
                            echo "<td>" . $row['Date'] . "</td>";
                            echo "<td>" . $row['entree'] . "</td>";
                            echo "<td>" . $row['sortie_reel'] . "</td>";
                            echo "<td>" . $row['sortie_estimee'] . "</td>";
                          
                          
                            
                            echo "</tr>";
                        }
                        $jsonData = json_encode($dataArray);
                    }else {
            echo "<tr><td colspan='4'>No data found.</td></tr>";
                        }
                        
                        ?>
                    </tbody>
                </table>


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
            XLSX.writeFile(workbook, 'traffic.xlsx');
        }
    </script>
    <script type='text/javascript'>
        
        const dataArray = <?php echo $jsonData; ?>;
        const timestamps = [];
        const entree = [];
        const sortie_reel = [];
        const sortie_estimee = [];

        dataArray.forEach(function(item) {
            timestamps.push(item.timestamp);
            entree.push(item.entree);
            sortie_reel.push(item.sortie_reel);
            sortie_estimee.push(item.sortie_estimee);
        });

        // Define the trace for the line chart
        const trace1 = {
            x: timestamps,
            y: entree,
            type: 'bar',
            name:'entree'
        };
        
        const trace2 = {
            x: timestamps,
            y: sortie_reel,
            type: 'bar',
            name:'Sortie Reel'
        };

        const trace3 = {
            x: timestamps,
            y: sortie_estimee,
            type: 'bar',
            name:'Sortie Estimee'
        };

        const data = [trace1,trace2,trace3];

        const layout = {
            barmode : "group",
            xaxis: {
                title: 'Last Update'
            },
            yaxis: {
                title: 'Eau (m3)',
                fixedrange: true
            }
        };

        // Plot the chart
        
          function toggle(id) {
          if (id==0){
            document.getElementById("tables").classList.replace('btn-secondary', 'btn-light')
            document.getElementById("visualisations").classList.replace('btn-light','btn-secondary')
            document.getElementById("myTable").classList.remove('d-none')
            document.getElementById("plotly").classList.add("d-none")
          }else{
            document.getElementById("tables").classList.replace('btn-light','btn-secondary')
            document.getElementById("visualisations").classList.replace('btn-secondary', 'btn-light')
            document.getElementById("myTable").classList.add('d-none')
            document.getElementById("plotly").classList.remove("d-none")
            Plotly.newPlot('plotly', data, layout,{
              scrollZoom: true,displaylogo: false
            });
          }
        }
    </script>
</body>

</html>