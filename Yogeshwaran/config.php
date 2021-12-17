<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_USERDATABASE', 'login');
   define('DB_RATINGDATABASE', 'login');
   $userdb = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_USERDATABASE);
   $ratingdb = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_RATINGDATABASE);
?>
