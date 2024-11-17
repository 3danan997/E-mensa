<?php
include "data.php";
include "php index.php"
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php
//inc_besucher($link);
?>
<header>
    <div class="Links">
        <p class="Logo">E-Mensa Logo</p>
        <ul class="Linke">
            <li><a href="#A1">Ankündigung</a></li>
            <li><a href="#A2">Speisen</a></li>
            <li><a href="#A3">Zahlen</a></li>
            <li><a href="#A4">Kontakt</a></li>
            <li><a href="#A5">Wichtig für uns</a></li>
        </ul>
    </div>
</header>
<main>
    <div class="body">
        <br><br>
        <img src="https://images.unsplash.com/photo-1551218372-a8789b81b253?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
             alt="Ein Bild">
        <br>
        <h1 id="A1">Bald gibt es essen auch online ;)</h1>
        <p class="Essen">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid blanditiis consequatur,
            cupiditate doloribus, eius, impedit laudantium maxime minus molestias necessitatibus nisi non nostrum omnis
            reprehenderit sapiente soluta tempora voluptatum. Veniam! Lorem ipsum dolor sit amet, consectetur
            adipisicing elit. Delectus ex, expedita minus nemo qui quisquam voluptate? Consequuntur deserunt excepturi
            facere in iste, magnam nisi
            numquam officia omnis quos saepe voluptas.</p>
        <br><br><br>
        <h1 id="A2">Köstlichkeiten, die sie erwarten</h1>
        <table class="Preis">
            <tr>
                <th>Image</th>
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Allergene</th>
            </tr>
            <?php
            show_gerichte($result, $name_of_allergene);
            ?>
        </table>
        <?php
        show_allergene();
        ?>
        <br><br><br>
        <h1 id="A3">E-Mensa in Zahlen</h1>
        <table class="Info">
            <tr>

                    <?php
                    //show_numbers($numbers, $link);
                    ?>
                </th>
            </tr>
        </table>
        <br><br><br>
        <h1 id="A4">Interesse geweckt? Wir informieren Sie!</h1>
        <form method="post">
            <div>
                <label for="fname">Ihr Vorname:</label>
                <label for="email">Ihre E-mail:</label>
                <label for="sel">Newsletter bitte in:</label>
                <input type="text" required id="fname" name="fname" placeholder=" Vorname">
                <input type="email" required id="email" name="email" placeholder=" E-Mail">
                <select required id="sel" name="sel">
                    <option value="">Select your option</option>
                    <option value="Deutsch">
                        Deutsch
                    </option>
                    <option value="Englisch">
                        Englisch
                    </option>
                    <option value="Französich">
                        Französich
                    </option>
                    <option value="Arabisch">
                        Arabisch
                    </option>
                </select>
            </div>

            <input type="checkbox" required id="check" name="cname">
            <label for="check">Den Datenschutzbestimmungen stimme ich zu<sup>*</sup>:</label>
            <input type="submit" value="Zum newsletter anmelden" onclick="test_data()">
        </form>
        <a href="wunschgericht.php">Wunschgericht einreichen</a>
        <?php
        test_data();
        ?>
        <br><br><br>
        <h1 id="A5">Das ist uns wichtig!</h1>
        <ul class="wichtig">
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
        <br><br><br>
        <h1 class="ende">Wir freuen uns auf Ihren Besuch!</h1>
    </div>
</main>
<footer>
    <div>
        <ul>
            <li>(c) E-Mensa GmbH</li>
            <li> Made by Adnan & Arnd</li>
            <li><a href="#A6">Impressum</a></li>
        </ul>
    </div>
</footer>
</body>
</html>