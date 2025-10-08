
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pizza Shop Ordering System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg p-4">
    <h1 class="text-center mb-4">Pizza Shop Order Form</h1>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <input type="text" class="form-control" name="name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" class="form-control" name="contact" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Pizza Size</label><br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="size" value="Small" required>
          <label class="form-check-label">Small (₱150)</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="size" value="Medium">
          <label class="form-check-label">Medium (₱250)</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="size" value="Large">
          <label class="form-check-label">Large (₱350)</label>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Extra Toppings (+₱30 each)</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="toppings[]" value="Pepperoni">
            <label class="form-check-label">Pepperoni</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="toppings[]" value="Mushrooms">
            <label class="form-check-label">Mushrooms</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="toppings[]" value="Onions">
            <label class="form-check-label">Onions</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="toppings[]" value="Extra Cheese">
            <label class="form-check-label">Extra Cheese</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="toppings[]" value="Sausage">
            <label class="form-check-label">Sausage</label>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Choose a Drink</label>
        <select class="form-select" name="drink" required>
          <option value="Coke">Coke (₱50)</option>
          <option value="Sprite">Sprite (₱45)</option>
          <option value="Iced Tea">Iced Tea (₱40)</option>
          <option value="Water">Water (₱20)</option>
        </select>
      </div>

      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-primary">Order Now</button>
      </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
        $pizzasize = isset($_POST['size']) ? $_POST['size'] : '';
        $toppings = isset($_POST['toppings']) && is_array($_POST['toppings']) ? $_POST['toppings'] : [];
        $drink = isset($_POST['drink']) ? $_POST['drink'] : '';

        $sizePrices = ['Small' => 150, 'Medium' => 250, 'Large' => 350];
        $drinkPrices = ['Coke' => 50, 'Sprite' => 45, 'Iced Tea' => 40, 'Water' => 20];

        $basePrice = isset($sizePrices[$pizzasize]) ? $sizePrices[$pizzasize] : 0;

        $addonsPrice = 0;
        foreach ($toppings as $t) {
            
            $addonsPrice += 30;
        }

        $drinkPrice = isset($drinkPrices[$drink]) ? $drinkPrices[$drink] : 0;

        $finalTotal = $basePrice + $addonsPrice + $drinkPrice;
    ?>
        <div class="alert alert-success mt-4">
            <h1> PURCHASE SUMMARY </h1>
            <p><strong> Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong> Contact:</strong> <?php echo htmlspecialchars($contact); ?></p>
            <p><strong> Pizza Size:</strong> <?php echo htmlspecialchars($pizzasize); ?> (₱<?php echo number_format($basePrice); ?>)</p>
            <p><strong> Toppings:</strong> <?php echo !empty($toppings) ? htmlspecialchars(implode(', ', $toppings)) : 'None'; ?></p>
            <p><strong> Add-ons:</strong> ₱<?php echo number_format($addonsPrice); ?></p>
            <p><strong> Toppings Total:</strong> (₱<?php echo number_format($addonsPrice); ?>)</p>
            <p><strong> Drink:</strong> <?php echo htmlspecialchars($drink); ?> (₱<?php echo number_format($drinkPrice); ?>)</p>
            <p><strong> Final Total:</strong> ₱<?php echo number_format($finalTotal); ?></p>
        </div>
    <?php
    }
    ?>
    </div>

  </div>

</div>

</body>
</html>
