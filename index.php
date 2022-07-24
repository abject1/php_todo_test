<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_infini_ligne";

$dsn = "mysql:host=$servername;dbname=$dbname";

try {
    $conn = new PDO($dsn, $username, $password);
    //définir le mode exception d'erreur PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `todo`(`title`,`description`)
    VALUES('$_POST[todoname]','$_POST[todocontent]')
    ";
    //utiliser la fonction exec() car aucun résultat n'est renvoyé //
    $conn->exec($sql);
    // echo "Todo ajoutée";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

try {
    $pdo = new PDO($dsn, $username, $password);
    $stmt = $pdo->query("SELECT * FROM todo");

    if ($stmt === false) {
        die("Erreur");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}



$conn = null;

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infini Todo</title>
    <!-- link google fnts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- link css  -->
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <a href="http://localhost:80/php_todo_test/index.php">
            <h1>Todo de Infini Ligne</h1>
        </a>
        <img src="./assets/téléchargement2.png" alt="logo infini ligne">
    </header>
    <main>
        <form action="http://localhost:80/php_todo_test/index.php" method="POST" id="todo-add">
            <h3>Ajoutée une todo</h3>
            Nom de la Todo : <input type="text" name="todoname">
            Contenue de la Todo : <input type="text" name="todocontent">
            <input type="submit">
        </form>
        <div class="todos-list">
            <h3>Les todos en cours</h3>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><button class="btn-delete">Supprimer</button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>Copyright © - INFINI LIGNE - 2022</p>
    </footer>
</body>

</html>