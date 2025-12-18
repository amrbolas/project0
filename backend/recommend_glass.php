<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$meal = $_POST['meal'] ?? '';

if (empty($meal)) {
    header("Location: ../index/index1.html");
    exit;
}

/* اتصال قاعدة البيانات */
$conn = new mysqli("localhost", "appuser", "apppass", "restaurant_db");

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}

$stmt = $conn->prepare(
    "SELECT name FROM restaurants WHERE meal = ? ORDER BY rating DESC LIMIT 1"
);

$stmt->bind_param("s", $meal);
$stmt->execute();
$result = $stmt->get_result();

$restaurant = null;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $restaurant = $row['name'];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Recommendation</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}

body {
    min-height: 100vh;
    background: linear-gradient(135deg, #7f7fd5, #86a8e7, #91eae4);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* Background emojis */
.bg-emojis span {
    position: absolute;
    font-size: 90px;
    opacity: 0.15;
}

.bg-emojis span:nth-child(1) { top: 10%; left: 12%; }
.bg-emojis span:nth-child(2) { top: 18%; right: 15%; }
.bg-emojis span:nth-child(3) { bottom: 18%; left: 20%; }
.bg-emojis span:nth-child(4) { bottom: 10%; right: 12%; }

/* Glass card */
.card {
    width: 480px;
    padding: 40px 35px;
    background: rgba(255,255,255,0.88);
    border-radius: 28px;
    box-shadow: 0 40px 80px rgba(0,0,0,0.3);
    backdrop-filter: blur(15px);
    text-align: center;
    position: relative;
    z-index: 2;
}

/* Hero banner */
.hero {
    width: 100%;
    height: 100px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    color: white;
    margin-bottom: 25px;
    letter-spacing: 5px;
}

h1 {
    font-size: 26px;
    margin-bottom: 15px;
}

.result {
    margin: 20px 0;
}

.meal {
    font-size: 18px;
    color: #666;
}

.restaurant {
    font-size: 26px;
    font-weight: 600;
    color: #667eea;
    margin-top: 8px;
}

.error {
    font-size: 16px;
    color: #666;
}

/* Button */
a {
    display: inline-block;
    margin-top: 28px;
    padding: 14px 28px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 18px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

a:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 35px rgba(102,126,234,0.45);
}

footer {
    margin-top: 30px;
    font-size: 12px;
    color: #888;
}
</style>
</head>

<body>

<!-- Background Emojis -->
<div class="bg-emojis">
    <span>🍕</span>
    <span>🍔</span>
    <span>🥙</span>
    <span>🍣</span>
</div>

<div class="card">

    <div class="hero">
        🍽 🍕 🍔 🥙
    </div>

    <h1>Recommendation</h1>

    <?php if ($restaurant): ?>
        <div class="result">
            <div class="meal">Best restaurant for</div>
            <div class="restaurant"><?= htmlspecialchars($meal) ?></div>
            <p><?= htmlspecialchars($restaurant) ?></p>
        </div>
    <?php else: ?>
        <div class="error">
            <p>😔 Sorry</p>
            <p>No restaurant found for <b><?= htmlspecialchars($meal) ?></b></p>
        </div>
    <?php endif; ?>

    <a href="../index/index1.html">🔙 Try another meal</a>

    <footer>
        Modern Glass UI • PHP & MySQL
    </footer>
</div>

</body>
</html>
