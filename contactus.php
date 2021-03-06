<?php

print <<<CONTACTUS

<!DOCTYPE html>

<html lang="en">

<head>
	<title>Contact Us</title>
	<meta charset="UTF-8">
	<meta name="description" content="Msaic's Contact Us Page">
	<meta name="author" content="Victor Li, Lance Chu, Tanvi Shah, Samantha Tsai">
	<link rel="stylesheet" type="text/css" href="./contactus.css">
</head>

<body>

<div id="container">
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
</div>

<div class="colmask threecol">
	<div class="colmid">
		<div class="colleft">
			<div class="col1">
				<!-- Column 1 start -->
				<h2 style="text-align: center;">About Us</h2>
				<video width="600" height="300" controls>
					<source src="contactus.mp4" type="video/mp4">
				  Your browser does not support the video tag.
				  </video>
				<!-- Column 1 end -->
			</div>
			<div class="col2">
				<!-- Column 2 start -->
				<table>
					<tr>    
						<td>
							<h2 style="text-align: center;">Contact Customer Care</h2>
						</td>
					</tr>
					<tr>
						<td>
							<a href="signin.php" class="button" style="font-size: 18px;">Manage Your Subscription</a>
						</td>
					</tr>
					</table>
				<!-- Column 2 end -->
			</div>
			<div class="col3">
				<!-- Column 3 start -->
				<h2 style="text-align: center;">Feedback Form</h2>
				<form method = "POST" action = "">
				<table>
					<tr style="padding: 5px;">
					<td>
							<label> Name:                
							<input class = "textbox" name = "name" type = "text" size = "15" /> </label>	
					</td>
					</tr>

					<tr>
					<td>
							<label> Email Address: 
							<input  class = "textbox" email = "location" type = "text" size = "15" /> </label>
					</td>
					</tr>
					
					<tr>
					<td>
						<label> Additional Comments: <br />										        
							<textarea name = "comments" rows = "10" cols = "30"> Any Feedback is Appreciated: </textarea>
						</label>
					</td>
					</tr>
				</table>
					<div class="buttons">
						<button type="submit" class="submitbtn">Submit</button>
						<button type="reset" class="resetbtn">Clear</button>
					</div>
	
				</form>
				<!-- Column 3 end -->
			</div>
		</div>
	</div>
</div>

<div id="footer">
	<h4>March 9, 2021 - Mosaic</h4>    
</div>

</body>
</html>
CONTACTUS;
?>
