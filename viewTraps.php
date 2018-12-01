<?php 
include('viewTrapsServer.php');
	if (isset($_GET['edit'])) {
		$device_id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM device WHERE device_id=$device_id");

		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$client_id = $n['client_id'];
			$token = $n['token'];
			$description = $n['description'];
			$trap_group = $n['trap_group'];
			$Upload_Interval = $n['Upload_Interval'];
			$caught = $n['caught'];
			$tempCount = $n['tempCount'];
			$Battery_Percent = $n['Battery_Percent'];
		}

	}
?>
<?php $results = mysqli_query($db, "SELECT * FROM device"); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="jquery-3.2.1.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="modalJS.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-INs4-fin3CKhBWpuSq0bTPeLKgq_YjU&callback=allTraps" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', "#mapOfAll", function() {
                $("#showMoreModal").modal('show');
            });

        });
        function allTraps() {
            //var t = document.getElementById("userlat").valuel
            //alert(t);
            // myMap();
            //alert(userObject.longitude);
            //Also store the farm location to be the centre point
            array = [<?php while ($row = mysqli_fetch_array($results)) ?>

                [ <?php echo $row['token'] ?>, <?php echo $row['latitude'] ?>, <?php echo $row['longitude'] ?> ]
            ];
            console.log(array);
            var allTrapLocations = [
                ['trap1','-25.758972931872734','28.231539476196303'],
                ['trap2','-25.767166630316538','28.213600862304702'],
                ['trap3','-25.75510778350059','28.25282548693849']
            ];//to hold trap locations for user
            //alert(userObject.latitude);
            var map = new google.maps.Map(document.getElementById('showTrapLocationMap'), {
                zoom: 11,
                center: new google.maps.LatLng(-25.758972931872734,28.231539476196303),
                mapTypeId: google.maps.MapTypeId.MAPS
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < allTrapLocations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(allTrapLocations[i][1], allTrapLocations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(allTrapLocations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="main.html">Erbium Insect Tracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="contactus.html">contact us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adminOptions.html">Admin</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php" id="Out">Logout</a>
            </li>
        </ul>

    </div>
</nav>

	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>


    <h2>Edit trap details below</h2>

    <form name="form" action="" method="get">
        Search trap by client ID: <input type="text" name="searchID">
        <button onclick="<?php $temp = $_GET['searchID'];$results = mysqli_query($db, "SELECT * FROM device 
          where client_id LIKE '$temp%'"); ?> ">GO</button>
    </form>
<div id="mainDivEdit">
    <button id="mapOfAll">View map of all traps</button>
    <div id="showMoreModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Map of all trap locations</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="showTrapLocationMap" style="width:425px;height:220px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Client ID</th>
			<th>Token</th>
			<th>Description</th>
			<th>Group</th>
			<th>Upload_Interval</th>
			<th>Moths Caught</th>
			<th>Temperature count</th>
			<th>Battery %</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['device_id']; ?></td>
			<td><?php echo $row['client_id']; ?></td>
			<td><?php echo $row['token']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['trap_group']; ?></td>
			<td><?php echo $row['Upload_Interval']; ?></td>
			<td><?php echo $row['caught']; ?></td>
			<td><?php echo $row['tempCount']; ?></td>
			<td><?php echo $row['Battery_Percent']; ?></td>
			<td>
				<a href="viewTraps.php?edit=<?php echo $row['device_id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="viewTrapsServer.php?del=<?php echo $row['device_id']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this trap?');">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	


<form method="post" action="viewTrapsServer.php" >

	<input type="hidden" name="device_id" value="<?php echo $device_id; ?>">

	<div class="input-group">
		<label>Client ID</label>
		<input type="text" required name="client_id" value="<?php echo $client_id; ?>">
	</div>
	<div class="input-group">
		<label>Token</label>
		<input type="text"  required name="token" value="<?php echo $token ; ?>">
	</div>
	<div class="input-group">
		<label>Description</label>
		<input type="text"  required name="description" value="<?php echo $description ; ?>">
	</div>
	<div class="input-group">
		<label>Group</label>
		<input type="text" required  name="type" value="<?php echo $trap_group ; ?>">
	</div>
	<div class="input-group">
		<label>Upload_Interval</label>
		<input type="text" required  name="Upload_Interval" value="<?php echo $Upload_Interval ; ?>">
	</div>
	<div class="input-group">
		<label>Caught</label>
		<input type="text" required  name="caught" value="<?php echo $caught ; ?>">
	</div>
	<div class="input-group">
		<label>temp Count</label>
		<input type="text" required  name="tempCount" value="<?php echo $tempCount ; ?>">
	</div>
	<div class="input-group">
		<label>Battery %</label>
		<input type="text" required  name="Battery_Percent" value="<?php echo $Battery_Percent ; ?>">
	</div>
	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" disabled name="save" >Update</button>
		<?php endif ?>
	</div>
</form>
</div>
</body>
</html>