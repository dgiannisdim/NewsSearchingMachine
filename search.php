<html>
<head><title>Search News</title></head>	
<link rel="stylesheet" type="text/css" href="mystyle.css">

<body>
	<br/><br/>
	<center>
	<div>
	<h1>Search for News</h1><br /><br />
	<form action="search.php" method="POST">
		Keywords <input type="text" name="key"><br /><br />
		
		Category <select name="cat" >
				 <option value="">All...</option>
			     <option value="politics">Politics</option>
				 <option value="business">Business</option>
				 <option value="sport">Sports</option>
				 <option value="technology">Technology</option>
				 <option value="science">Science</option>
				 <option value="opinion">Opinion</option>
				 <option value="world">World</option>
				 <option value="travel">Travel</option>
				 <option value="health">Health</option>
				 <option value="books">Books</option>
	  	     </select><br /><br />
			 
		News Agency <select name="agency" >
				 <option value="">All...</option>
			     <option value="guardian">The Guardian</option>
				 <option value="nytimes">The New York Times</option>
			  
	  	     </select><br /><br />	 
			 
		From: <input type="date" name="from">&nbsp;&nbsp;&nbsp;
		To: <input type="date" name="to"><br /><br />
			 
		<input type="submit" value="Search" name="submit" class="button button1"> <a href="front.php">clear the fields</a>
	</form>


<?php
session_start();


if (isset($_POST['submit'])){
	
	$_SESSION['key'] = @$_POST['key'];
	$_SESSION['cat'] = @$_POST['cat'];
	$_SESSION['from'] = @$_POST['from'];
	$_SESSION['to'] = @$_POST['to'];
	$_SESSION['agency'] = @$_POST['agency'];

	header("Location: results.php");
}



if(@$_GET['action'] == "back"){
		session_destroy();
		header("Location: search.php");
}

?>

	</div>
	</center>
</body>
</html>