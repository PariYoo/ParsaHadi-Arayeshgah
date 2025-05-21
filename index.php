<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: register.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>صفحه اصلی</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>خوش آمدید، <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <a href="logout.php"><button>خروج</button></a></header>
    <main>
        <table>
            <thead><tr><th>تصویر</th><th>نام محصول</th><th>توضیحات</th><th>قیمت</th><th>افزودن به سبد</th></tr></thead>
            <tbody>
                <?php
                $products = [
                    ["images/scissor.jpg", "قیچی حرفه‌ای", "مناسب برای آرایشگران حرفه‌ای", "1,000,000"],
                    ["images/trimmer.jpg", "ماشین اصلاح", "تیغه‌های تیز و با دوام", "4,500,000"],
                    ["images/comb.jpg", "شانه آرایشگری", "مناسب برای حالت‌دهی مو", "150,000"]
                ];

                foreach ($products as $index => $product) {
                    echo "<tr>
                        <td><img src='{$product[0]}' alt='{$product[1]}' width='100'></td>
                        <td>{$product[1]}</td>
                        <td>{$product[2]}</td>
                        <td>{$product[3]} تومان</td>
                        <td>
                            <form method='post' action='cart.php'>
                                <input type='hidden' name='product_id' value='{$index}'>
                                <button type='submit'>افزودن</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
<?php
include 'includes/footer.php';
?>
</body>
</html>
