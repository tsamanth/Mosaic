<?php
    $url = "https://newsapi.org/v2/top-headlines?category=general&language=en&apiKey=18413fe6fbd94296b3e8eaf042057723";

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
    $command = "SELECT *
    FROM News
    WHERE id = 1;";
    $result = $mysqli->query($command);
    while ($row = $result->fetch_row()) {
        $source_result = $row[1];
        $author_result = $row[2];
        $title_result = $row[3];
        $description_result = $row[4];
        $url_result = $row[5];
        $image_result = $row[6];
        $date_result = $row[7];
        $content_result = $row[8];
    }

print <<< ARTICLE
<!DOCTYPE html>

<html lang="en">

<head>
	<title>Article</title>
	<meta charset="UTF-8">
	<meta name="description" content="Newspaper article">
	<meta name="author" content="Tanvi Shah">
    <link href="article.css" rel = "stylesheet">
    
</head> 

<body>
    <div id = "container">
        <div id = "logo">
	    <a href = "homepage.php"><img src="logo.jpg"></a>
        </div>

        <div id = "contact-buttons">
            <div class="btn-group">
		        <a href = "contactus.php"><button class="button">Contact Us</button></a>
                <a href = "signin.php"><button class="button">Sign In</button></a>
                <a href = "subscribe.php"><button class="button">Subscribe</button></a>
            </div>
        </div>

        <div id = "header">
	    <a class = "active" href = "homepage.php"><h1>Mosaic | World</h1></a>
    
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
    </div>

    <div class = "story">
        <h1>$title_result</h1>
        <img src = "$image_result" width = "700" height = "400"></br >
        <p>
            <br/>
            Author: $author_result<br/>
            Date: $date_result <br/>
            Source: $source_result

        <p>
        $content_result<a href="$url_result"><b> (Click here to see the full article) </b></a>
            
        </p>
    </div>
	<div class = "opinion">
        <h2><a href = "world.php">Other Articles</a></h2>
        <h3><a href = "worldArticle4.php">$titles[6]</a></h3>
        <h3><a href = "worldArticle2.php">$titles[1]</a></h3>
        <h3><a href = "worldArticle5.php">$titles[7]</a></h3>

        <hr>

        <h2><a href = "opinion.php">Opinions</a></h2>
        <h3><a href = "worldOped2.php">$titles[4]</a></h3>
        <h3><a href = "worldOped3.php">$titles[5]</a></h3>

        
	</div>
</div>


</body>


</html>
ARTICLE;

?>
