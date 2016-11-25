<?php require_once("./includes/initialize.php"); ?>

<?php add_header(true); ?>
<?php 
redirect_to("./cgi-bin/index.py");
    echo "This is the home page for the application.";
?> 
 
<?php footer(); ?>
