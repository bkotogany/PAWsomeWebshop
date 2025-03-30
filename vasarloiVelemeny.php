<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kisallatbolt";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódás sikertelen: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $valasztek = $_POST['valasztek'];
    $minoseg = $_POST['minoseg'];
    $szallitas = $_POST['szallitas'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO reviews (name, email, valasztek, minoseg, szallitas, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiis", $name, $email, $valasztek, $minoseg, $szallitas, $description);

    if ($stmt->execute()) {
        echo "Véleményét sikeresen elküldtük! Köszönjük!";
    } else {
        echo "Hiba: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Vásárlói vélemény</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Kérjük mondja el a véleményét</h1>
        <h3>Milyen élményekkel gazdagodott a weboldalunkon eltöltött időben?<br>Mennyire elégedett a nálunk vásárolt termékkel és a kiszállítással?<br>Hogyan tudnánk még kellemesebbé tenni a vásárlást?<br>Kérjük mondja el a véleményét!</h3>
        <form method="post" target="_self">
            <input type="text" name="name" placeholder="Az Ön neve" required/>
            <label for="email">Adja meg az email címét</label>
            <input type="email" id="email" name="email">
            <div>
            <label for="valasztek">Választék</label>
            <select name="valasztek" id="valasztek" required>
                <option value="5">Kiváló</option>
                <option value="4">Jó</option>
                <option value="3">Elfogadható</option>
                <option value="2">Elmegy</option>
                <option value="1">Kevés</option>
            </select>
            </div>
            <div>
            <label for="minoseg">Termék minősége</label>
            <select name="minoseg" id="minoseg" required>
                <option value="5">Kiváló</option>
                <option value="4">Jó</option>
                <option value="3">Elfogadható</option>
                <option value="2">Elmegy</option>
                <option value="1">Kevés</option>
            </select>
            </div>
            <label for="szallitas">Kiszállítás gyorsasága</label>
            <select name="szallitas" id="szallitas" required>
                <option value="5">Nagyon gyorsan megérkezett</option>
                <option value="4">Gyorsan megérkezett</option>
                <option value="3">Elfogadható</option>
                <option value="2">Elmegy</option>
                <option value="1">Nagyon későn érkezett</option>
            </select>
            </div>
            <div>
            <textarea rows = "8" cols = "70" name = "description" required>
                Kérjük írja le saját szavaival a tapasztalatait
            </textarea>
            </div>
            <input type="submit">
        </form>
    </body>
</html>