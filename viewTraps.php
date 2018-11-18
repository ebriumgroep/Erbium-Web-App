<?php 
include('viewTrapsServer.php');
	if (isset($_GET['edit'])) {
		$device_id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM device WHERE device_id=$device_id");

		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$client_id = $n['client_id'];
			$hardware_id = $n['hardware_id'];
			$token = $n['token'];
			$type = $n['type'];
			$Upload_Interval = $n['Upload_Interval'];
			$caught = $n['caught'];
			$tempCount = $n['tempCount'];
			$Battery_Percent = $n['Battery_Percent'];
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
                <a class="nav-link" href="contactus.html">contact us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adminOptions.html">Admin</a>
            </li>
        </ul>
        <div class="dropdown-menu" aria-labelledby="navDropDownLink">
            <a class="dropdown-item" href="#">Preferences</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Logout</a>
        </div>

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

<?php $results = mysqli_query($db, "SELECT * FROM device"); ?>
    <h2>Edit trap details below</h2>
    <form name="form" action="" method="get">
        Search trap by client ID: <input type="text" name="searchID">
        <button onclick="<?php $temp = $_GET['searchID'];$results = mysqli_query($db, "SELECT * FROM device 
          where client_id LIKE '$temp%'"); ?> ">GO</button>
    </form>
<div id="mainDivEdit">
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Client ID</th>
			<th>Hardware ID</th>
			<th>token</th>
			<th>type</th>
			<th>Upload_Interval</th>
			<th>Moths Caught</th>
			<th>temperature count</th>
			<th>Battery %</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['device_id']; ?></td>
			<td><?php echo $row['client_id']; ?></td>
			<td><?php echo $row['hardware_id']; ?></td>
			<td><?php echo $row['token']; ?></td>
			<td><?php echo $row['type']; ?></td>
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
		<label>Hardware ID</label>
		<input type="text"  required name="hardware_id" value="<?php echo $hardware_id ; ?>">
	</div>
	<div class="input-group">
		<label>Token</label>
		<input type="text"  required name="token" value="<?php echo $token ; ?>">
	</div>
	<div class="input-group">
		<label>Type</label>
		<input type="text" required  name="type" value="<?php echo $type ; ?>">
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