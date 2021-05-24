<html>
<body>

<?php

    if (!isset($_COOKIE[$profile])) {
        echo "<span class='phpstyle'><a href="signin.html">Sign in here</a></span>"
    }
    else {
        echo  "<span class='phpstyle'>Welcome " . $profile . "</span>";
    }

?>

</body>
</html>
