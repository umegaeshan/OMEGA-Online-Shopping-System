<?php
session_start();
session_unset(); // Removes all variables
session_destroy(); // Destroys the session

header("Location: index.php"); // Connects to your index file
exit();
