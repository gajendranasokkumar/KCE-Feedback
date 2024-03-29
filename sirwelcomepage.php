<html>

<body LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH="0" MARGINHEIGHT="0">
    <form action="Questions1.php" method="POST">
        <center><img src="kcelogo.jpeg"></img></center>
        <br>
        <?php
        SESSION_START();
        $Welrno = $_SESSION['login_user'];
        $WelSemno = $_SESSION['login_semno'];
        $WelDept = $_SESSION['login_department'];
        $WelSection = $_SESSION['login_section'];
        echo "<center>";

        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>" . "Roll No : " . $Welrno . "</th>";
        echo "<th>Department : " . $WelDept . "</th>";
        echo "<th>Semester : " . $WelSemno . "</th>";
        echo "<th>Section : " . $WelSection . "</th>";
        echo "</tr>";
        echo "</table>";
        echo "</center>";
        $conn = mysql_connect("localhost", "root", "") or die("Error");
        if ($conn == false) {
            echo "could not connect";
        }
        mysql_select_db("cbcs") or die(mysql_error());
        mysql_query("create table $WelDept(SID varchar(10),Dept varchar(20),rollno varchar(20),sem_no varchar(5),stu_name varchar(35),sub_code varchar(35),sub_name varchar(35),staff_name varchar(70),Section varchar(10))");
        $res = mysql_query("select  DISTINCT sub_code,rollno,sem_no,branch,stu_name,sub_name,staff_name from student where rollno='$Welrno'and sem_no='$WelSemno'and branch='$WelDept'") or die(mysql_error());
        $num_rows = mysql_num_rows($res);
        echo "<center>";
        echo "<h3>" . "List of Subjects you have registered are   " . $num_rows . "</h3>";
        echo "<br>";
        echo "<table border='0' bgcolor='white' height='180' bordercolor='grey' cellpadding='0' cellspacing='5'>";
        echo "<tr bgcolor='#4274f4'>";
        echo "<th>S.No</th>";
        echo "<th>Subject CODE</th>";
        echo "<th>Subject Name</th>";
        echo "<th>Staff Name</th>";
        echo "</tr>";
        $i = 1;
        while ($row = mysql_fetch_array($res)) {
            $wel_sid = $i;
            echo "<tr>";
            echo "<td align='center' bgcolor='#e2deb3'>" . $i . "</td>";
            echo "<td align='center' bgcolor='#e2deb3'>" . $row['sub_code'] . "</td>";
            echo "<td bgcolor='#e2deb3'>" . $row['sub_name'] . "</td>";
            echo "<td bgcolor='#e2deb3'>" . $row['staff_name'] . "</td>";
            echo "</tr>";

            $Semno = $row['sem_no'];
            $StuName = $row['stu_name'];
            $SubC = $row['sub_code'];
            $SubN = $row['sub_name'];
            $StaffN = $row['staff_name'];
            $_SESSION["TotalSubjects"] = $num_rows;

            $sql = mysql_query("insert into $WelDept values('$wel_sid','$WelDept','$Welrno','$Semno','$StuName','$SubC','$SubN','$StaffN','$WelSection')") or die(mysql_error());

            $i = $i + 1;
            if ($sql) {
                //mysql_query("UPDATE login SET active='1' where username='$Welrno'")or die(mysql_error());		

            } else {
                echo "Error: ";
            }
        }
        echo "</table>";
        echo "</center>";
        echo "<br>";
        /*if(isset($_POST['welcome_submit']))
{
mysql_query("UPDATE login SET active='1' where username='$Welrno'")or die(mysql_error());	
}*/

        mysql_close($conn);

        $_SESSION['StudentName'] = $StuName;
        $_SESSION['SubjectCode'] = $SubC;
        $_SESSION['SubjectName'] = $SubN;
        $_SESSION['StaffName'] = $StaffN;
        $_SESSION["NxtRecord"] = $i;
        ?>
        <center>
            <font color="blue">
                <input type="submit" value="Click here to Start your Feedback Session" name="welcome_submit">
            </font>
        </center>
    </form>
</body>

</html>