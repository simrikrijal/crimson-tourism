<?php
// Starts the session!

session_start();
$sessionId = session_id(); 
$_SESSION['time'] = time(); 
?>