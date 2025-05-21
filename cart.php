<?php
session_start();

// افزودن محصول به سبد خرید
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $product_id;
}

// پاک کردن تاریخچه سبد خرید
if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="style.css">

</head>
<body>
    <header>
        <h1>🛒 سبد خرید شما</h1>
    </header>
    <main>
        <div class="cart-container">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <div class="cart-items">
                    <?php foreach ($_SESSION['cart'] as $id): ?>
                        <div class="cart-item">
                            <p>محصول با شناسه <strong><?= htmlspecialchars($id) ?></strong></p>
                        </div>
                    <?php endforeach; ?>
                    <div class="cart-summary">
                        <p>📦 تعداد محصولات در سبد: <strong><?= count($_SESSION['cart']) ?></strong></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="empty-cart">
                    <p>سبد خرید شما خالی است.</p>
                </div>
            <?php endif; ?>

            <div class="cart-buttons">
                <form method="post">
                    <button type="submit" name="clear_cart" class="clear-btn">🧹 پاک کردن سبد</button>
                </form>

                <form action="index.php" method="get">
                    <button type="submit" class="back-btn">⬅️ بازگشت به فروشگاه</button>
                </form>
            </div>
        </div>
    </main>
<?php
include 'includes/footer.php';
?>
</body>
</html>
