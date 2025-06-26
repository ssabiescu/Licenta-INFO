<?php
session_start();
session_unset();
session_destroy();
header("Location: /SmileTrack/pages/home.php");
exit();
