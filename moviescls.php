<?php
	class moviescls {
	
		public $searchparams = []; 
		public $qryresult;
		public $output;
		public $row;
		
		function addrecords ($db,$query,$params) {
						
			$qryresult = $db->insertrows($query,$params);

			if ($qryresult) {
				
				return "Record added sucessfully";

			} else {
				
				return "Error, record was not added";
			}

		}
	
		function listrecords ($db,$query,$params) {
						
			$qryresult = $db->getrows($query,$params);

			echo "<script>
					$(document).ready(function(){						
						$('#delid').click(function(){
							alert('anchor tag pressed');		
						});
					});
					</script>";
			
			echo "<table class='table table-striped table-bordered'>
			<tr>
			<th></th>
			<th>Title</th>
			<th>Genre</th>
			<th>Actor</th>
			</tr>";

			for ($x = 0; $x < count($qryresult); $x++) {
				
				echo "<tr>";
				echo "<td><a href=http://localhost/movies.php/?action=delete&id=" . $qryresult[$x]['id']. "id='delid'><span class='glyphicon glyphicon-trash'></span></a></td>";
				echo "<td>" . $qryresult[$x]['title'] . "</td>";
				echo "<td>" . $qryresult[$x]['genre'] . "</td>";
				echo "<td>" . $qryresult[$x]['actor'] . "</td>";
				echo "</tr>";
				
			}			
			echo "</table>";
		}
		
		function selectrecords ($db,$searchby,$genretype,$searchfor) {

			switch ($searchby) {
				case 'Title':
					$query = "select * from `movies` where title like ?";
					$searchparams = ["%".$searchfor."%"];
					break;
				case 'Genre':
					$query = "select * from `movies` where genre = ? and (title like ? or actor like ?)";
					$searchparams = [$genretype,"%".$searchfor."%","%".$searchfor."%"];
					break;
				case 'Actor':
					$query = "select * from `movies` where actor like ?";
					$searchparams = ["%".$searchfor."%"];
					break;					
			}
 			
			$qryresult = $this->listrecords($db,$query,$searchparams);
				
		}

		function deleterecord ($db,$query,$params) {
						
			$qryresult = $db->deleterow($query,$params);

			if ($qryresult) {
				
				return "Record added sucessfully";

			} else {
				
				return "Error, record was not added";
			}

		}
		
	}
?>