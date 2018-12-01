<?php 
include('viewClientsServer.php');
	if (isset($_GET['edit'])) {
		$client_id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT client_id, full_name, username, latitude, longitude,Admin FROM client WHERE client_id=$client_id");

		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$full_name = $n['full_name'];
			$username = $n['username'];
			$latitude = $n['latitude'];
			$longitude = $n['longitude'];
			$admin= $n['Admin'];
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="jquery-3.2.1.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

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
                <a class="nav-link" href="contactus.html">Contact Us</a>
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

<?php $results = mysqli_query($db, "SELECT client_id, full_name, username, latitude, longitude, Admin FROM client"); ?>
<h2>Edit client details below</h2>
<button class="buttons" onclick="window.location.href='settings.html'">Add Client</button>
<form name="form" action="" method="get">
    Search client by name: <input type="text" name="searchName">
    <button onclick=" <?php $temp ="";$temp = $_GET['searchName'];
    $results = mysqli_query($db, "SELECT client_id, full_name, username, latitude, longitude, Admin
 FROM client where full_name LIKE '%$temp%'"); ?> ">GO</button>
</form>
<div id="mainDivEdit">
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Full name</th>
			<th>Email</th>
			<th>Latitude</th>
			<th>Longitude</th>
            <th>Admin</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['client_id']; ?></td>
			<td><?php echo $row['full_name']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['latitude']; ?></td>
			<td><?php echo $row['longitude']; ?></td>
            <td><?php echo $row['Admin']; ?></td>
			<td>
				<a href="viewClients.php?edit=<?php echo $row['client_id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="viewClientsServer.php?del=<?php echo $row['client_id']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this client?');">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	


<form method="post" action="viewClientsServer.php">

	<input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

	<div class="input-group">
		<label>Full Name</label>
		<input type="text" required name="full_name" value="<?php echo $full_name; ?>">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" required name="username" value="<?php echo $username ; ?>">
	</div>
	<div class="input-group">
		<label>Latitude</label>
		<input type="text" required name="latitude" id="lat" value="<?php echo $latitude ; ?>">
	</div>
	<div class="input-group">
        <label>Longitude</label>
        <input type="text" required name="longitude" id="long" value="<?php echo $longitude ; ?>">
    </div>
    <div class="input-group">
        <label>Admin</label>
        <input type="number" maxlength="1" required name="admin" id="admin" value="<?php echo $admin ; ?>">
    </div>
    <div id="Map" style="width:425px;height:220px;"></div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-INs4-fin3CKhBWpuSq0bTPeLKgq_YjU&callback=myGoogleMap" type="text/javascript"></script>
    <script>
        var myLat;
        var myLong;
        function myGoogleMap() {
            var mapProp= {
                center:new google.maps.LatLng(<?php echo $latitude ; ?> ,<?php echo $longitude ; ?>),
                zoom:13,
            };
            var map=new google.maps.Map(document.getElementById("Map"),mapProp);

            google.maps.event.addListener(map, 'click', function(event) {
                //myLat = event.latLng.lat();
                //myLong = event.LatLng.lng();
                //alert(myLat);
                document.getElementById("lat").value = event.latLng.lat();
                myLat = document.getElementById("lat").innerHTML;
                document.getElementById("long").value = event.latLng.lng();
                myLong = document.getElementById("long").innerHTML;
            });
            map.addListener('click', function(e) {
                //myLong = e.;
                //alert("ok: " + myLong);
                placeMarker(e.latLng, map);
            });

        }
        var marker;
        function placeMarker(position, map) {
            if (marker && marker.setMap) {
                marker.setMap(null);
            }
            marker = new google.maps.Marker({
                position: position,
                map: map
            });
            map.panTo(position);
        }

    </script>
	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save" disabled>Update</button>
		<?php endif ?>
	</div>
</form>
</div>
</body>
</html>