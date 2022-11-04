<html>

<head>
    <meta http-equiv="refresh" content="3;URL=UI.php">
    <title>申請成功</title>
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
    <div>
        <h1>感謝您的填寫!</h1>
    </div>
    <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "map";
      

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $suggestion = $_POST["suggestion"];
        

        $sql = "INSERT INTO feedback (fullname,email,suggestion) VALUES ('$fullname', '$email', '$suggestion' )";

        if ($conn->query($sql) === TRUE) {
             echo "我們將在一週內與您聯絡，請隨時注意信箱 <br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    ?>
    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>