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
      @media (width: 800px) {
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

        .serch {
          margin-top: 32px;
          width: 200px;
          background-color: red;
        }

        #content {
          flex: 1;
          padding: 20px;
          margin-left: 137px;

        }
      }

      .serch {
        margin-top: 32px;
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
            </ul>
          </div>
        </nav>

        <main class="col-md-9" id="content">
          <!-- Filter Form -->
          <form method="GET" action="" id="yourForm">
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
    $maxButton = isset($_GET['max_button']) ? $_GET['max_button'] : '';
    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : '';

    // Initialize the query
    $query = "SELECT phase, courant, last_update
              FROM courant
              WHERE (phase, last_update) IN (
                  SELECT phase, MAX(last_update) AS MaxDate
                  FROM courant
                  GROUP BY phase
              )";
    // Query to get the max courant within the specified date range
    $query2 = "SELECT c.phase, mc.courant, c.last_update
    FROM courant c
    JOIN (
        SELECT phase, MAX(courant) AS courant
        FROM courant
        WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
        GROUP BY phase
    ) mc ON c.phase = mc.phase AND c.courant = mc.courant
    WHERE STR_TO_DATE(c.last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d') ORDER BY c.last_update";
    if (!empty($startDate) && !empty($endDate)) {
        // Modify the query to filter by date range
        $query = "SELECT phase, courant, last_update 
                  FROM courant
                  WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                  AND (phase, last_update) IN (
                      SELECT phase, MAX(last_update) AS MaxDate
                      FROM courant
                      WHERE STR_TO_DATE(last_update, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate', '%Y-%m-%d') AND STR_TO_DATE('$endDate', '%Y-%m-%d')
                      GROUP BY courant 
                  ) ORDER BY last_update";

        

    }
} else {
    echo "nothing found"; 
}

$result = $conn->query($query);
$result2 = $conn->query($query2);
?>
          <div class="row justify-content-center">
            <button type="button" onclick="toggle(0)" id="tables" class="btn btn-light mx-5">Tableau</button>
            <button type="button" onclick="toggle(1)" id="visualisations" class="btn btn-secondary">Graphe</button>
          </div>
          <div id="plotly" class="d-none"></div>
          <div id="myTables" class="d-block">
            <?php if (!empty($startDate) && !empty($endDate)) { ?>
            <h3>Max Value</h3>
            <table id="myTable2" class="table table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>Date</th>
                  <th>Courant</th>
                </tr>
              </thead>
              <tbody>
                <?php
            while ($row = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['last_update'] . "</td>";
                echo "<td>" . $row['courant'] . "</td>";
                echo "</tr>";
            }
            ?>
              </tbody>
            </table>
            <?php } ?>

            <h3>Phase</h3>
            <table id="myTable" class="table table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>Date</th>
                  <th>Courant</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $dataArray = array();
                  while ($row = $result->fetch_assoc()) {
                      $dataArray[] = array(
                        'timestamp' => $row['last_update'],
                        'value' => $row['courant']
                      );
                      echo "<tr>";
                      echo "<td>" . $row['last_update'] . "</td>"; // Use 'Date' instead of 'last_update'
                      echo "<td>" . $row['courant'] . "</td>";
                      echo "</tr>";
                  }
                  $jsonData = json_encode($dataArray);
                  ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
    <script type='text/javascript'>
      const dataArray = <?php echo $jsonData; ?> ;
      const timestamps = [];
      const values = [];

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

      const layout = {
        xaxis: {
          title: 'Last Update'
        },
        yaxis: {
          title: 'Courant (A)',
          fixedrange: true,
          rangemode: "tozero"
        }
      };

      // Plot the chart

      function toggle(id) {
        if (id == 0) {
          document.getElementById("tables").classList.replace('btn-secondary', 'btn-light')
          document.getElementById("visualisations").classList.replace('btn-light', 'btn-secondary')
          document.getElementById("myTables").classList.replace('d-none', 'd-block')
          document.getElementById("plotly").classList.add("d-none")
        } else {
          document.getElementById("tables").classList.replace('btn-light', 'btn-secondary')
          document.getElementById("visualisations").classList.replace('btn-secondary', 'btn-light')
          document.getElementById("myTables").classList.replace('d-block', 'd-none')
          document.getElementById("plotly").classList.remove("d-none")
          Plotly.newPlot('plotly', data, layout, {
            scrollZoom: true,
            displaylogo: false
          });
        }
      }

    </script>

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
        XLSX.writeFile(workbook, 'Phase.xlsx');
      }

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
  </body>
</html>
