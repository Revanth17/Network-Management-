<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" href = "./bootstrap.min.css">
		<link rel = "stylesheet" href = "./bootstrap-theme.min.css">
		
		<style>
			#t1{
				padding: 15px;
				background-color: #eeeeee;
				border-bottom: solid 1px black;
			}

			#home{
				line-height: 150%;
			}

			footer
			{
				text-align: center;
				background-color: lavender;
				border-top: solid 1px black;
				bottom: 0;
				width: 100%;
				position: relative;
			}
								
		</style>

		<title>
			ANM	| Assignment - 2
		</title>
	</head>


	<body>
		<div class = "container-fluid" style = "margin: 0px; padding: 0px; width: 100%; height: 100%;">
			<div id = "t1">
				<div class = "container-fluid" style = "margin: 0px; padding: 0px;">
					<div class = "row">
						<div class = "col-md-5"></div>
						<div class = "col-md-2" style = "padding: 0;">
							<div class = "container-fluid" style = "margin: 0px; padding: 0px; text-align: center;">
								<h2><a href = './index.php'>Assignment - 2</a></h2>
							</div>
						</div>
						<div class = "col-md-5" style = "padding: 0;"></div>
					</div>
				</div>
			</div>


			<div class = "row" style = "margin: 0;">
				<ul class="nav nav-tabs">
<?php

include './split.php';

//Create connection
$connection = mysqli_connect($host, $username, $password, $database, $port);

//Check connection
if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
}

//Creating RESULTS22 table
$query = "CREATE TABLE IF NOT EXISTS RESULTS22 (id INT AUTO_INCREMENT PRIMARY KEY,
										   IP varchar(255),
										   PORT int(11) NOT NULL,
										   COMMUNITY varchar(255),
										   Interface_List LONGTEXT,
										   Interface_Name LONGTEXT,
										   metrics LONGTEXT,
										   UNIQUE KEY (IP, PORT, COMMUNITY))";
mysqli_query($connection, $query) or die("Error:" . mysqli_error($connection));

//Creating RESULTS23 table
$query = "CREATE TABLE IF NOT EXISTS RESULTS23 (id INT AUTO_INCREMENT PRIMARY KEY,
										   IP varchar(255),
										   metrics LONGTEXT,
										   UNIQUE KEY (IP))";
mysqli_query($connection, $query) or die("Error:" . mysqli_error($connection));

//Creating RESULTS21
/*
$query = "CREATE TABLE IF NOT EXISTS RESULTS21 (id INT AUTO_INCREMENT PRIMARY KEY,
										   IP varchar(255),
										   UNIQUE KEY (IP))";
mysqli_query($connection, $query) or die("Error:" . mysqli_error($connection));
*/

?>

					<li role="presentation"><a href="./index.php">Add Devices/servers to monitor</a></li>
					<li role="presentation"><a href="./add_plot.php">Add Devices/servers to plot</a></li>
					<li role="presentation"><a href="./remove.php">Remove Devices/Servers</a></li>
					<li role="presentation" class="active"><a href="./plot.php">Plot Graphs</a></li>
					<li role="presentation"><a href="./compare.php">Compare</a></li>
				</ul>
			</div><br>
			
			
			<!--Status panel-->
			<div class = "col-md-4"></div>
			<div class = "col-md-4" style = "height: 100%;">
				<div class = "container-fluid" style = "margin: 0 20px 0 20px; padding: 0px; height: 100%;">
					<div class = "row" style = "margin: 0; height: 100%; text-align: center;">
						<form action = "./plot.php" method = "get">
							<table class = "table table-bordered" style = "width: 100%; text-align: left; vertical-align: middle;">
							  <tr>
								<th>Select Metrics</th>
								<th>Enter duration interms of days</th>
							  </tr>
							  
							  <tr>
								<td>

<?php

	//Metrics table
	$match = array('Total Kbytes' => 'totalkbytes', 'CPU Utilization' => 'cpuutil', 'Requests/sec' => 'reqpersec', 'Bytes/sec' => 'bytespersec', 'Bytes/request' => 'bytesperreq');
	$list_metrics = array_keys($match);
				
	foreach($list_metrics as $metric)
	{
		echo '<input style = "margin-right: 5px;" type = "checkbox" name = "server_metrics[list][]" value = "' . $metric . '">' . $metric . '<br>';
	}

