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
    <h1 class="mb-4 text-center">Список продуктов</h1>
    
    <div class="d-flex justify-content-between mb-3">
        <a href="add.php" class="btn btn-success">
            ➕ Добавить продукт
        </a>
    </div>

    <table class="table table-striped table-hover align-middle shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Название продукта</th>
                <th>Описание (опционально)</th>
                <th>Количество</th>
                <th>Срок годности</th>
                <th>Статус</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td><?= $row['expiry_date'] ?></td>
                <td>
                    <span class="badge 
                        <?= $row['status'] === 'использован' ? 'bg-secondary' : 'bg-success' ?>">
                        <?= $row['status'] ?: '—' ?>
                    </span>
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">✏️</a>
                        <a href="update_status.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">🔄</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Удалить продукт: <?= $row['title'] ?>?');">🗑️</a>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
