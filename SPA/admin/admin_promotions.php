<?php
// promotions.json will store the promotion data
$promoFile = 'promotions.json';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $promoPrice = htmlspecialchars($_POST['promoPrice']);

    $promotions = [];
    if(file_exists($promoFile)) {
        $promotions = json_decode(file_get_contents($promoFile), true);
    }

    $promotions[] = ['name' => $name, 'price' => $price, 'promoPrice' => $promoPrice];
    file_put_contents($promoFile, json_encode($promotions, JSON_PRETTY_PRINT));

    $success = "Promotion added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Promotions</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; padding: 40px; background: #f8f5ff; color: #333; }
h1 { font-family: 'Playfair Display', serif; color: #2c2c97; margin-bottom: 30px; }
form { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); max-width: 500px; margin-bottom: 40px; }
input { width: 100%; padding: 10px 15px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
button { padding: 12px 25px; background-color: #6b5ce7; color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
button:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.promo-list { max-width: 600px; }
.promo-item { background: white; padding: 15px 20px; margin-bottom: 10px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; justify-content: space-between; }
.success { color: green; margin-bottom: 15px; }
</style>
</head>
<body>

<h1>Admin - Manage Promotions</h1>

<?php if(isset($success)) echo "<div class='success'>$success</div>"; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Service Name" required>
    <input type="text" name="price" placeholder="Original Price" required>
    <input type="text" name="promoPrice" placeholder="Promotional Price" required>
    <button type="submit">Add Promotion</button>
</form>

<h2>Current Promotions</h2>
<div class="promo-list">
<?php
if(file_exists($promoFile)) {
    $promotions = json_decode(file_get_contents($promoFile), true);
    foreach($promotions as $promo) {
        echo "<div class='promo-item'>
                <div>{$promo['name']}</div>
                <div>Promo: {$promo['promoPrice']}</div>
              </div>";
    }
}
?>
</div>

</body>
</html>
