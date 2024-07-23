<html>
    <head>
        <title>Details</title>  
        <style type="text/css">
            #in{
                display:flex;
                justify-content:center;
               
            }
            h1{
                color:#800080;
            }
            h2{
                color:red;
            }
            #col{
                justify-content:left;
            }
            #margin{
                padding : 50px;
            }
        </style>
    </head>
    <body>
    <div id="in">
       <form align="center"action="">
            <img src="logo.jpg"alt="VISHNU"width='50px'height='50px'/>
            <h4>Dr.bv.Raju Foundation&sri Vishnu Educatinoal Society's</h4>
            <h1>Smt.B.SEETHA POLYTECHNIC </h1>
            <h4>Vishnupur-Bhimavaram W.G. Dt.,</h4>
            <h4>Approved by AICTE,NewDelhi Recognised by SBTET&T,Hyd</h4>
            <h2>TRANSFER CERTIFICATE</h2>
        </form>
    </div>
    <form align = "left" action = "" id = "margin">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "student_info";

        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $name = $_POST['name'];
        $pin = $_POST['pin'];

        $sql = "SELECT * FROM info WHERE name = '$name' AND pin = '$pin'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h4>S.No : " . $row['S_NO']."</h4><br>";
            echo "<h4>Admn.No : " . $row['ADMN_NO']."</h4><br>";
            echo "<h4>PIN : " . $row['PIN'] . "</h3><br>";
            echo "<h4>Name of the student in full : " . $row['NAME'] . "</h4><br>";
            echo "<h4>Name of the father/Gaurdian : " . $row['FATHER NAME'] . "</h4><br>";
            echo "<h4>Nationality : " . $row['NATIONALITY'] . "</h4><br>";
            echo "<h4>Category: " . $row['CATEGORY'] . "<h4><br>";
            echo "<h4>Date of birth as eneterd in admission register : " . $row['DOB'] . "</h4><br>";
            echo "<h4>Date on which he/she was admitted in the institution : " . $row['DATE_OF_ADMISSION'] . "</h4><br>";
            echo "<h4>Class of Admission: " . $row['CLASS_OF_ADMISSION'] . "</h4><br>";
            echo "<h4>Scholarship: " . $row['SCHOLARSHIP'] . "</h4><br>";
            echo "<h4>Study at time of leaving : " . $row['STUDY_AT_TIME_OF_LEAVING'] . "</h4><br>";
            echo "<h4>Date of leaving the institution : " . $row['DATE_OF_LEAVING'] . "</h4><br>";
            echo "<h4>Date of transfer certificate : " . $row['DATE_OF_TC'] . "</h4><br>";
            echo "<h4>Reason for applying for TC : " . $row['REASON_FOR_TC'] . "</h4><br>";
            echo "<h4>Conduct and Character : " . $row['CONDUCT_CHARACTER'] . "</h4><br>";  
            
            } else {
            echo "No user found with the provided NAME and PIN.";
        }

        $conn->close();
        ?>
    </form>
    </body>
</html>