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
               <!-- <img src="img.jpg" alt=""> -->
               <canvas id="myCanvas"></canvas>
            </main>
        </div>
    </div>
    
    <script>
        var data;
        function getUpdatedData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_data.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    // console.log("data : ", this.responseText)
                    data = JSON.parse(this.responseText);
                    const options = [{
                        text : data["et0"],
                        x:  702,
                        y:  7,
                    },{
                        text : data["PHASE1"],
                        x:  446,
                        y:  27,  
                    },{
                        text : data["debit6"],
                        x:  446,
                        y:  50,  
                    },{
                        text : data["last_update"],
                        x:  10,
                        y:  10,  
                    },{
                        text : data["nbre_fct"],
                        x:  701,
                        y:  26,  
                    },{
                        text : data["VOLUME6"],
                        x:  130,
                        y:  435,  
                    },{
                        text : data["VOLUME3"],
                        x:  130,
                        y:  460,  
                    },{
                        text : data["VOLUME8"],
                        x:  130,
                        y:  482,  
                    },{
                        text : data["VOLUME7"],
                        x:  130,
                        y:  503,  
                    },{
                        text : data["HRZ1AF1"]+":"+data["MNZ1AF1"]+":"+data["SCZ1AF1"],
                        x:  940,
                        y:  140,  
                    },{
                        text : data["HRZ2AF1"]+":"+data["MNZ2AF1"]+":"+data["SCZ2AF1"],
                        x:  940,
                        y:  222,  
                    },{
                        text : data["HRZ3AF1"]+":"+data["MNZ3AF1"]+":"+data["SCZ3AF1"],
                        x:  937,
                        y:  308,  
                    },{
                        text : data["HRZ4AF1"]+":"+data["MNZ4AF1"]+":"+data["SCZ4AF1"],
                        x:  937,
                        y:  387,  
                    },{
                        text : data["HRZ1AF2"]+":"+data["MNZ1AF2"]+":"+data["SCZ1AF2"],
                        x:  759,
                        y:  151,  
                    },{
                        text : data["HRZ2AF2"]+":"+data["MNZ2AF2"]+":"+data["SCZ2AF2"],
                        x:  759,
                        y:  232,  
                    },{
                        text : data["HRZ3AF2"]+":"+data["MNZ3AF2"]+":"+data["SCZ3AF2"],
                        x:  759,
                        y:  310,  
                    },{
                        text : data["HRZ4AF2"]+":"+data["MNZ4AF2"]+":"+data["SCZ4AF2"],
                        x:  759,
                        y:  390,  
                    },{
                        text : data["VEZ1AF1"],
                        x:  872,
                        y:  183,  
                    },{
                        text : data["VEZ2AF1"],
                        x:  872,
                        y:  260,  
                    },{
                        text : data["VEZ3AF1"],
                        x:  860,
                        y:  350,  
                    },{
                        text : data["VEZ4AF1"],
                        x:  864,
                        y:  428,  
                    },{
                        text : data["VEZ1AF2"],
                        x:  670,
                        y:  190,  
                    },{
                        text : data["VEZ2AF2"],
                        x:  670,
                        y:  268,  
                    },{
                        text : data["VEZ3AF2"],
                        x:  673,
                        y:  350,  
                    },{
                        text : data["VEZ4AF2"],
                        x:  675,
                        y:  428,  
                    },{
                        text : data["ENG1AF1"],
                        x:  234,
                        y:  372,  
                    },{
                        text : data["ENG2AF1"],
                        x:  234,
                        y:  412,  
                    },{
                        text : data["ENG3AF1"],
                        x:  252,
                        y:  253,  
                    },{
                        text : data["ENG4AF1"],
                        x:  254,
                        y:  296,  
                    },{
                        text : data["ENG1AF2"],
                        x:  662,
                        y:  166,  
                    },{
                        text : data["ENG2AF2"],
                        x:  665,
                        y:  245,  
                    },{
                        text : data["ENG3AF2"],
                        x:  665,
                        y:  327,  
                    },{
                        text : data["ENG4AF2"],
                        x:  665,
                        y:  405,  
                    },{
                        text : data["HRF1AF2"]+":"+data["MNF1AF2"]+":"+data["SCF1AF2"],
                        x:  661,
                        y:  142,  
                    },{
                        text : data["HRF2AF2"]+":"+data["MNF2AF2"]+":"+data["SCF2AF2"],
                        x:  659,
                        y:  220,  
                    },{
                        text : data["HRF3AF2"]+":"+data["MNF3AF2"]+":"+data["SCF3AF2"],
                        x:  660,
                        y:  302,  
                    },{
                        text : data["HRF4AF2"]+":"+data["MNF4AF2"]+":"+data["SCF4AF2"],
                        x:  660,
                        y:  382,  
                    },{
                        text : data["PRESAP1AF1"] || data["PRESAP2AF1"],
                        x:  330,
                        y:  382,  
                    },{
                        text : data["PRESAV1AF1"] || data["PRESAV2AF1"],
                        x:  330,
                        y:  457,  
                    },{
                        text : data["PRESAP3AF1"] || data["PRESAP4AF1"],
                        x:  430,
                        y:  382,  
                    },{
                        text : data["PRESAV3AF1"] || data["PRESAV4AF1"],
                        x:  430,
                        y:  457,  
                    },{
                        text : data["PRESAP1AF2"] || data["PRESAP2AF2"] || data["PRESAP3AF2"] || data["PRESAP4AF2"],
                        x:  528,
                        y:  382,  
                    },{
                        text : data["PRESAV1AF2"] || data["PRESAV2AF2"] || data["PRESAV3AF2"] || data["PRESAV4AF2"],
                        x:  528,
                        y:  460,  
                    }]
                    loadImageAndWriteText('myCanvas', 'http://pisteinnovation.com/img.jpg', options);
                } else {
                    console.error('An error occurred during the AJAX request');
                }
            };
            xhr.send();
        }
        getUpdatedData();
        // setInterval(getUpdatedData, 35000);
        function loadImageAndWriteText(canvasId, imageUrl, options) {
        const canvas = document.getElementById(canvasId);
        const ctx = canvas.getContext('2d');

        const img = new Image();
        img.onload = () => {
            // Calculate the scale factor to maintain aspect ratio
            const scaleFactor = (document.getElementById("content").offsetWidth - 48) / img.width;
            if ((document.getElementById("content").offsetWidth - 48)<= 1280){
                canvas.width = 1028
                canvas.height = img.height* 1280/img.width
            }else{
                canvas.width = (document.getElementById("content").offsetWidth - 48);
                canvas.height = img.height * scaleFactor;
            }

            // Draw the image scaled to fit the canvas width
            ctx.drawImage(img,  0,  0, canvas.width, canvas.height);
            
            // Apply text styling
            for (const option of options){
                ctx.font = `${canvas.width/100}px Arial`;
                ctx.fillStyle = "#000";
                ctx.textAlign = "left";
                ctx.textBaseline = 'top';
                let [x,y] = convert(option.x, option.y,canvas.width,canvas.height)
                ctx.fillText(option.text, x, y);
            }
            
        };
        img.src = imageUrl;
        }

        
    
        function convert(x,y,canvas_w,canvas_h){
            return [canvas_w*x/1018,canvas_h*y/591]
        }

        
    </script>



</body>

</html>