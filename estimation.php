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
            <input type="hidden" name="type" value="<?php echo isset($_GET["type"]) ? $_GET["type"]: ""; ?>">

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
                    <button type="submit" class="btn btn-primary form-control serch">Search</button>
                </div>

                <div class="col-md-2">
                    <button onclick="exportData()" class="btn btn-success form-control serch">Export </button>  
                </div>
            </div>
            <br>
            
        </form>  

        <?php
          require_once "connection.php";

          if ($_SERVER["REQUEST_METHOD"] === "GET") {
              $selectedPuit = isset($_GET["Secteur"]) ? $_GET["Secteur"] : "";
              $query = "";
              $query2 = "";
              if ($selectedPuit == ""){
                $query = "SELECT Secteur, besoin_eau,duree_irrigation,last_update
                        FROM secteur_cumul
                        ORDER BY last_update DESC 
                        LIMIT 16";
                $query2 = "SELECT Secteur,temps_ouverture
                        FROM temps_debut";
              } else {
                $query = "SELECT Secteur, besoin_eau,duree_irrigation,last_update
                        FROM secteur_cumul
                        WHERE Secteur = '$selectedPuit'
                        ORDER BY last_update DESC 
                        LIMIT 2";
                $query2 = "SELECT Secteur,temps_ouverture
                        FROM temps_debut
                        WHERE Secteur = '$selectedPuit'";
              }
              $result = $conn->query($query);
              $result2 = $conn->query($query2);
          }
        ?>
          
        <div id='groupTable'>
          <h3>Secteures</h3>    
          <table id="myTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>Date</th>
                <th>Secteur</th>
                <th>Besoin d'eau (m3)</th>
                <th>Temp Debut (H min sec)</th>
                <th>Durée d'irrigation estimee (H min sec)</th>
                <th>Temp Fin (H min sec)</th>
              </tr>
            </thead>
            <tbody id="myTbody">
              <?php if ($result->num_rows > 0) {
                // $dataArray = array();
                // while ($row = $result->fetch_assoc()) {
                //   $dataArray[] = array(
                //     'last_update' => $row['last_update'],
                //     'Secteur' => $row['Secteur'],
                //     'besoin_eau' => $row['besoin_eau'],
                //     'duree_irrigation' => $row['duree_irrigation']
                //   );
                // }
                $dataArray = $result->fetch_all(MYSQLI_ASSOC);
                $jsonData = json_encode($dataArray);
                
                $dataArray2 = $result2->fetch_all(MYSQLI_ASSOC);
                $jsonData2 = json_encode($dataArray2);
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
  <script>
    const dataArray = <?php echo $jsonData; ?>;
    const temps_debut = <?php echo $jsonData2; ?>;
    const myTbody = document.getElementById("myTbody")
    const objects = []
    for (let i = 0; i < dataArray.length/2; i++) {
      const todayValue = dataArray[i];
      
      const yesterdayValue = dataArray.find((element) => element.Secteur == todayValue.Secteur && element.last_update != todayValue.last_update);
      const temp_debut = temps_debut.find((element) => element.Secteur == todayValue.Secteur);
      // d'irrigation estime = besoin_eau_today * temp_irri_yesterday/ besoin_eau_yesterday
      const tmp = yesterdayValue.duree_irrigation.split(" ")
      const seconds = parseInt(tmp[0])*60*60 + parseInt(tmp[1])*60 + parseInt(tmp[2])
      const estimationSeconds = Math.round(todayValue.besoin_eau*seconds/yesterdayValue.besoin_eau)
      todayValue.estimationTime = convertSeconds(estimationSeconds)
      todayValue.temps_ouverture = temp_debut.temps_ouverture
      console.log(todayValue.temps_ouverture)
      const tmp2 = todayValue.temps_ouverture.split(" ")
      const seconds2 = estimationSeconds+(parseInt(tmp2[0])*60*60 + parseInt(tmp2[1])*60 + parseInt(tmp2[2]))
      todayValue.temp_fermuture = convertSeconds(seconds2)
      objects.push(todayValue)
    }
    

    objects.sort((a, b) => a.Secteur.localeCompare(b.Secteur));
    objects.sort((a, b) => a.Secteur.split(' ')[3].localeCompare(b.Secteur.split(' ')[3]))


    objects.forEach(item=>{
        myTbody.innerHTML += 
                `<tr>   
                  <td>  ${item.last_update}  </td>
                  <td>  ${item.Secteur}  </td>
                  <td style='background-color: #5d91ff6b;'>  ${item.besoin_eau}  </td>
                  <td>  ${item.temps_ouverture}  </td>
                  <td>  ${item.estimationTime}  </td>
                  <td>  ${item.temp_fermuture}  </td>
                </tr>`;
    })

    function convertSeconds(seconds) {
      const hours = Math.floor(seconds / 3600);
      const minutes = Math.floor((seconds % 3600) / 60);
      const remainingSeconds = seconds % 60;

      // Format the result to ensure two digits with leading zeros if needed
      const hoursString = hours.toString().padStart(2, '0');
      const minutesString = minutes.toString().padStart(2, '0');
      const secondsString = remainingSeconds.toString().padStart(2, '0');

      return `${hoursString}h ${minutesString}min ${secondsString}sec`;
    }
  </script>
</body>

</html>