<?php
    $url = "https://newsapi.org/v2/top-headlines?country=us&category=general&apiKey=18413fe6fbd94296b3e8eaf042057723";

    $json = file_get_contents($url);
    $arr = json_decode($json, TRUE);
    
    $length = count($arr['articles']);
    $mysqli = new mysqli ("spring-2021.cs.utexas.edu", "cs329e_bulko_tvshah", "bogus3shrewd2hamlet", "cs329e_bulko_tvshah");

    $command = "DELETE FROM News;";
    $result = $mysqli->query($command);

	$titles = array();
	$descriptions = array();
	$images = array();

    $k = 0;

    for ($i = 0; $i < $length; $i++) { 
        $source = $mysqli->real_escape_string((string) $arr['articles'][$i]['source']['name']);
        $author = $mysqli->real_escape_string((string) $arr['articles'][$i]['author']);
        $title = $mysqli->real_escape_string((string)$arr['articles'][$i]['title']);
        $description = $mysqli->real_escape_string((string)$arr['articles'][$i]['description']);
        $url = $mysqli->real_escape_string((string)$arr['articles'][$i]['url']);
        $urlToImage = $mysqli->real_escape_string((string)$arr['articles'][$i]['urlToImage']);
        $publishedAt = $mysqli->real_escape_string((string)$arr['articles'][$i]['publishedAt']);
        $content = $arr['articles'][$i]['content'];
        $contentarr = explode("…", $content);
        $content = $mysqli->real_escape_string((string)$contentarr[0]);
        
		if ($content != "" && $author != "" && $title != "" && $description !="" && $source != "" && $url != "" and $urlToImage != "" && $publishedAt !=""){	

			$command = "INSERT INTO News VALUES ('$k', '$source', '$author', '$title', '$description', '$url', '$urlToImage', '$publishedAt', '$content');";
			$result = $mysqli->query($command);
			$k++;
		}	
    }
	for($j = 0; $j<9; $j++){
		$command = "SELECT *
		FROM News
		WHERE id = $j;";
    	$result = $mysqli->query($command);
    	while ($row = $result->fetch_row()) {
			array_push($titles, $row[3]);
			array_push($descriptions, $row[4]);
			array_push($images, $row[6]);
		}
	}
    function cookies(){
	    if (!isset($_COOKIE["loggedIn"])) {
        	echo "<script> alert('You are not logged in! Please sign in.');
			window.location.href = 'signin.php';
			</script>";
	}
	    else {
                return "Welcome, " . $_COOKIE["loggedIn"] . ".";
	}
    }
   $getCookies = cookies(); 
print <<< CATEGORY

<!DOCTYPE html>

<html lang="en">

<head>
	<title>Mosaic</title>
	<meta charset="UTF-8">
	<meta name="description" content="Newspaper article">
	<meta name="author" content="Tanvi Shah">
	<link href="homepage.css" rel = "stylesheet">
    
</head> 

<body onload = "loadTitles();">
<div id = "container">
        <div id = "logo">
		<a href = "homepage.php"><img src="logo.jpg"></a>
		<p>$getCookies</p>	
	</div>
        <div id = "contact-buttons">
            <div class="btn-group">
		<a href = "contactus.php"><button class="button">Contact Us</button></a>
                <a href = "signin.php"><button class="button">Sign In</button></a>
                <a href = "subscribe.php"><button class="button">Subscribe</button></a>
            </div>
        </div>
        <div id = "header">
	    <a class = "active" href = "homepage.php"><h1>Mosaic</h1></a>
            <br/>
	    <ul>
                <li><a href="world.php">World</a></li>
                <li><a href="US.php">U.S.</a></li>
                <li><a href="business.php">Business</a></li>
		<li><a href="opinion.php">Opinion</a></li>
                <li><a href="arts.php">Arts</a></li>
                <li><a href="sports.php">Sports</a></li>
	    </ul>
	    
	</div>	
	<div class = "bcontainer">
		<div class = "banner-wrap">
			<div class = "banner-move" id = "banner">
			</div>
		</div>
	</div>
         
	<div class = "story">
	<h3><a href = "hpArticle1.php">$titles[0]</a></h3>
	<p>$descriptions[0]</p>
	<h3><a href = "hpArticle2.php">$titles[1]</a></h3>
	<p>$descriptions[1]</p>
	<h3><a href = "hpArticle3.php">$titles[2]</a></h3>
	<p>$descriptions[2]</p>
	</div>
	<div class = "opinion">
	<h3><a href = "hpOped1.php">$titles[3]</a></h3>
	<p>$descriptions[3]</p>
	<h3><a href = "hpOped2.php">$titles[4]</a></h3>
	<p>$descriptions[4]</p>
	<h3><a href = "hpOped3.php">$titles[5]</a></h3>
	<p>$descriptions[5]</p>
	</div>
	
	<div class = "headline">
	<div style = "height:220px;">
		<h3><a href = "hpHeadline1.php">$titles[6]</a></h3>
		<div class = "floatleft">
		<img src = "$images[6]" width = "250" height = "150"></br >
		</div>

		<p>$descriptions[6]</p>
		
		</div>
	<div style = "height:220px;">
		<h3><a href = "hpHeadline2.php">$titles[7]</a></h3>
	    	<div class = "floatright">
		<img src = "$images[7]" width = "250" height = "150"></br >
		</div>
		<p>$descriptions[7]</p>
	</div>
	<div style = "height:220px;">
        	<h3><a href = "hpHeadline3.php">$titles[8]</a></h3>
		<div class = "floatleft">
		<img src = "$images[8]" width = "250" height = "150"></br >
		</div>
		<p>$descriptions[8]</p>
	</div>
	</div>

    </div>	
</body>
<script>
	var title;
	const banner = document.getElementById("banner");
	var links = new Array("hpArticle1.php","hpArticle2.php","hpArticle3.php","hpOped1.php","hpOped2.php","hpOped3.php","hpHeadline1.php", "hpHeadline2.php","hpHeadline3.php");
	var titles = new Array("$titles[0]","$titles[1]","$titles[2]","$titles[3]","$titles[4]","$titles[5]","$titles[6]","$titles[7]","$titles[8]");
	function loadTitles() {
		for (i = 0; i < titles.length; i++){
			title = document.createElement("div");
			title.setAttribute("class", "banner-item");
			title.setAttribute("onclick", "location.href = '" + links[i] + "'");
			title.innerHTML = titles[i];
			banner.appendChild(title);
		}
	}
</script>
</html>
CATEGORY;

?>
