<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH="0" MARGINHEIGHT="0">

    <form action="login.php" method="POST">

        <?php
        $conn = mysql_connect("localhost", "root", "") or die("Error");
        ?>
        <center><img src="kcelogo.jpeg"></img></center>
        <br>
        <br>
        <table border="1" align="center" bgcolor="pink" height="150" width="350" bordercolor="grey" cellpadding="0" cellspacing="0">
            <tr>
                <td>Enter your RollNumber:</td>
                <td align="center"><input type="text" name="Rno"></td>
            </tr><br>
            <td>Password:</td>
            <td align="center"><input type="password" name="pwd"><br>
                <font size='1' color='red'>**Hint:DOB as per CBCS registration</font>
            </td>
            </tr><br>
            <tr>
                <td align="center"><input type="submit" value="Login" name="login_page" height="200"></td>
                <td align="center"><input type="reset" value="Cancel" name="logout_page"></td>
            </tr>
        </table>
        <?php
        if (isset($_POST['login_page'])) {
            $conn = mysql_connect("localhost", "root", "") or die("Error");
            if ($conn == false) {
                echo "could not connect";
            }
            mysql_select_db("cbcs") or die(mysql_error());
            session_start();
            $username = $_POST['Rno'];
            $pword = $_POST['pwd'];
            $_SESSION['login_user'] = $username;
            $query = mysql_query("SELECT * FROM login WHERE username='$username' and password='$pword'");
            $row = mysql_fetch_array($query);
            $check = $row["active"];
            $dept_check = $row["branch"];
            $semno_check = $row["semno"];
            $section_check = $row["section"];
            $_SESSION['login_department'] = $dept_check;
            $_SESSION['login_semno'] = $semno_check;
            $_SESSION['login_section'] = $section_check;
            if ($check == 1) {
                echo "<script type='text/javascript'>alert('Already given Feedback!!')</script>";
                exit;
            }

            if (mysql_num_rows($query) != 0) {
                //$a= $_SESSION['login_user'];
                echo "<script language='javascript' type='text/javascript'> location.href='Welcome.php'</script>";
            } else {
                echo "<script type='text/javascript'>alert('Wrong User Name Or Password !!!')</script>";
            }
        }
        ?>
        <?php
        if (isset($_POST['logout_page'])) {
            exit;
        } ?>
    </form>
    <center>

        <?php
        include('footer.php');
        ?>

        <?php
        $handle = fopen("counter.txt", "r");
        if (!$handle) {
            echo "could not open the file";
        } else {
            $counter = (int)fread($handle, 20);
            fclose($handle);
            $counter++;
            echo " <strong> you are visitor no " . $counter . " </strong > ";
            $handle = fopen("counter.txt", "w");
            fwrite($handle, $counter);
            fclose($handle);
        }
        ?>
    </center>
    </div>
</body>

</html>