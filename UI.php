<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="style.css" rel="stylesheet" type="text/css">
    <TITLE>逢甲校園地圖</TITLE>
	
	</head>
	<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "" ;
        $dbname = "map"; // Create connection 
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $bsql = "SELECT b_id, b_name, b_floor, b_picture, b_history, b_la, b_lo FROM bullding";
        $bresult = $conn->query($bsql);
        
        $osql = "SELECT o_id, o_name, o_floor, o_weblink, o_data  FROM office";
        $oresult = $conn->query($osql);

       
        ?>
         <div class="headbox">
            <div class="headtext">
                <h1>逢甲大學 校園地圖</h1></div></div>
        </div>
        
        <div class="log">
            <table style="border:2px #cccccc solid;" cellpadding="10" border='1'>
                <tr><td ALIGN="center">
                    <div class="head"><div class="title" id="yui_3_17_2_1_1621739799830_42">
                        <span aria-hidden="true" class="fa fa-user"></span>
                        <h2 id="instance-18884-header">登入</h2></div></div>
                    <div class="content">
                        <form class="loginform" id="login" method="post" action="validate.php"><div class="form-group">
                        <label for="login_username">帳號 </label>
                        <input type="text" name="Account" id="login_username" class="form-control" value="" autocomplete="username"></div>
                    <div class="form-group"><label for="login_password">密碼 </label>
                        <input type="password" name="Password" id="login_password" class="form-control" value="" autocomplete="current-password"></div>
                        <div class="form-check"></div>
                        <div class="form-group"><input type="submit" class="btn btn-primary btn-block" value="登入"></div>
                        <input type="hidden" name="logintoken" value="bDz3z7dcBEZq1Bco1OczJQeBtPQXoAC4"></form>
                </td>
            </table>
        </div>
        <form action="feedback.php" method="post">
            <div class="feedback">
                <table style="border:2px #cccccc solid ;" cellpadding="10" border='1'>
                    <tr><td ALIGN="center">
                        <div class="head"><div class="title"><span aria-hidden="true" class="fa fa-user"></span>
                            <h2 id="instance-18884-header">回饋表單</h2></div></div>
                            <input type="text" class="form-control" name="fullname" placeholder="匿名"><br>
                            <input type="text" class="form-control" name="email" placeholder="EMail"><br>
                        <div class="content">
                            <form class="loginform" id="login" >
                                <div class="fbox">
                                    <textarea placeholder="如有問題，請在此回報給管理員" name="suggestion" style="height: 200px;">
                                        </textarea><br>
                                </div>
                            <div class="form-group"><input type="submit" value="傳送"></div>
                    </td>
                </table>
            </div>
        </form>
        
		<div id='map'></div>
		<script>
            function initMap(){   
            var fcu = {lat: 24.1800978, lng: 120.6478623};
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 17,mapTypeControl:true,center: fcu,mapTypeId: 'hybrid'});
            var features = [
            <?php
                foreach ($bresult as $bres) {
                    echo "{";
                    echo "position:new google.maps.LatLng(".$bres["b_la"].",".$bres["b_lo"]."),";
                    echo "contentString:'<h3>".$bres["b_name"]."</h3> 樓數：".$bres["b_floor"]." F </p>介紹：</p>".$bres["b_history"]."</p><img  src=".$bres['b_picture']." >'
                        },";
                }
            ?>
            ];
            
            function addMarker(feature){   
                var marker = new google.maps.Marker({position: feature.position,map: map,zIndex:2});
                var infowindow = new google.maps.InfoWindow({content: feature.contentString});
                marker.addListener('click', function(){infowindow.open(map, marker);});
            }
            
            for (var i = 0, feature; feature = features[i]; i++){	
                addMarker(feature);
            }
        }
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1IEyUdws4LmM6xBDWH5KI0HljuPQMl64&callback=initMap">
		</script>
	</body>
</html>