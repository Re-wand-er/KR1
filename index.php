<?php
include 'config.php';
$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fridge Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1>Список продуктов</h1>
    <a href="add.php" class="btn btn-success mb-3">Добавить продукт</a>
    <!--<a href="delete.php" class="btn btn-success mb-3">Удалить продукт</a>-->
    <!--<a href="update_status.php" class="btn btn-success mb-3">Обновить продукт</a>-->
    <table class="table table-bordered">
        <tr>
            <th>Название продука</th><th>Описание (опционально)</th><th>Количество</th><th>Срок годности</th><th>Статус</th><th>Действия</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['expiry_date'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Редактировать</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('Удалить продукт?');">Удалить</a>
                <a href="update_status.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Изменить статус</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
