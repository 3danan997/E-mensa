

<form action="insert.php" method="post">

    <label for="Name">Ihr Name:</label>
        <input type="text" id="Name" name="Name" placeholder=" Name">
    <br>
    <label for="email">Ihre E-mail:</label>
        <input type="email" required id="email" name="email" placeholder=" E-Mail">
    <br>

    <label for="GName">Name des Gerichts:</label>
        <input type="text" required id="GName" name="GName" placeholder=" Name">
    <br>
    <label for="Desc">Beschreibung des Gerichts:</label>
        <input type="text" required id="Desc" name="Desc" placeholder=" Desc">
    <br>


    <input type="submit" value="Gericht einreichen" onclick="insert_data()">
</form>



