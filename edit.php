<?php
include 'config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Неверный ID");
}

// Получаем текущие данные
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Продукт не найден");
}

// Обновление
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = htmlspecialchars($_POST['title']);
    $desc = htmlspecialchars($_POST['description']);
    $qty = (int)$_POST['quantity'];
    $exp = $_POST['expiry_date'];

    $stmt = $conn->prepare("UPDATE products SET title=?, description=?, quantity=?, expiry_date=? WHERE id=?");
    $stmt->bind_param("ssisi", $title, $desc, $qty, $exp, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редактировать продукт</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1 class="mb-4 text-center">Редактировать продукт</h1>
    <form method="POST">
        <div class="mb-3">
            <label>Название</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($product['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Описание</label>
            <textarea name="description" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Количество</label>
            <input type="number" name="quantity" class="form-control" value="<?= $product['quantity'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Срок годности</label>
            <input type="date" name="expiry_date" class="form-control" value="<?= $product['expiry_date'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="index.php" class="btn btn-secondary">Назад</a>
    </form>
</body>
</html>
