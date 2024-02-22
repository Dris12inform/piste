<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>IRRIGATION Application</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        @media (max-width: 550px) {


            #content {
                flex: 1;
                padding: 20px;
                margin-left: 180px;

            }

            #sidebar {
                background-color: #333;
                color: #fff;
                padding: 20px;
                /*width: 20px; */
                height: 100vh;
                position: fixed;
            }
        }
        

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        h2 {
            font-size: 30px;

        }

        #connection {
            font-size: 1.3em;
            text-align: center;
        }

       .nowrap {
        white-space: nowrap;
    }
        /* Sidebar Styles */
        #sidebar {
            background-color: #333;
            color: #fff;
            padding: 20px;
            width: 204px;
            /* Adjust the width as needed */
            height: 100vh;
            /* Full height of the viewport */
            position: fixed;
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
            /*min-width: 160px;*/
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
            flex: 1;
            padding: 20px;
            margin-left: 185px;
            /* Same as sidebar width */
            
        }

        /* Rest of your CSS styles */

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

        .float-right {
            color: #888;
            margin-bottom: 50px;
            font-size: 20px;
            margin-right: 20px;
        }

        .connecte {
            text-align: center;

        }
        .conne{
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar">
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
                    </ul>
                </div>
            </nav>

            <!-- partial:index.partial.html -->
            <div id="content">
                <div class="conne";>
                    <h2>IRRIGATION Application <small id="connection"></small></h2>
                    <h3 class="float-right">Last update : <span id="last_update"></span>
                    </h3>
                </div>


                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Information</th>
                        <th>Valeur</th>

                    </tr>
                    <tr>
                        <td>Phase 1(A) </td>
                        <td id="PHASE1"></td>

                    </tr>
                    <tr>
                        <td>Et0 </td>
                        <td id="et0"></td>

                    </tr>
                    <tr>
                        <td>Entrée (m3) </td>
                        <td id="entree"></td>

                    </tr>
                     <tr>
                        <td>sortie-estimee (m3) </td>
                        <td id="sortie-estimee"></td>

                    </tr>
                    <tr>
                        <td>Sortie-réel (m3) </td>
                        <td id="sortie-reel"></td>

                    </tr>
                </table>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Puit</th>
                        <th>Volume d'eau (m3)</th>
                        <th>débit (m3/h)</th>
                        <th>état</th>

                    </tr>
                    <tr>
                        <td>Puit 6 </td>
                        <td id="VOLUME6"></td>
                        <td id="debit6"></td>
                        <td id="etat6"></td>

                    </tr>
                    <tr>
                        <td>Puit 3 </td>
                        <td id="VOLUME3"></td>
                        <td id="debit3"></td>
                        <td id="etat3"></td>
                    </tr>
                    <tr>
                        <td>Puit 7 </td>
                        <td id="VOLUME7"></td>
                        <td id="debit7"></td>
                        <td id="etat7"></td>

                    </tr>
                    <tr>
                        <td>Puit 8 </td>
                        <td id="VOLUME8"></td>
                        <td id="debit8"></td>
                        <td id="etat8"></td>
                    </tr>
                </table>




                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Secteur</th>
                        <th>Besoin d'eau (m3)</th>
                        <th>Volume d'eau (m3)</th>
                        <th>Engrais (l)</th>
                        <th>Heure d'ouverture (H min sec)</th>
                        <th>Pression avant filtre (bar)</th>
                        <th>Pression après filtre (bar)</th>
                        <th>Durée d'irrigation (H min sec)</th>
                        <th>Durée de fertigation (H min sec)</th>
                        <th>Surface (Ha)</th>
                    </tr>
                    <tr>
                        <td class="nowrap">Secteur 1 – AF1</td>
                        <td id="BEZ1AF1"></td>
                        <td id="VEZ1AF1"></td>
                        <td id="ENG1AF1"></td>
                        <td class="nowrap">
                            <span id="HROP1"></span>h <span id="MINOP1"></span>min <span id="SECOP1"></span>sec
                            </span>
                        <td id="PRESAV1AF1"></td>
                        <td id="PRESAP1AF1"></td>
                        <td >
                            <span id="HRZ1AF1"></span>h <span id="MNZ1AF1"></span>min <span id="SCZ1AF1"></span>sec
                        </td>
                        <td class="nowrap">
                            <span id="HRF1AF1"></span>h <span id="MNF1AF1"></span>min <span id="SCF1AF1"></span>sec
                        </td>
                        <td id="Zone1_surface"></td>
                    </tr>
                    <tr>
                        <td>Secteur 2 – AF1</td>
                        <td id="BEZ2AF1"></td>
                        <td id="VEZ2AF1"></td>
                        <td id="ENG2AF1"></td>
                        <td class="nowrap">
                            <span id="HROP2"></span>h <span id="MINOP2"></span>min <span id="SECOP2"></span>sec
                        </td>
                        <td id="PRESAV2AF1"></td>
                        <td id="PRESAP2AF1"></td>
                        <td class="nowrap">
                            <span id="HRZ2AF1"></span>h <span id="MNZ2AF1"></span>min <span id="SCZ2AF1"></span>sec
                        </td>
                        <td class="nowrap">
                            <span id="HRF2AF1"></span>h <span id="MNF2AF1"></span>min <span id="SCF2AF1"></span>sec
                        </td>
                        <td id="Zone2_surface"></td>
                    </tr>
                    <tr>
                        <td>Secteur 3 – AF1</td>
                        <td id="BEZ3AF1">
                       <td id="VEZ3AF1"></td>
                       <td id="ENG3AF1"></td>
                        <td class="nowrap">
                            <span id="HROP3"></span>h <span id="MINOP3"></span>min <span id="SECOP3"></span>sec
                        </td>
                        <td id="PRESAV3AF1"></td>
                        <td id="PRESAP3AF1"></td>
                        <td class="nowrap">
                            <span id="HRZ3AF1"></span>h <span id="MNZ3AF1"></span>min <span id="SCZ3AF1"></span>sec
                        </td>
                        <td>
                            <span id="HRF3AF1"></span>h <span id="MNF3AF1"></span>min <span id="SCF3AF1"></span>sec
                        </td>
                        <td id="Zone3_surface"></td>
                    </tr>
                    <tr>
                        <td>Secteur 4 – AF1</td>
                        <td id="BEZ4AF1"></td>
                        <td id="VEZ4AF1"></td>
                        <td id="ENG4AF1"></td>
                        <td class="nowrap">
                            <span id="HROP4"></span>h <span id="MINOP4"></span>min <span id="SECOP4"></span>sec
                        </td>
                        <td id="PRESAV4AF1"></td>
                        <td id="PRESAP4AF1"></td>
                        <td class="nowrap">
                        <span id="HRZ4AF1"></span>h <span id="MNZ4AF1"></span>min <span id="SCZ4AF1"></span>sec
            </td>
            <td>
                <span id="HRF4AF1"></span>h <span id="MNF4AF1"></span>min <span id="SCF4AF1"></span>sec
            </td>
            <td id="Zone4_surface"></td>
            </tr>
            <tr>
                <td>Secteur 1 – AF2</td>
                <td id="BEZ1AF2"></td>
                <td id="VEZ1AF2"></td>
                <td id="ENG1AF2"></td>  
                <td>
                    <span id="HROP5"></span>h <span id="MINOP5"></span>min <span id="SECOP5"></span>sec
                </td>
                <td id="PRESAV1AF2"></td>
                <td id="PRESAP1AF2"></td>
                <td>
                    <span id="HRZ1AF2"></span>h <span id="MNZ1AF2"></span>min <span id="SCZ1AF2"></span>sec
        </td>
        <td>
            <span id="HRF1AF2"></span>h <span id="MNF1AF2"></span>min <span id="SCF1AF2"></span>sec
        </td>
        <td id="Zone5_surface"></td>
        </tr>
        <tr>
            <td>Secteur 2 – AF2</td>
            <td id="BEZ2AF2"></td>
            <td id="VEZ2AF2"></td>
            <td id="ENG2AF2"></td>    
            <td class="nowrap">
                <span id="HROP6"></span>h <span id="MINOP6"></span>min <span id="SECOP6"></span>sec
            </td>
            <td id="PRESAV2AF2"></td>
            <td id="PRESAP2AF2"></td>
               <td class="nowrap"> <span id="HRZ2AF2"></span>h <span id="MNZ2AF2"></span>min <span id="SCZ2AF2"></span>sec
            </td>
            <td class="nowrap">
                <span id="HRF2AF2"></span>h <span id="MNF2AF2"></span>min <span id="SCF2AF2"></span>sec
            </td>
            <td id="Zone6_surface"></td>
        </tr>
        <tr>
            <td>Secteur 3 – AF2</td>
            <td id="BEZ3AF2"></td>
            <td id="VEZ3AF2"></td>
            <td id="ENG3AF2"></td>
            <td class="nowrap">
                <span id="HROP7"></span>h <span id="MINOP7"></span>min <span id="SECOP7"></span>sec
            </td>
            <td id="PRESAV3AF2"></td>
            <td id="PRESAP3AF2"></td>
            <td class="nowrap">
                <span id="HRZ3AF2"></span>h <span id="MNZ3AF2"></span>min <span id="SCZ3AF2"></span>sec
            </td>
            <td class="nowrap">
                <span id="HRF3AF2"></span>h <span id="MNF3AF2"></span>min <span id="SCF3AF2"></span>sec
            </td>
            <td id="Zone7_surface"></td>
        </tr>
        <tr>
            <td>Secteur 4 – AF2</td>
            <td id="BEZ4AF2"></td>
            <td id="VEZ4AF2"></td>
            <td id="ENG4AF2"></td>
            <td>
                <span id="HROP8"></span>h <span id="MINOP8"></span>min <span id="SECOP8"></span>sec
            </td>
            <td id="PRESAV4AF2"></td>
            <td id="PRESAP4AF2"></td>
            <td>
                <span id="HRZ4AF2"></span>h <span id="MNZ4AF2"></span>min <span id="SCZ4AF2"></span>sec
            </td>
            <td>
                <span id="HRF4AF2"></span>h <span id="MNF4AF2"></span>min <span id="SCF4AF2"></span>sec
            </td>
            <td id="Zone8_surface"></td>
        </tr>

        </table>
    </div>
    </div>
    </div>

    <script>
        var data;

        function getUpdatedData(callback) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_data.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    console.log("data : ", this.responseText)
                    data = JSON.parse(this.responseText);
                    callback();
                } else {
                    console.error('An error occurred during the AJAX request');
                }
            };
            xhr.send();
        }

        function updateTableWithData() {
            var statusText = document.getElementById("connection");
            for (var champ in data) {
                var element = document.getElementById(champ);
                if (element) {
                    console.log("champ : ", champ, " value : ", data[champ])
                    element.innerHTML = data[champ];
                }
            }

            console.log("isConnect : ", data["isConnect"]);
            if (data["isConnect"] == 1) {
                statusText.textContent = 'Connected';
                statusText.style.color = 'green';
            } else {
                statusText.textContent = 'Disconnected';
                statusText.style.color = 'red';
            }
        }

        function fetchData() {
            console.log("fetchData");
            getUpdatedData(updateTableWithData);
        }

        fetchData();
        setInterval(fetchData, 35000);


        function updateTableWithData() {
            var statusText = document.getElementById("connection");
            for (var champ in data) {
                var element = document.getElementById(champ);
                if (element) {
                    console.log("champ : ", champ, " value : ", data[champ]);
                    if (champ === "etat6" || champ === "etat3" || champ === "etat7" || champ === "etat8") {
                        element.innerHTML = data[champ] == 1 ? "Marche" : "Arrêt";
                    } else {
                        element.innerHTML = data[champ];
                    }
                }
            }

            console.log("isConnect : ", data["isConnect"]);
            if (data["isConnect"] == 1) {
                statusText.textContent = 'Connected';
                statusText.style.color = 'green';
            } else {
                statusText.textContent = 'Disconnected';
                statusText.style.color = 'red';
            }





            for (var i = 1; i <= 4; i++) {
        for (var j = 1; j <= 2; j++) {
            var pressureElement = document.getElementById('PRESAV' + i + 'AF' + j);
            var pressureAfterElement = document.getElementById('PRESAP' + i + 'AF' + j);
            if (pressureElement || pressureAfterElement) {
                if (pressureElement) {
                    // Log the innerHTML of pressureElement
                    console.log("innerHTML of PRESAV" + i + "AF" + j + ":", pressureElement.innerHTML);

                    // Trim the value and parse it to float
                    var pressureValue = parseFloat(pressureElement.innerHTML.trim());
                    console.log("Pressure Value for PRESAV" + i + "AF" + j + ":", pressureValue);

                    if (pressureValue !== 0.00) {
                        var rowElement = pressureElement.closest('tr');
                        rowElement.style.backgroundColor = '#87CEEB';

                        console.log("Row colored blue for PRESAV" + i + "AF" + j); // Log when a row is colored blue
                    }
                }
                if (pressureAfterElement) {
                    // Log the innerHTML of pressureAfterElement
                    console.log("innerHTML of PRESAP" + i + "AF" + j + ":", pressureAfterElement.innerHTML);

                    // Trim the value and parse it to float
                    var pressureAfterValue = parseFloat(pressureAfterElement.innerHTML.trim());
                    console.log("Pressure Value for PRESAP" + i + "AF" + j + ":", pressureAfterValue);

                    if (pressureAfterValue !== 0.00) {
                        var rowElement = pressureAfterElement.closest('tr');
                        rowElement.style.backgroundColor = '#87CEEB';

                        console.log("Row colored blue for PRESAP" + i + "AF" + j); // Log when a row is colored blue
                    }
                }
            }
        }
    }






        }
    </script>



</body>

</html>