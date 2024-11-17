<?php
$link=mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "root",    // Passwort
    "emensawerbeseite",      // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
3307
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$name =  $_REQUEST['Name'];
$desc = $_REQUEST['Desc'];
$gname =  $_REQUEST['GName'];
$email = $_REQUEST['email'];

$name = mysqli_real_escape_string($link, $name);
$desc = mysqli_real_escape_string($link, $desc);
$gname = mysqli_real_escape_string($link, $gname);
$email = mysqli_real_escape_string($link, $email);
if(empty($name)) {
    $name = "anonym";
}

    $sql = "
INSERT INTO ersteller (name, email)
VALUES ('$name', '$email')
";

mysqli_query($link, $sql);

$sql2 = "
INSERT INTO wunschgericht (name, beschreibung, erstellungsdatum, email_von_ersteller)
VALUES ('$gname', '$desc', current_date, '$email' )
";

mysqli_query($link, $sql2);

$sql3 = "
SELECT * FROM wunschgericht ORDER BY erstellungsdatum desc LIMIT 5
";

$data = mysqli_query($link, $sql3);

while ($row = mysqli_fetch_assoc($data)) {
 echo $row['name'],' ' , $row['beschreibung'], '<br>';
}
