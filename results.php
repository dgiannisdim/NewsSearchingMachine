<html>
<head><title>Search News</title>
</head>	
<link rel="stylesheet" type="text/css" href="mystyle.css">

<body>
<?php

session_start();
echo "<a href=search.php?action=back>Back to Search</a><br/ ><br/ >";
	$keywords = @$_SESSION['key'];
	$cat = @$_SESSION['cat'];
	$from = @$_SESSION['from'];
	$to = @$_SESSION['to'];
	$agency = @$_SESSION['agency'];

	
//guardian
	$url_init ='https://content.guardianapis.com/search?';
	$api_key = '&api-key=4629ed4d-03aa-4995-9538-0c80f2cb9866';
	
	if($keywords){
		@$url_search .="q=".urlencode($keywords);
	}
	if($cat){
		$url_section = "&section=".$cat;
	}
	if($from){
		$url_from = "&from-date=".$from;
	}
	if($to){
		$url_to= "&to-date=".$to;
	}
	
	
	if($agency == "guardian" || empty($agency)){
		$url = @$url_init.=$url_search.=$url_section.=$url_from.=$url_to.=$api_key;
		
		//$url = 'https://content.guardianapis.com/search?q=greece&section=politics&api-key=4629ed4d-03aa-4995-9538-0c80f2cb9866';

		$json = file_get_contents($url);
		$array = json_decode($json, true);
		$index = 0;
	}
	
	
	
	
	/*echo "<pre>";
	print_r($array['response']);
	echo "</pre>";*/
	
	
	echo "<ol>";
	while(@$array['response']['results'][$index]){
		
		$site_url = $array['response']['results'][$index]['webUrl'];
		$title = $array['response']['results'][$index]['webTitle'];
		$date = substr($array['response']['results'][$index]['webPublicationDate'], 0, 10);
		$time = substr($array['response']['results'][$index]['webPublicationDate'], 12, 7);
		$category = $array['response']['results'][$index]['sectionName'];

		echo "<div>";
		echo "<li>";
		echo "<font size='5'><a href=".$site_url.">".$title."</a></font>";
		echo "<font size='2'> [".$date."</font>";
		echo "<font size='2'>,  ".$time."]</font><br/ >";
		echo "The Guardian (".$category.")<br/ ><br/ ></li></div>";
		
		
		
		
		$index++;
	}
	
	
//nytimes
	$url_init ='https://api.nytimes.com/svc/topstories/v2/';
	$api_key = '.json?api-key=9b99bf4c4ef44df9832949f9269e91fd';
	
	if($keywords){
		$keywords = (array)explode(' ', $keywords);
	}
	if($cat){
		if($cat == "sport"){
			$url_section = $cat.=s;
		}else{
		$url_section = $cat;
		}
	}else{
		$url_section = "home";
	}
	if($from){
		$url_from = "&from-date=".$from;
	}
	if($to){
		$url_to= "&to-date=".$to;
	}
	
	if($agency == "nytimes" || empty($agency)){
		$url = @$url_init.=$url_section.=$api_key;
		
		//$url = 'https://api.nytimes.com/svc/topstories/v2/home.json?api-key=9b99bf4c4ef44df9832949f9269e91fd';

		$json = file_get_contents($url);
		$array = json_decode($json, true);
		$index = 0;
	}


	
	/*print "<pre>";
	print_r($array);
	print "</pre>";*/
	$index2 = 0;
	$index3 = 0;
	
	while(@$array['results'][$index]){
		$abstract = $array['results'][$index]['abstract'];
		$site_url = $array['results'][$index]['url'];
		$title = $array['results'][$index]['title'];
		$date = substr($array['results'][$index]['published_date'], 0, 10);
		$time = substr($array['results'][$index]['published_date'], 12, 7);
		$category = $array['results'][$index]['section'];
		
		
		$abstract = (array)explode(' ', $abstract);
		$title_x = (array)explode(' ', $title);
/*		foreach($keywords as $val){		
			foreach($abstract as $val2){
				foreach($title_x as $val3){
					if($val == $val2 || $val == $val3){ */
					

		echo "<div>";
		echo "<li>";
		echo "<font size='5'><a href=".$site_url.">".$title."</a></font>";
		echo "<font size='2'> [".$date."</font>";
		echo "<font size='2'>,  ".$time."]</font><br/ >";
		echo "The New York Times (".$category.")<br/ ><br/ ></li></p></div>";
/*					}
				}
			}
		}*/
		$index++;
	}
	
	echo "</ol>";
	
?>

</body>
</html>