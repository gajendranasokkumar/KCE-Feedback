<?php
    $dbname = $_GET["dbname"];
    $tablename = $_GET['tablename'];

    $serverName = '127.0.0.1';
     $userName = 'root';
     $dbPassword = 'Gajendran@04';
     $databaseName = $dbname;
     $serverPort = 3306;
 
     $statusConn =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);

     if ($statusConn->connect_error) {
        die("Connection failed: " . $statusConn->connect_error);
    }

    ///total count
    $totalConutQuery = "SELECT  COUNT(DISTINCT rollno) AS totalCount FROM $tablename";
    $totalConutQuery_fetch = $statusConn->query($totalConutQuery);
    $totalcont = $totalConutQuery_fetch->fetch_assoc();
    $total = $totalcont['totalCount'];

    ///completed count
    $completedConutQuery = "SELECT  COUNT(DISTINCT name) AS completedCount FROM $tablename WHERE session = 1";
    $completedConutQuery_fetch = $statusConn->query($completedConutQuery);
    $completedcont = $completedConutQuery_fetch->fetch_assoc();
    $completed = $completedcont['completedCount'];


    //studentsList 
    $studentsListQuery = "SELECT    DISTINCT  rollno , name FROM $tablename WHERE session = 0";
    $studentsListQuery_fetch = $statusConn->query($studentsListQuery);    
    // while($onestudent = $studentsListQuery_fetch->fetch_row()){;
    //     echo $onestudent[1]."<br>"; } 
?>

<!DOCTYPE html>
<html>
<head>
    <title>View status Of a class</title>
    <link rel="stylesheet" href="viewStatusOfClass.css">
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
                        <div class="backButtonContainer" onclick="window.location.assign('viewstatus.php');">
                            <svg class="fontArrow" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                              </svg>
                        </div>
                        <div class="headingContainer">
                            <a class="dropButton" href="dropadatabase.php?dbname=<?php echo $dbname?>&tablename=<?php echo $tablename?>" target="_self">Drop</a>
                            <a class="moveButton" href="movetohistory.php?dbname=<?php echo $dbname?>" target="_self">Move to History</a>
                        </div>
                    </div>
                    <div class="classDetailsContainer">
                        <p class="dbname"><?php echo $dbname?></p>
                        <p class="tablename"><?php echo $tablename?></p>
                        <p class="count"><span id="notcompletedCount"><?php echo $completed ?></span> / <span><?php echo $total ?></span></p>
                    </div>
                    <p class="completionDescription" id="completionDescription"></p>
                    <p class="notComHeading" id="notComHeading"></p>
                    <div class="notCompletedStudentsMainContainer" id="notCompletedStudentsMainContainer">
                        <!-- <div class="col-12 col-lg-8 singleStudent">
                            <p class="sno">1.</p>
                            <p class="rollno">717822p215</p>
                            <p class="name">gajendran</p>
                        </div> -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        let completionDescription = document.getElementById('completionDescription');
        if(<?php echo $total ?> == <?php echo $completed ?>)
        {
            completionDescription.textContent = "✓ Completed";
            completionDescription.style.color = "green";
        }
        else
        {
            completionDescription.textContent = "✕ Not Completed";
            completionDescription.style.color = "red";
        }


        let totalArray = [];
        let oneStudent = [];
        <?php
            while($onestudent = $studentsListQuery_fetch->fetch_row()){
        ?>
            oneStudent = [];
            oneStudent.push( "<?php echo $onestudent[0]; ?>");
            oneStudent.push( "<?php echo $onestudent[1]; ?>");
            console.log(oneStudent);
            totalArray.push(oneStudent);
        <?php } ?>
        console.log(totalArray);

        let statusMainContainer = document.getElementById('notCompletedStudentsMainContainer');

        let fragment = document.createDocumentFragment();

        let notComHeading = document.getElementById('notComHeading');
        notComHeading.textContent = `Not Completed Students ~ ${totalArray.length}`;

        for (let i = 0; i < totalArray.length; i++){
            let singleStatus = document.createElement('div');
            singleStatus.classList.add('col-12' ,'col-lg-8', 'singleStudent');
            singleStatus.innerHTML = `
                <p class="sno col-2 ">${i+1}.</p>
                <p class="rollno col-4 ">${totalArray[i][0]}</p>
                <p class="name col-6 ">${totalArray[i][1]}</p>
            `;

            fragment.appendChild(singleStatus);
        }

        statusMainContainer.appendChild(fragment);


        function reloadWindow(){
            window.location.reload();
        }

        setInterval(reloadWindow, 5000);
    </script>
</body>
</html>