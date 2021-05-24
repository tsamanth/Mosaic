<!DOCTYPE html>

<html lang="en">

<head>
    <title> User Registration & Confirmation </title>
    <meta charset="UTF-8">
    <link href="credentials.css" rel = "stylesheet">
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
            <a class = "active" href = "homepage.php"><h1>Mosaic | Subscribe</h1></a>
        
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
        <div id = "credentials">
            <form method = "POST" name = 'myForm'>
            <h3> User Registration & Confirmation </h3>
                <?php
                    $user = $_POST["user"];
                    $pwd = $_POST["pwd"];
                    echo "<table><tr><td>Username:</td>";
                    echo "<td> <input type = 'text' id = 'user' /> </td>";
                    echo "</tr> <tr>";
                    echo "<td>Password:</td>";
                    echo "<td> <input type = 'text' id = 'pwd' /> </td>";
                    echo "</tr> <tr> <td>";
                    echo "<input type = 'reset' value = 'Reset'/> <br><br> ";
                    echo "<input type = 'button' onclick = \"ajaxFunction('$user','$pwd')\" value = 'Register'/> <br><br> ";
                    echo "</td> </tr>	</table>";  
                ?>
            </form>  
            <div id = 'ajaxDiv'> </div>
        </div>
    </div>
   </body>
   <script language = "javascript" type = "text/javascript">
        function ajaxFunction(user, pwd){

            var ajaxVar;  
            ajaxVar = new XMLHttpRequest();
            
            // Create a function that will receive data sent from the server and will update
            // the div section in the same page.
            var ajaxDisplay = document.getElementById('ajaxDiv');	
            ajaxVar.onreadystatechange = function(){
                if(ajaxVar.readyState == 4){
                    var ajaxDisplay = document.getElementById('ajaxDiv');
                    ajaxDisplay.innerHTML = ajaxVar.responseText;
                }
            }

            var username = document.getElementById('user').value;
            var password = document.getElementById('pwd').value;

            if (username == "" || password == ""){
                ajaxDisplay.innerHTML = "Please fill out the required fields.";
            }
            else if(checkData(username, password) == false){
                ajaxDisplay.innerHTML = "Please make sure that your username is 6-10 characters long and that your password has an uppercase letter, lowercase letter, and a number.";
            }
            else {
                var queryString = '?user=' + username + '&pwd=' + password;
                ajaxVar.open("GET", "subscribeserver.php" + queryString, true);
                ajaxVar.send(null); 
            }
        }
        function checkData(user, pass){
            var username = String(user);
            var password = String(pass);
            if (username.length < 6 || username.length > 10){
                return false;
            }
            else if (checkSymbols(username)){
                return false;
            }
            else if (password.length < 6 || password.length > 15){
                return false;
            }
            else if (!checkPassword(password)){
                return false;
            }
            else{
                return true;
            }
        }
    
        function checkSymbols(str){
            var regex = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
            return regex.test(str);
        }


        function checkPassword(str){
            if (str.search(/[a-z]/) == -1) {
                return false;
            }
            if (str.search(/[A-Z]/) == -1) {
                return false;
            }
            if (str.search (/[0-9]/) == -1) {
                return false;
            }
            return true;
        }
    </script>

</html>
