<?php
    include("connection.php");
    $qsConn =  new mysqli($serverName , $userName , $dbPassword , "admin" , $serverPort);

    $questionSetQuery = "SELECT setname FROM questions";
    $questionSetColumn = $qsConn->query($questionSetQuery);
    
if (isset($_POST['upload'])) {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
        $file = $_FILES['excel_file']['tmp_name'];

        $serverName = '127.0.0.1';
        $userName = 'root';
        $dbPassword = 'Gajendran@04';
        $serverPort = 3306;
        $databaseName = $_POST['databasename'];
//// CREATING THE NEW DATABASE
        $newDBconn = new mysqli($serverName, $userName, $dbPassword);

        if ($newDBconn->connect_error) {
            die("Connection failed: " . $newDBconn->connect_error);
        }


        $newBDsql = "CREATE DATABASE IF NOT EXISTS $databaseName";
        if ($newDBconn->query($newBDsql) === TRUE) {
        echo "Database created successfully " . $databaseName . "<br/>";
        } else {
        echo "Error creating database: " . $newDBconn->error;
        }

        // $newDBconn->close();
//// NEW DATABASE CREATION END


        $conn =  new mysqli($serverName , $userName , $dbPassword , $databaseName , $serverPort);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $QsConn =  new mysqli($serverName , $userName , $dbPassword , "admin" , $serverPort);

        $questionSetname = $_POST['questionSet'];
        $tableName = $_POST['filename']; 
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (";

        $questionTableSelectionQuery = "SELECT * FROM questions WHERE setname = '$questionSetname'";
        $resultQuestionRow = mysqli_query($qsConn,$questionTableSelectionQuery);

        $qsCreateTBName = $questionSetname."question";
        $questionTableCreationQuery = "CREATE TABLE IF NOT EXISTS $qsCreateTBName (";
        $valueInsertQuery = "INSERT INTO $qsCreateTBName (";
        $valueRemQuery = " VALUES (";

        if(isset($resultQuestionRow))
        {
            $oneRow = ($resultQuestionRow)->fetch_assoc();
            // foreach($oneRow as $value)
            // {
            //     echo $value."<br>";
            // }
            foreach(array_slice($oneRow, 1 , count($oneRow),true) as $key => $value)
            {
                $questionTableCreationQuery .= $key." VARCHAR(200),";
                $valueInsertQuery .= $key.",";
                $valueRemQuery .= "'".$value."'".",";
            }

            $questionTableCreationQuery = rtrim($questionTableCreationQuery, ', ') . ")";
            $valueInsertQuery = rtrim($valueInsertQuery, ', ') . ")";
            $valueRemQuery = rtrim($valueRemQuery, ', ') . ")";

            $valueInsertQuery .= $valueRemQuery;
            $questionTableCreationQuery = $conn->real_escape_string($questionTableCreationQuery);            
            if($conn->query($questionTableCreationQuery) === true) {
                if($conn->query($valueInsertQuery) === true) {
                    echo "question Values inserted SuccessFully <br/>";
                } else {
                    echo "Failed to insert values: " . $conn->error;
                }
            } else {
                echo "Failed to create table: " . $conn->error;
            }
        }

            
        $handle = fopen($file, 'r');
        if ($handle === false) {
            die("Failed to open the file.");
        }

        $countOfRowsINserted = 0;

        $firstRow = fgetcsv($handle, 0, ',');
        if ($firstRow === false) {
            die("Failed to read the first row.");
        }

        foreach ($firstRow as $columnName) {
            $sql .= "$columnName VARCHAR(255), ";
        }

        $sql = rtrim($sql, ', ') . ")";

        if ($conn->query($sql) === TRUE) {
            echo "main student Table created successfully.<br/>";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            $values = "'" . implode("', '", $row) . "'";
            $insertSQL = "INSERT INTO $tableName VALUES ($values)";
            if ($conn->query($insertSQL) === TRUE) {
                $countOfRowsINserted++;
            } else {
                echo "Error inserting data: . $countOfRowsINserted" . $conn->error;
            }
        }
        echo $countOfRowsINserted;
        fclose($handle); 
      
    } else {
        echo 'No file was uploaded.';
    }

    
////all database name creating in admin database

$alldbTableUpdation = "CREATE TABLE IF NOT EXISTS allDbName (databasename VARCHAR(100) , tablename VARCHAR(100))";
$alldbTableUpdationINsertion = "INSERT INTO allDbName (databasename , tablename) VALUES ( '$databaseName' , '$tableName')";
if( $qsConn->query($alldbTableUpdation) === TRUE)
{
    if($qsConn->query($alldbTableUpdationINsertion) === TRUE)
    {
        echo "Successfully updated the database name in admin DB<br>";
    }
}
else
{
    echo "<br>Cannot update the database name in table";
}
///all database name creating in admin database endd
    
    $resultTableName = $tableName.$questionSetname."result";
    $createTableSql = "CREATE TABLE $resultTableName (
        rollno VARCHAR(100),
        name VARCHAR(100),
        dept VARCHAR(100),
        batch INT,
        sem INT,
        coursecode VARCHAR(10),
        coursename VARCHAR(50),
        facultyName VARCHAR(100),
    ";
    
    for ($i = 1; $i <= 20; $i++) {
        $createTableSql .= "q$i INT";
        if ($i < 20) {
            $createTableSql .= ", ";
        }
    }
    
    $createTableSql .= ")";
    
    if ($conn->query($createTableSql) === TRUE) {
        echo "result Table created successfully............<br/>";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Upload Excel and Create Database</title>
    <link rel="stylesheet" href="kceFeedbackUpload.css">
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
            <div class="col-12 uploadMainContainer">
                <div class="inputMainContainer">
                    <div class="backButtonContainer" onclick="window.location.assign('admin.php');">
                        <svg class="fontArrow" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                          </svg>
                    </div>
                    <form action="upload.php" method="POST" enctype="multipart/form-data" >
                        <h1 class="createDbMainHeading">..... Create DataBase .....</h1>
                        <br />
                        <input class="inputBox" type="text" name="databasename" placeholder="Enter DataBase Name"/>
                        <p class="inputdescription">*Eg : cse22 (dept + batch)</p>
                        <input class="inputBox" id="file-input" type="file" name="excel_file">
                        <br />
                        <input class="inputBox" type="text" name="filename" placeholder="Enter Table Name"/>
                        <p class="inputdescription">*Eg : csea (dept + class)</p>
                        <select class="inputBox" name="questionSet" id="questionSet">
                            <option>Select Feedback</option>
                            <?php 
                                if ($questionSetColumn->num_rows > 0) {
                                    while ($row = $questionSetColumn->fetch_assoc()) {
                                        $column_value = $row['setname'];
                            ?>
                                <option value="<?php echo $column_value?>"><?php echo $column_value?></option>


                            <?php
                                    }
                                } else {
                                    echo "No results found";
                                }
                            ?>
                        </select>
                        <br /><br /> 
                        <input class="uploadButton" type="submit" name="upload" value="Upload">
                    </form>
                    <div id="summa">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>