?>
			  <input style = "margin-right: 5px;" type = "checkbox" name = "server_metrics[list]" value = 'all'>Select all metrics<br>
		  
								</td>
								<td>
									<br><input type = "textbox" name = "duration" style = 'margin-left: 10px;'/>
								</td>
							</table>
							<input type = "submit" name = "button" value = 'PLOT'/><br>
						</form>
						</div>
					</div>
				</div>
					

				<div class = "col-md-12" style = "height: 100%;">
					<div class = "container-fluid" style = "margin: 10px 0 10px 0; padding: 0px; height: 100%;">
						<div class = "row" style = "margin: 0; height: 100%; text-align: center;">
							<table class = "table table-bordered" style = "width: 100%; text-align: center;">
									
<?php

if(isset($_GET['duration']))
{
	include './split.php';

	//Create connection
	$connection = mysqli_connect($host, $username, $password, $database, $port);

	//Check connection
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}

	echo '<tr style = "text-align: center; padding: 2px;">
			<th>SERVERS</th>
			<th>DEVICES</th>
		  </tr>';
	echo '<tr style = "text-align: center;">
			<td>';
	
	

	//SERVERS	
	$query = "SELECT * FROM RESULTS23";
	$result = mysqli_query($connection, $query) or die("Error:" . mysqli_error($connection));
	$num_rows = mysqli_num_rows($result);
	
	if($num_rows != 0)
	{			
		if(empty($_GET['server_metrics']))
		{
			$met_list = array_fill_keys(array_keys($match), 0);
		}		
		else
		{
			foreach($_GET['server_metrics'] as $input => $output)
			{
				if($output == "all")
				{
					$met_list = array_fill_keys(array_keys($match), 0);
				}
				else
				{
					$met_list = array_fill_keys($_GET['server_metrics']['list'], 0);
				}
			}
		}
		
		foreach($met_list as $ke => $va)
		{
			$met_list[$ke] =  colour_append();
		}

		while($row = mysqli_fetch_assoc($result))
		{
			
			$file = "./RRD files/" . $row["IP"] . ".rrd";
			
			if(file_exists($file))
			{
				$opts = array();
				array_push($opts,
								"--start", "-" . $_GET['duration'] . "d",
								"--width", "500",
								"--lower-limit", "0",
								"--slope-mode",
						//		"--units-exponent", "6",
						//		"--rigid",
								"--title=" . $row["IP"], 
						//		"--x-grid", "DAY:1:DAY:1:DAY:1:86400:%a",
						//		"--y-grid", "0:1",
						//		"--units-length", "5",
								"--units=si",
								"--grid-dash", "1:3",
								"--alt-autoscale-max",
								"--alt-y-grid",
						//		"--vertical-label=Bytes per Second",
								"VRULE:00#F00",
								"COMMENT: \\n",
								"COMMENT:\\t",
								"COMMENT:\\t",
								//"COMMENT:\\t",
								"COMMENT: MAXIMUM\\t",
								"COMMENT:  AVERAGE\\t",
								"COMMENT:  CURRENT\\n",
								"COMMENT: \\s");
							
				foreach($met_list as $key => $value)
				{
					array_push($opts, 
								"DEF:" . $match[$key] . "=" . $file . ":" . $match[$key] . ":AVERAGE",
								"VDEF:max_" . $match[$key] . "=" . $match[$key] . ",MAXIMUM",
								"VDEF:avg_" . $match[$key] . "=" . $match[$key] . ",AVERAGE",
								"VDEF:last_" . $match[$key] . "=" . $match[$key] . ",LAST",
							//	"COMMENT: \\s",
								"LINE1:" . $match[$key] . "#" . $value . ":" . $key . "\\t",
								"GPRINT:max_" . $match[$key] . ": %6.2lf %sBps\\t",
								"GPRINT:avg_" . $match[$key] . ": %6.2lf %sBps\\t",
								"GPRINT:last_" . $match[$key] . ": %6.2lf %sBps\\n");
				}

				$img_location = "./RRD files/" . $row["IP"] . "_" . $_GET['duration'] . "d.png";
				$ret = rrd_graph($img_location, $opts);

				if ($ret === FALSE)
				{
					echo "<b>Graph error: </b>".rrd_error()."\n";
				}
				else
				{
					echo "<img style = 'margin: 3px;' src = '" . $img_location . "' title = 'Comparision of Server'>";
				}		
			}
		}
		
		echo '</td>';
	}

		echo '<td>';

