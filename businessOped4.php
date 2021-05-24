<?php
    $url = "https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=18413fe6fbd94296b3e8eaf042057723";

    $json = file_get_contents($url);
    $arr = json_decode($json, TRUE);
    
    $length = count($arr['articles']);
    $mysqli = new mysqli ("spring-2021.cs.utexas.edu", "cs329e_bulko_tvshah", "bogus3shrewd2hamlet", "cs329e_bulko_tvshah");

    $command = "DELETE FROM News;";
    $result = $mysqli->query($command);

    for ($i = 0; $i < $length; $i++) { 
        $source = $arr['articles'][$i]['source']['name'];
        $author = $arr['articles'][$i]['author'];
        $title = $arr['articles'][$i]['title'];
        $description = $arr['articles'][$i]['description'];
        $url = $arr['articles'][$i]['url'];
        $urlToImage = $arr['articles'][$i]['urlToImage'];
        $publishedAt = $arr['articles'][$i]['publishedAt'];
        $content = $arr['articles'][$i]['content'];
        $contentarr = explode("…", $content);
        $content = $contentarr[0];

        $command = "INSERT INTO News VALUES ('$i', '$source', '$author', '$title', '$description', '$url', '$urlToImage', '$publishedAt', '$content');";
        $result = $mysqli->query($command);
    }

    $command = "SELECT *
                  FROM News
                  WHERE id = 3;";
      
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
            <a href = "homepage.html"><img src="logo.jpg"></a>
            </div>
    
            <div id = "contact-buttons">
                <div class="btn-group">
            <a href = "contactus.html"><button class="button">Contact Us</button></a>
                    <a href = "signin.html"><button class="button">Sign In</button></a>
                    <a href = "subscribe.html"><button class="button">Subscribe</button></a>
                </div>
            </div>
    
            <div id = "header">
            <a class = "active" href = "homepage.html"><h1>Mosaic</h1></a>
        
                <br/>
            
            <ul>
                    <li><a href="world.html">World</a></li>
                    <li><a href="US.html">U.S.</a></li>
                    <li><a href="business.html">Business</a></li>
            <li><a href="opinion.html">Opinion</a></li>
                    <li><a href="arts.html">Arts</a></li>
                    <li><a href="sports.html">Sports</a></li>
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
            <h2><a href = "homepage.html">Other Articles</a></h2>
            <h3><a href = "hpArticle2.html">Apprehensions at Border Reach Highest Level in at Least 15 Years</a></h3>
            <h3><a href = "hpHeadline1.html">Driver Rams Into Officers at Capitol, Killing One and Injuring Another</a></h3>
        <h3><a href = "hpArticle3.html">As Pandemic Upends Teaching, Fewer Students Want to Pursue It</a></h3>
            <hr>
    
            <h2><a href = "opinion.html">Opinions</a></h2>
            <h3><a href = "hpOped1.html">Opinion/Op-ed: Jeff Bezos Is Taunting Politicians. Will They Take the Bait?</a></h3>
            <h3><a href = "hpOped3.html">Opinion/Op-ed: Biden Wants to Spend Billions to Fight Climate Change. It's Not Enough</a></h3>
    
            
        </div>
    </div>
    
    
    </body>
    
    
    </html>
ARTICLE;


?>