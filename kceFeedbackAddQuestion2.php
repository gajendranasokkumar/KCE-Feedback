<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'connection.php';
    
        if (isset($_POST['input_id'])) {
            $setname = $connection->real_escape_string($_POST['input_id']);
            $tableCreateQuery = "CREATE TABLE IF NOT EXISTS questions ($setname VARCHAR(50), ";
    
            $tableValueQuery = "INSERT INTO questions (setname";
    
            $i = 1;
            while (isset($_POST["question_id$i"])) {
                $textValue = $connection->real_escape_string($_POST["question_id$i"]);
                $tableCreateQuery .= "q$i VARCHAR(500), ";
                $tableValueQuery .= ", q$i";
                echo $_POST["question_id$i"] . "<br />";
                $i++;
            }
    
            $tableCreateQuery = rtrim($tableCreateQuery, ', ');
            $tableCreateQuery .= ")";
    
            $tableValueQuery = rtrim($tableValueQuery, ', ') . ")";
            $tableValueQuery .= " VALUES ('$setname'";
    
            $i = 1;
            while (isset($_POST["question_id$i"])) {
                $textValue = $connection->real_escape_string($_POST["question_id$i"]);
                $tableValueQuery .= ", '$textValue'";
                $i++;
            }
            $tableValueQuery .= ")";
    
            if ($connection->query($tableCreateQuery) === true && $connection->query($tableValueQuery) === true) {
                echo "tableCreated" . "<br/>";
            } else {
                echo "Error creating table or inserting values: " . $connection->error;
            }
        } else {
            echo "ne kodutha tane irukum";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KCE FEEDBACK FORM</title>
    <link rel="stylesheet" href="kceFeedbackAddQuestion.css">
    <script src="kceFeedbackAddQuestion.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-11 col-lg-10 title_bar">
                <div class="arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                </div>
                <div class="title">
                    Create New Set
                </div>
            </div>
        </div>
        <form action="kceFeedbackAddQuestion2.php" method="post" id="addQuestionForm">
        <div class="row">
            <div class="col-12 col-md-11 col-lg-10 file_name_bar">
                <div class="label">
                    <span class="imp">*</span>
                    <label for="input_id" id="label_id">Enter set name </label>
                    <span>:</span>
                </div>
                <div class="input_box">
                    <input type="text" placeholder="Enter Set Name..." id="input_id" name="input_id" required autofocus>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-11 col-lg-10">
                <div class="question_main_box">
                    <div class="question_box_heading">
                        <div class="sno_head">
                            Sno
                        </div>
                        <div class="question_head">
                            Question
                        </div>

                    </div>
                        <div class="question_list" id="question_box-id">
                            <div class="question_box">
                                <div class="no_of_sno">
                                    01.
                                </div>
                                <div class="question">
                                    <textarea cols="55" rows="2" class="question_input"
                                        placeholder="Question..." id="question_id1" name="question_id1" required></textarea>
                                </div>

                            </div>
                           
                        </div>
                        <div class="add_button_class">
                            <button type="button" class="add_btn" id="add_btn_id">Add</button>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-11 col-lg-10 confirm_btn">
                <button class="button" type="submit"><span>Confirm</span></button>
            </div>
        </div>
        </form>
    </div>
</body>

</html>