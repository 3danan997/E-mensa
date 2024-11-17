<?php
/**
 * Praktikum DBWT. Autoren:
 * Adnan und Arnd
 */
const POST_PARAM_NAME = "fname";
const POST_PARAM_EMAIL = "email";
const POST_PARAM_DATA = "cname";


$allergene_tmp = [];
$count_alrg = 0;

// Prüfung der Daten der Newsletter
function test_data()
{
    $name_correct = false;
    $mail_correct = false;
    $data_correct = false;

    $ausgabe = '';

    $file = fopen("data.txt", "a");

    if (isset($_POST[POST_PARAM_NAME])){
        $name = $_POST[POST_PARAM_NAME];
        $name = str_replace('\'', "", $name);

        if (!empty(trim($_POST[POST_PARAM_NAME]))) {
            $name_correct = true;
        } else {
            $ausgabe = "Ihr Name entspricht nicht den Vorgaben";;
        }
    }


    if (isset($_POST[POST_PARAM_DATA])){
        $data = $_POST[POST_PARAM_DATA];
        $data = str_replace('\'', "", $data);
        if ($_POST[POST_PARAM_DATA]) {
            $data_correct = true;
        } else {
            $ausgabe = "Sie müssen den Datenschutzbestimmungen zustimmen";
        }
    }

    if (isset($_POST[POST_PARAM_EMAIL])) {
        $mail = $_POST[POST_PARAM_EMAIL];
        $mail = str_replace('\'', "", $mail);
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            if (stripos($mail, "@trashmail.com") ||
                stripos($mail, "@trashmail.de") ||
                stripos($mail, "@rcpt.at") ||
                stripos($mail, "@damnthespam.at") ||
                stripos($mail, "@wegwerfmail.de")) {
                $ausgabe = "Invalid email";
            } else {
                $mail_correct = true;
            }
        } else {
            $ausgabe = "Invalid email format";
        }
    }
    if ($data_correct && $mail_correct && $name_correct) {
        $ausgabe = "Daten erfolgreich gesendet";
        $text = $name . ";" . $data . ";" . $mail;
        fwrite($file, $text . "\n");
    }
    fclose($file);
    //echo $ausgabe Fehler
    echo htmlspecialchars($ausgabe);
}



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

$sql = "
SELECT g.name, g.preis_intern, g.preis_extern, gha.code, g.id
FROM gericht g 
LEFT JOIN gericht_hat_allergen gha ON g.id = gha.gericht_id;
";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}


$sql2 = "
SELECT COUNT(g.name) AS 'numbers.g'
FROM gericht g ";

$numbers = mysqli_query($link, $sql2);
if (!$numbers) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

$sql3 = "
SELECT code, name
FROM allergen; ";

$name_of_allergene = mysqli_query($link, $sql3);
if (!$name_of_allergene) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}
// Zeigt die Gerichte und die dazugehörigen Informationen an
function show_gerichte($result, $name_of_allergene) {
    $limit = 0;
    $allergene = array();
    while ($row = mysqli_fetch_assoc($result)) {

        echo '<tr>';
        echo
        '<td>', 'f', '</td>',
        '<td>', $row['name'], '</td>',
        '<td>', number_format($row['preis_intern'], 2), '</td>',
        '<td>', number_format($row['preis_extern'], 2), '</td>';
        echo '<td>';
        $temp = $row['id'];
        while ($temp == $row['id']) {
            //echo $row['code'], " ";
            echo htmlspecialchars($row['code']), " ";
            array_push($allergene, $row['code']);
            $row = mysqli_fetch_assoc($result);
        }
        echo '</td>';
        echo '</tr>';
        $limit++;
        if ($limit == 5) {
            break;
        }
    }
    $allergene_u = array_unique($allergene);
    global $allergene_tmp;
    $allergene_tmp = $allergene_u;
    global $count_alrg;
    $count_alrg = count($allergene);

    mysqli_free_result($result);
}
// Zeigt die Liste der benutzten Allergene an
function show_allergene() {
global $name_of_allergene;
global $count_alrg;
global $allergene_tmp;
    echo '<list>';
    for($i = 0; $i < $count_alrg; $i++) {
        while ($row2 = mysqli_fetch_assoc($name_of_allergene)) {
            if (!empty($allergene_tmp[$i]) && $allergene_tmp[$i] == $row2['code']) {
                echo '<li>', htmlspecialchars($row2['name']), ' ', '</li>';
            }
        }
        mysqli_data_seek($name_of_allergene, 0);
    }
    echo '</list>';

}
//Zeigt die dynamischen Werte der Werbeseite
function show_numbers($numbers, $link) {
    $anmeldungen = -1;
    $file = 'data.txt';
    $file_handle = fopen($file, 'r');
    while (!feof($file_handle)) {
        $line = fgets($file_handle);
        $anmeldungen++;
    }

    fclose($file_handle);
    $row = mysqli_fetch_assoc($numbers);
    echo '<th>',htmlspecialchars($row['numbers.g']) , ' Speisen ','</th>';
    echo '<th>',htmlspecialchars($anmeldungen) , ' Newsletter Anmeldungen ','</th>';
    count_besucher($link);
}

// Erhöht die Besucheranzahl
function inc_besucher($link) {
    mysqli_query($link, "
UPDATE counter
SET count_b = count_b + 1;");
}

// Zeigt die Besucher an
function count_besucher($link) {
    $counter = mysqli_query($link, "
    SELECT count_b 
    FROM counter;
    ");
    $row = mysqli_fetch_assoc($counter);
    echo '<th>',htmlspecialchars($row['count_b']) , ' Besucher ','</th>';
}