//DEVICES
	$query = "SELECT * FROM RESULTS22";
	$result = mysqli_query($connection, $query) or die("Error:" . mysqli_error($connection));
	$num_rows = mysqli_num_rows($result);
	
	//$add = dechex(int(hexdec("EEEEEE")/$num_rows));

	if($num_rows != 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$query = "SELECT sysName FROM RESULTS2 WHERE IP = '" . $row["IP"] . "' AND PORT = '" . $row["PORT"] . "' AND COMMUNITY = '" . $row["COMMUNITY"] . "'";
			$result = mysqli_query($connection, $query) or die("Error:" . mysqli_error($connection));
			$sysName = mysqli_fetch_assoc($result);
			
			$file = "./RRD files/" . $row["IP"] . "_" . $row["PORT"] . "_" . $row["COMMUNITY"] . ".rrd";
			$variable_line = array();
			
			if(file_exists($file))
			{
				$opts = array();
				array_push($opts,
									"--start", "-" . $_GET['duration'] . "d",
									"--width", "500",
									"--lower-limit", "0",
									"--slope-mode",
							//		"--units-exponent", "6",
							//		"--rigid",
									"--title=Device:	" . $sysName["sysName"], 
							//		"--x-grid", "HOUR:1:HOUR:2:HOUR:2:0:%H",
							//		"--y-grid", "0:1",
							//		"--units-length", "5",
									"--units=si",
									"--grid-dash", "1:3",
									"--alt-autoscale-max",
									"--alt-y-grid",
									"--vertical-label=Bytes per Second",
									"VRULE:00#F00",
									"COMMENT: \\n",
									"COMMENT:\\t",
									"COMMENT:\\t",
									"COMMENT: MAXIMUM",
									"COMMENT:      AVERAGE",
									"COMMENT:      CURRENT\\n",
									"COMMENT: \\s");
				$variable_line = explode('|', $row['Interface_List']);	
				$ifs = count($variable_line);
				$plus_array = array_fill(0, ($ifs - 1), '+');
				$cdef_in = array();
				$cdef_out = array();
				
				foreach($variable_line as $key)
				{
					array_push($opts, 
								"DEF:bytesIn_" . $key . "=" . $file . ":bytesIn" . $key . ":AVERAGE",
								"DEF:bytesOut_" . $key . "=" . $file . ":bytesOut" . $key . ":AVERAGE"
							  );
							  
					array_push($cdef_in, "bytesIn_" . $key);
					array_push($cdef_out, "bytesOut_" . $key);
				}
				
				array_push($opts,
							"COMMENT: \\s",
							"CDEF:bytesIn=" . implode(',', $cdef_in) . ',' . implode(',', $plus_array),
							"CDEF:bytesOut=" . implode(',', $cdef_out) . ',' . implode(',', $plus_array),
							"LINE1:bytesIn#00FF00:Bytes In\\t",
							"GPRINT:bytesIn:MAX: %6.2lf %sBps",
							"GPRINT:bytesIn:AVERAGE: %6.2lf %sBps",
							"GPRINT:bytesIn:LAST: %6.2lf %sBps\\n",
							"LINE1:bytesOut#0000FF:Bytes Out\\t",
							"GPRINT:bytesOut:MAX: %6.2lf %sBps",
							"GPRINT:bytesOut:AVERAGE: %6.2lf %sBps",
							"GPRINT:bytesOut:LAST: %6.2lf %sBps",
							"COMMENT: \\n");
			}
			
			$img_location = "./RRD files/" . $row["IP"] . "_" . $row["PORT"] . "_" . $row["COMMUNITY"]. "_" . $_GET['duration'] . "d.png";
			$ret = rrd_graph($img_location, $opts);

			if ($ret === FALSE)
			{
				echo "<b>Graph error: </b>".rrd_error()."\n";
			}
			else
			{
				echo "<img style = 'margin: 0;' src = '" . $img_location . "' title = 'Comparision of Server Metrics'>";
			}
			
		}
	}
}


function colour_append()
{
	$colour = dechex(rand(0, 0xFFFFFF));
	$count = strlen($colour);

	if($count < 6)
	{
		$colour = implode('', array(implode('', array_fill(0, (6 - $count), '0')), $colour));
	}
	return $colour;
}

?>
									</td>
								</tr>
							</table>
						</div>						
					</div>
				</div>
				
				
								
			</div>
			
			
			
		</div>
	</body>
	
</html>
