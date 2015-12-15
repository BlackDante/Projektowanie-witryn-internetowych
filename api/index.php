<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$pesel = $_POST['pesel'];

$pattern = "/[0-9]{11}/";
$email = "kamil.m.kielbasa@gmail.com";

if (!preg_match($pattern, $pesel)) {
    echo '{"status": false}';
    exit(0);
}

$mysql_host = 'localhost'; //lub jakiś adres: np sql.nazwa_bazy.nazwa.pl
$port = '3306'; //domyślnie jest to port 3306
$username = 'root';
$password = '';
$database = 'projektowanie'; //'produkty'


try{
	$pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database.';port='.$port, $username, $password );
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // So pretty SQL Injection :)
    $query = "INSERT INTO `persons` (`firstname`, `lastname`, `pesel`)	VALUES('$firstname','$lastname',$pesel)";

    $records = $pdo->exec($query);

    $message = "Imie: $firstname, Nazwisko: $Nazwisko, Pesel: $Pesel";
    $subject = "Wyslanie formularza";
    $headers = 'From: kamil@serwer1428975.home.pl' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($email, $subject, $message);

    if ($records > 0) {
        echo '{"status": true}';
    } else {
        echo '{"status": false}';
    }
}catch(PDOException $e){
    echo '{"status": false}';
}
?>
