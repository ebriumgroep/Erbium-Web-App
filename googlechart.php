<?php  
 include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	session_start();
	$entry = "";
	$entry2 = "";
	$entry3 = "";
	//$user = $_POST["user"];
	$sql = "SELECT hardware_id, token from device where client_id = 21";
	$sql2 = "SELECT device_id, time_stamp from trap_count";
	$sql3 = "SELECT device_id, temperature, humidity FROM temp_humid"; //need to sort according to client
	$result = $conn->query($sql);
	$result2 = $conn->query($sql2);
	$result3 = $conn->query($sql3);
	    while($row = mysqli_fetch_array($result))  
                           {  
                                $entry .=  "['".$row["hardware_id"]."', ".$row["token"]."],";
                           } 
		while($row= mysqli_fetch_array($result2))  
                           {  
                                $entry2 .=  "['".$row["time_stamp"]."', ".$row["device_id"]."],"; 
                           } 
						   $trapno = "";
						   $temp = "";
						   $hum = "";
		while($row= mysqli_fetch_array($result3))  
                           {  
                                //$entry3 .=  "['".$row["device_id"]."', ".$row["temperature"]."',".$row["humidity"]."],"; 
								$trapno .= $row["device_id"];
								$temp .= $row["temperature"];
								$hum .= $row["humidity"];
						   } 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>
          <link rel="stylesheet" type="text/css" href="main.css">
          <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
          <script src="jquery-3.2.1.js"></script>
          <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
          <script src="modalJS.js"></script>
          <title>Erbium Project</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
		   // google.charts.load('current', {packages: ['corechart', 'bar']});
// google.charts.setOnLoadCallback(drawTitleSubtitle);
google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawTokenPerTrap);
google.charts.setOnLoadCallback(drawColumn);
google.charts.setOnLoadCallback(line);
google.charts.setOnLoadCallback(tempcolumn);

function drawTokenPerTrap() {
       var data = google.visualization.arrayToDataTable([
        ['Trap No', 'Count per trap'],
        <?php echo $entry ?>
      ]);

      var materialOptions = {
        chart: {
          title: 'Moths caught per trap',
        },
        hAxis: {
          title: 'Caught per trap',
          minValue: 0,
        },
        vAxis: {
          title: 'Trap Number'
        },
        bars: 'vertical'
      };
	  var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, materialOptions);
    }
	function drawColumn(){
		var data = google.visualization.arrayToDataTable([
        ["Trap No", "Token"],
        <?php echo $entry ?>
      ]);
	  var options = {title: 'Moths Caught'}; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('column'));
            chart.draw(data, options);
	}
	function line(){
		var data = new google.visualization.DataTable();
            // data.addColumn('string', 'Caught per trap');
            // data.addRows([
               // <?php echo $entry2 ?>
            // ]);
			var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          <?php echo $entry2 ?>
        ]);
			var options = {'title' : 'Average Temperatures of Cities',
               hAxis: {
                  title: 'Month'
               },
               vAxis: {
                  title: 'Temperature'
               },   
               pointsVisible: true	  
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.LineChart(document.getElementById('line'));
            chart.draw(data, options);
	}
	function tempcolumn(){
		var data = google.visualization.arrayToDataTable([
               ['Trap No', 'Temperature', 'Humidity'],
			   [<?php echo (int)$trapno ?>, <?php echo $temp ?>, <?php echo $hum ?>]
            ]);

            var options = {title: 'Temperature and humidity per trap'};  

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('temp'));
            chart.draw(data, options);
	}
	</script>	  
      </head>  
      <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Erbium Insect Tracker</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">

                  <li class="nav-item">
                      <a class="nav-link" href="contactus.html">contact us</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="settings.html">Settings</a>
                  </li>
              </ul>
              <div class="dropdown-menu" aria-labelledby="navDropDownLink">
                  <a class="dropdown-item" href="#">Preferences</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Logout</a>
              </div>

          </div>
      </nav>

      <!--<div id="menu">
      <label style="margin-left: 1000px">Settings</label>
      <label style="margin-left: 20px">Contact Us</label>
      <label style="margin-left: 20px">About Us</label><br><br><br>
      <a href="logout.php">Logout</a>

      </div>-->

      <!-- Tab links openCity(event, 'Traps') -->
      <div class="tab">
          <button class="tablinks" id="trapTab" onclick="openCity(event, 'Traps')">Traps</button>
          <button class="tablinks" onclick="openCity(event, 'Graphs')">Graphs</button>
          <button class="tablinks" onclick="openCity(event, 'Admin')">Admin</button>
      </div>
	  <h1>Charts</h1>
	    
  <div id="chart_div" style="width:500px;height:400px;"></div>
  <div id="column" style="width:500px;height:400px;"></div>
  <div id="line" style="width:500px;height:400px;"></div>
  <div id="temp" style="width:500px;height:400px;"></div>
  <p> ASsd: <?php echo $trapno ?> </p>
      </body>  
 </html>  