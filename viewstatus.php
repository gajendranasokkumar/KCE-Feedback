<?php 
     $serverName = '127.0.0.1';
     $userName = 'root';
     $dbPassword = 'Gajendran@04';
     $databaseName = 'admin';
     $serverPort = 3306;
 
     $statusConn =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);

     if ($statusConn->connect_error) {
        die("Connection failed: " . $statusConn->connect_error);
    }
    $retriveData = "SELECT DISTINCT * FROM alldbname";
    $result_fetch = $statusConn->query($retriveData);
?>





<!DOCTYPE html>
<html>
<head>
    <title>View status</title>
    <link rel="stylesheet" href="viewstatus.css">
    <link rel = "icon" href = "https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <style>
        .backButtonContainer{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12  uploadMainContainer">
                <div class="col-12 col-lg-10 reportMainContainer">
                    <div class="mainTopcontainer">
                        <div class="backButtonContainer" onclick="window.location.assign('admin.php');">
                            <svg class="fontArrow" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                              </svg>
                        </div>
                        <div class="headingContainer">
                            <h1 class="feedbackHeading">Feedback Status</h1>
                        </div>
                    </div>
                    <div class="allStatusMainContainer" id="allStatusMainContainer">
                        <!-- <div class="singleStatus">
                            <div class="col-4 databasenameContainer">
                                <p class="dbname">gajendran</p>
                            </div>
                            <div class="col-4 tableContainer">
                                <p class="tablename">gajendran</p>
                            </div>
                            <div class="col-4 viewButtonContainer">
                                <a class="viewButton" href="https://www.google.com" target="_blank">View</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let resultArray = [];
        let newArrres = [];
        <?php 
        while($result = $result_fetch->fetch_assoc()) { ?>
             newArrres = [];
            newArrres.push("<?php echo $result['databasename'] ?>", "<?php echo $result['tablename'] ?>" );
            resultArray.push(newArrres);
        <?php } ?>
        console.log(resultArray);
        let statusMainContainer = document.getElementById('allStatusMainContainer');

        let fragment = document.createDocumentFragment();

        for (let i = 0; i <resultArray.length ; i++){
            let singleStatus = document.createElement('div');
            singleStatus.classList.add('singleStatus');
            singleStatus.innerHTML = `
            <div class="col-4 databasenameContainer">
                <p class="dbname">${resultArray[i][0]}</p>
            </div>
            <div class="col-4 tableContainer">
                <p class="tablename">${resultArray[i][1]}</p>
            </div>
            <div class="col-4 viewButtonContainer">
                <a class="viewButton" href="viewStatusofClass.php?dbname=${resultArray[i][0]}&tablename=${resultArray[i][1]}" target="_self">View</a>
            </div>
            `;

            fragment.appendChild(singleStatus);
        }

        statusMainContainer.appendChild(fragment);
    </script>
</body>
</html>