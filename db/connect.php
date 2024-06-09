<?php
$servername = "sqlsrv:Server=SETTHAP0NG\\SQLEXPRESS;Database=SL";
$username = null;
$password = null;

try {
    $db = new PDO($servername, $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>