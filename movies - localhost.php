<?php
	
	require_once('database.php');	
	require_once('moviescls.php');

	$action = $_REQUEST['action'];	
	
	$db = new database();	
	$m = new moviescls();
	
	if ($action == 'list'){
		
		$query="SELECT * FROM `movies`";
		$m->listrecords($db,$query,['']);
		
	}
	
	if ($action == 'addrec'){

		$title = $_POST['title'];	
		$genre = $_POST['genre'];
		$actor = $_POST['actor'];

		$query = "INSERT INTO `movies` (title, genre, actor) VALUES (?,?,?)";  
		$wasrecordadded = $m->addrecords($db,$query,[$title,$genre,$actor]);
		echo $wasrecordadded;
		
	}
	
	if ($action == 'search'){

		$searchby = $_POST['searchby'];
		$genretype = $_POST['genretype'];
		$searchfor = $_POST['searchfor'];

		$m->selectrecords($db,$searchby,$genretype,$searchfor);
	}	
	
	if ($action == 'delete'){

		$delid = $_REQUEST['id'];

		if (isset($delid)) {
			$query = "DELETE FROM `movies` WHERE id = ?";  
			$m->deleterecord($db,$query,[$delid]);
			header('Location: http://localhost/addmovies.php');
		} else {
			echo "No id received";
		}

	}	?>