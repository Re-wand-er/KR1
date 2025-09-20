<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = htmlspecialchars($_POST['title']);
    $desc = htmlspecialchars($_POST['description']);
    $qty = (int)$_POST['quantity'];
    $exp = $_POST['expiry_date'];

    if (!empty($title) && $qty >= 0) {
        $stmt = $conn->prepare("INSERT INTO products (title, description, quantity, expiry_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $title, $desc, $qty, $exp);
        $stmt->execute();
        header("Location: index.php");
        exit;
    } else {
        $error = "Название обязательно, количество должно быть ≥ 0.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавить продукт</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1 class="mb-4 text-center">Добавить продукт</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Название</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Описание</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Количество</label>
            <input type="number" name="quantity" class="form-control" min="0" value="1" required>
        </div>

        <div class="mb-3">
            <label>Срок годности</label>
            <input type="date" name="expiry_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Добавить</button>
        <a href="index.php" class="btn btn-secondary">Назад</a>
    </form>
</body>
</html>
