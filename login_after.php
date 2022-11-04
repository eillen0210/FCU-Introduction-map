<HTML>

  <HEAD>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <TITLE>逢甲校園地圖</TITLE>
  </HEAD>

  <BODY>
      <style type="text/css">
          .logout{
              background-color:white;
              position:absolute;
              top:20;
              right: 20px;
           }
           .headbox {
              background-color: #99000F;
              height: 100px;
          }
          .headtext {
              position:absolute;
              top:10;
              left:15;
              color: white;
              font-family:標楷體;
          }
          .feedback{
              position:absolute;
              top:100;
              right: 10px;
          }
          .fbox{
              height: 200;
              width: 200;
          }
         
      </style>
      <div class="headbox">
          <div class="headtext"><div class="title" id="yui_3_17_2_1_1621739799830_42">
              <span style="font-family:DFKai-sb;" class="fa fa-user"></span>
              <h1 id="instance-18884-header">逢甲大學 校園地圖</h1></div></div>
      </div>
      
      
      <div class="logout">
          <table style="border:2px #cccccc solid;" cellpadding="10" border="1">
              <tr><td ALIGN="center">
                  <div class="form-group"><input type="submit" onclick="javascript:location.href='UI.php'" class="btn btn-primary btn-block" value="登出"></div><input type="hidden" name="logintoken" value="bDz3z7dcBEZq1Bco1OczJQeBtPQXoAC4"></form>
              </td>
               

          </table>
      </div>
      
      
      <div class="feedback">
      <?php $servername = "localhost";
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
                $sql = "SELECT id ,fullname, email, suggestion FROM feedback";
                $result = $conn->query($sql);
                
                if($result->num_rows>0){
                    echo'<h2>回饋表單</h2>';
                    echo'<table style="border:black solid;" cellpadding="10" border="1">'; 
                    echo'<tr>'; 
                    echo'<td>Id</td>'; 
                    echo'<td>名稱</td>'; 
                    echo'<td>Email</td>'; 
                    echo'<td>回饋</td>';
                    echo'</tr>'; 
                    while  ($row  =  $result->fetch_assoc()) { 
                        echo "<tr><td>{$row['id']}</td>
                              <td>{$row['fullname']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['suggestion']}</td></tr>";
                    }  
                    echo'</table>';
                    }else{  
                        echo  "0 results"; 
                    } 
                
                $conn->close();         
            ?>
      </div>    
    

      <style>
          #map {
           height: 450;
           left: 1px;
           width: 800;
          }
       </style>
      <div id="map"></div>
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
　  </BODY>

</HTML>