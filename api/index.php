<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Tu nic nie ma";
    exit(0);
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$pesel = $_POST['pesel'];

$mysql_host = 'localhost'; //lub jakiś adres: np sql.nazwa_bazy.nazwa.pl
$port = '3306'; //domyślnie jest to port 3306
$username = 'root';
$password = '';
$database = 'projektowanie'; //'produkty'


try{
	$pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database.';port='.$port, $username, $password );
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $records = $pdo->exec('INSERT INTO `persons` (`firstname`, `lastname`, `pesel`)	VALUES(
    '.$firstname.',
    '.$lastname.',
    '.$pesel.')');

    if ($records > 0) {
        echo 'OK';
    } else {
        echo 'BAD';
    }
}catch(PDOException $e){
	echo 'Połączenie nie mogło zostać utworzone.<br />';
}
?>
