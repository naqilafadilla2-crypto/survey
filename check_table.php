<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=surveii', 'root', '');
    $stmt = $pdo->query('DESCRIBE surveis');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Field'] . ' - ' . $row['Type'] . PHP_EOL;
    }
} catch(Exception $e) {
    echo $e->getMessage();
}
?>