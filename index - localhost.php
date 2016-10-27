<!DOCTYPE html>
<html lang="en">
<head>
  <title>Coding Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
	$(document).ready(function(){

		$('#searchdiv').hide();
		
		$('#addrec').on('click',function(){
			
			var action = 'addrec';
			var title = $('#title').val();
			var genre = $('#genre1').val();
			var actor = $('#actor').val();
			
			if ($.trim(title) != '' && $.trim(genre) != '' && $.trim(actor != '')) {
				
				$.post('movies.php',{action: action, title: title, genre: genre, actor: actor} ,
				function (data){
					
					alert(data);
					
				});
			}
			else {

				alert("Please enter all fields");
				
			}
		});

		$('#list1,#list2').on('click',function(){
			
			var action = 'list';
			
			$.post('movies.php',{action: action} ,
			function (data){
				
				$('#output').show();			
				$('#output').html(data);
				
			});
		});

		$('#findmovies').on('click',function(){
		
			$('#output').hide();					
		
			var action = 'search';
			var searchfor = $('#searchfor').val();
			var genretype = $('#genretype').val();
			var searchby = '';
			var radios = document.getElementsByName('searchby');

			for (var i = 0, length = radios.length; i < length; i++) {
				if (radios[i].checked) {
					searchby = radios[i].value;
					// only one radio can be logically checked, don't check the rest
					break;
				}
			}			
						
			if ($.trim(searchfor) != '') {
				
				$.post('movies.php',{action:action, searchby: searchby, genretype: genretype, searchfor: searchfor} ,
				function (data){
					
					$('#output').show();			
					$('#output').html(data);
					
				});
			}
			else {

				alert("Please enter a search criteria");
				
			}
		});

		$('#showsearchform').on('click',function(){

			$('#addmoviediv').hide();
			$('#output').hide();			
			$('#searchdiv').show();
			$('#genretype').prop('disabled', true);

		});
		
		$('#showaddrec').on('click',function(){
						
			$('#searchdiv').hide();
			$('#output').hide();			
			$('#addmoviediv').show();

		});

		$('input[type=radio]').click(function (){
			var radiovalue = $('input[type=radio]:checked');
						
			if (radiovalue.val() == "Genre") {
				$('#genretype').prop('disabled', false);
			}
			else {
				$('#genretype').prop('disabled', true);
			}
			
		})
		
	});
	

  </script>
</head>
<body>
	<div class="container">
		<h2>Movies I Like</h2>
		
		<div id="addmoviediv" class="col-sm-4">

			<div class="form-group row">
				<h3>Add a record</h3>
			</div>

			<form name='addrecform' id='addrecform' method = "post">
		 
				<div class="form-group row">
					<label for="sel1">Genre list:</label>
					<select class="form-control" id="genre1">
						<option selected>Action</option>
						<option>Comedy</option>
						<option>Drama</option>
						<option>SciFi</option>
					</select>
				</div>
				
				<div class="form-group row">
					<label for="title">Title:</label>
					<input type="text" class="form-control" id="title" placeholder="Enter Title">
				</div>
		
				<div class="form-group row">
					<label for="actor">Actor:</label>
					<input type="text" class="form-control" id="actor" placeholder="Enter Actor">
				</div>

				<div class="form-group row">
					<button type="button" id="addrec" class="btn" name="addrec">Add Record</button>
					<button type="button" id="showsearchform" class="btn">Search Movies form</button>
					<button type="button" id="list1" class="btn">list Movies</button>
				</div>		
			</form>
		</div>
		
		<div id="searchdiv" class="col-sm-4">

			<div class="form-group row">
				<h3>Search for records</h3>
			</div>
			
			<form name='searchform' id="searchformovies" method = "post">		 
				
				<div class="form-group row">
					<label for="searchby">Search by:</label>
					<label><input type="radio" name="searchby" value="Title" id="searchby1">Title</label>
					<label><input type="radio" name="searchby" value="Genre" id="searchby2">Genre</label>
					<label><input type="radio" name="searchby" value="Actor" id="searchby3">Actor</label>
				</div>

				<div class="form-group row" id='genre2'>
					<label for="sel1">Genre list:</label>
					<select class="form-control" id="genretype">
						<option selected></option>
						<option>Action</option>
						<option>Comedy</option>
						<option>Drama</option>
						<option>SciFi</option>
					</select>
				</div>
				
				<div class="form-group row">
					<label for="searchfor">Search For:</label>
					<input type="text" class="form-control" id="searchfor" placeholder="Search Criteria">
				</div>

				<div class="form-group row">
					<button type="button" id="showaddrec" class="btn" name="showaddrec">Add Record form</button>
					<button type="button" id="findmovies" class="btn">Search Movies</button>
					<button type="button" id="list2" class="btn">list Movies</button>
				</div>		
			</form>
			
				
		</div>
		<div id="output" class="row"></div>		
	</div>
	
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
