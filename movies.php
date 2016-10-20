<?php

	$con = mysqli_connect("localhost","root","","movies");

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$action = $_POST['action'];
	
	class movies {
		
		public $qry;
		public $qryresult;
		public $output;
		public $row;

		function addrecords ($con,$title,$genre,$actor) {
						
			$qry = "INSERT INTO `movies` (title, genre, actor)
				VALUES ('$title', '$genre', '$actor')";  
			$qryresult = mysqli_query($con,$qry);

			if (mysqli_affected_rows($con) > 0 ) {
				
				return "Record added sucessfully";

			} else {
				
				return "Error, record was not added";
			}

			return $qryresult;	
		}
	
		function listrecords ($con) {

			$qry="SELECT * FROM `movies`";
			$qryresult = mysqli_query($con,$qry);

			echo "<table class='table table-striped table-bordered'>
			<tr>
			<th>Title</th>
			<th>Genre</th>
			<th>Actor</th>
			</tr>";
			
			while($row = mysqli_fetch_array($qryresult)) {
				
				echo "<tr>";
				echo "<td>" . $row['title'] . "</td>";
				echo "<td>" . $row['genre'] . "</td>";
				echo "<td>" . $row['actor'] . "</td>";
				echo "</tr>";

			}
			echo "</table>";
		}
		
		function selectrecords ($con,$searchby,$searchfor) {

			switch ($searchby) {
				case 'Title':
					$qry = 'select * from `movies` where title= "' . $searchfor . '"';
					break;
				case 'Genre':
					$qry = 'select * from `movies` where genre= "' . $searchfor . '"';
					break;
				case 'Actor':
					$qry = 'select * from `movies` where actor= "' . $searchfor . '"';
					break;
			} 			
			
			$qryresult = mysqli_query($con,$qry);

			echo "<table class='table table-striped table-bordered'>
			<tr>
			<th>Title</th>
			<th>Genre</th>
			<th>Actor</th>
			</tr>";
			
			while($row = mysqli_fetch_array($qryresult)) {
				
				echo "<tr>";
				echo "<td>" . $row['title'] . "</td>";
				echo "<td>" . $row['genre'] . "</td>";
				echo "<td>" . $row['actor'] . "</td>";
				echo "</tr>";

			}
			echo "</table>";
				
		}
	}
	
	$m = new movies();
	
	if ($action == 'list'){
		$m->listrecords($con);
	}
	
	if ($action == 'addrec'){

		$title = $_POST['title'];	
		$genre = $_POST['genre'];
		$actor = $_POST['actor'];
	
		$wasrecordadded = $m->addrecords($con,$title,$genre,$actor);
		echo mysqli_affected_rows($con) . " " . $wasrecordadded;
	}
	
	if ($action == 'search'){

		$searchby = $_POST['searchby'];
		$searchfor = $_POST['searchfor'];

		$m->selectrecords($con,$searchby,$searchfor);
	}	
?>