<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="3;URL=UI.php">
    <title>登入中</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "map";
      

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        
        $Account = $_POST["Account"];
        $Password = $_POST["Password"];
        
        $sql = "SELECT id from manager where Account = '$Account' and Password = '$Password'" ;
        $result = $conn->query($sql);

        if($result->num_rows>0){
            header ('Location: login_after.php');
        }else{
            echo '<script language="javascript">';
            echo 'alert("帳號或密碼錯誤")';
            echo '</script>';
            echo '<script language="javascript">';
            echo "Location: UI.php'".$redirect."'";
            echo "</script>";
            //header ('Location: UI.html');
        }
        $conn->close();
    ?>
    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>