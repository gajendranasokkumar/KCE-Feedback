<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $newtablename = $_POST['dept'] . "_" .
                        $_POST['batch']. "_" . 
                        $_POST['sem']. "_" . 
                        $_POST['class']. "_" . 
                        $_POST['feedback'];
        $dept = $_POST['dept'];
        $batch = $_POST['batch'];
        $sem = $_POST['sem'];
        $class = $_POST['class'];
        $feedbackname = $_POST['feedback'];

        // echo $newtablename."<br>";
        $batch = $_POST['batch'];
        $deptname = $_POST['dept'];

        $serverName = '127.0.0.1';
        $userName = 'root';
        $dbPassword = 'Gajendran@04';
        $databaseName = "feedbackhistory";
        $serverPort = 3306;
    
        $connection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);
    
        if ($connection->connect_error) 
        {
            die("Couldn't connect!!!" . $connection->connect_error);
        }
        else 
        {
            $feedbacktableQuery = "CREATE TABLE IF NOT EXISTS feedbacks(dept VARCHAR(100), batch VARCHAR(50) , sem VARCHAR(10), class VARCHAR(50),feedbackname VARCHAR(100))";
            if($connection -> query($feedbacktableQuery) === TRUE)
            {
                // echo "table created";
                $insertintoTable = "INSERT INTO feedbacks(dept, batch , sem, class,feedbackname) VALUES ('$dept','$batch','$sem','$class','$feedbackname')";
                $connection -> query($insertintoTable);

                $serverName = '127.0.0.1';
                $userName = 'root';
                $dbPassword = 'Gajendran@04';
                $databaseName = $dept.$batch;
                $serverPort = 3306;

                $tableconnection =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);
                
                    $tablesQuery = "SHOW TABLES";
                    $resultRowOfAlltable = $tableconnection->query($tablesQuery);
                    $resultTable = "";

                    $questionTable = "";
                    if ($resultRowOfAlltable) {
                        while ($row = $resultRowOfAlltable->fetch_row()) {
                            if(str_ends_with($row[0] , "result") && str_starts_with($row[0] , $dept.$class))
                            {
                                $resultTable = $row[0];
                            }
                        }
                        $resultRowOfAlltable->free(); 
                        // echo $resultTable;
                    } else {
                        echo "Error fetching tables: " . $tableconnection->error;
                    }

                    //moving a entire table from one databse to another database
                    $sourceDBHost = '127.0.0.1';
                    $sourceDBUser = 'root';
                    $sourceDBPass = 'Gajendran@04';
                    $sourceDBPort = 3306;
                    $sourceDBName = $dept.$batch;
                    
                    $destinationDBHost = '127.0.0.1';
                    $destinationDBUser = 'root';
                    $destinationDBPass = 'Gajendran@04';
                    $destinationDBPort = 3306;
                    $destinationDBName = 'feedbackhistory';

                    $copyflag = 0;

                    try {
                        // Connect to the source database
                        $sourceDB = new PDO("mysql:host=$sourceDBHost;port=$sourceDBPort;dbname=$sourceDBName", $sourceDBUser, $sourceDBPass);
                        $sourceDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Connect to the destination database
                        $destinationDB = new PDO("mysql:host=$destinationDBHost;port=$destinationDBPort;dbname=$destinationDBName", $destinationDBUser, $destinationDBPass);
                        $destinationDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Table name to copy
                        $sourcetableName = $resultTable;

                        // Select data from the source table
                        $selectQuery = $sourceDB->prepare("SELECT * FROM $sourcetableName");
                        $selectQuery->execute();
                        $data = $selectQuery->fetchAll(PDO::FETCH_ASSOC);

                        $destinationtable = $newtablename;

                        // echo "Source Table Name: $sourcetableName<br>";
                        // echo "Destination Table Name: $destinationtable<br>";
                        
                        if (!empty($data)) {
                            $columns = implode(", ", array_map(function($column) {
                                return "`$column`";
                            }, array_keys($data[0])));
                        
                            // Assuming VARCHAR(100), adjust the data type as needed
                            $columnsWithType = implode(", ", array_map(function($column) {
                                return "`$column` VARCHAR(100)";
                            }, array_keys($data[0])));
                        
                            $createTableQuery = $destinationDB->prepare("CREATE TABLE IF NOT EXISTS $destinationtable ($columnsWithType)");
                            $createTableQuery->execute();

                            $truncateTableQuery = $destinationDB->prepare("TRUNCATE TABLE $destinationtable");
                            $truncateTableQuery->execute();
                        
                            // Prepare the insert query for the destination table
                            $placeholders = implode(", ", array_fill(0, count($data[0]), "?"));
                            $insertQuery = $destinationDB->prepare("INSERT INTO $destinationtable ($columns) VALUES ($placeholders)");
                        
                            // Insert each row into the destination table
                            foreach ($data as $row) {
                                $insertQuery->execute(array_values($row));
                            }
                            $copyflag = 1;
                            // echo "Table copied successfully.";
                        } else {
                            $copyflag = 2;
                            echo "Source table is empty. Cannot create destination table.";
                        }
                        

                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
            }
            else
            {
                echo "unable to create table";
            }
        }
    }
    else
    {
        $dbname =  $_GET['dbname'];
        // echo $dbname;
        $batch = substr($dbname, -2);
        $deptname = substr($dbname, 0 , -2);
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Move to history</title>
    <link rel="stylesheet" href="movetohistory.css">
    <link rel = "icon" href = "https://res.cloudinary.com/dkbwdkthr/image/upload/v1694090918/KCE%20LOGO.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 uploadMainContainer">
                <div class="reportMainContainer">
                    <div class="mainTopcontainer">
                        <div class="backButtonContainer" onclick="window.location.assign('viewstatus.php');">
                            <svg class="fontArrow" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                              </svg>
                        </div>
                        <div class="headingContainer">
                            <h1 class="feedbackHeading">Move to History</h1>
                        </div>
                    </div>
                    <div class="reportSelectionContainer">
                        <form action="movetohistory.php" method="post">
                            <input type="text" name="dept" value="<?php echo $deptname?>" readonly/>
                            <input type="text" name="batch" value="<?php echo $batch?>" readonly/>
                            <input type="text" name="sem" placeholder="Semester"/>
                            <input type="text" name="class" placeholder="Class"/>
                            <input type="text" name="feedback" placeholder="Feedback"/></br>
                            <button class="submitButton" type="submit">Move to history</button>
                        </form>
                        <br />
                        <br/>
                        <div class="col-11 col-lg-5 messageContainer" id="messageContainer">
                            <h1 id="messageDisplay">NO Results</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let messageDisplay = document.getElementById('messageDisplay');
        let messageContainer = document.getElementById('messageContainer');
        if(<?php echo $copyflag?> == 1)
        {
            messageDisplay.textContent = "✓ Success.."
            messageDisplay.style.color = "white";
            messageContainer.style.backgroundColor = "green";
        }
        else if(<?php echo $copyflag?> == 2)
        {
            messageDisplay.textContent = "✕ Failed.."
            messageDisplay.style.color = "white";
            messageContainer.style.backgroundColor = "red";
        }
        else
        {
            messageDisplay.textContent = "No results";
            messageDisplay.style.color = "gray";
        }
    </script>
</body>
</html>