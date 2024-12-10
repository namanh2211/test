<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán MoMo</title>
</head>
<body>
    <h1>Thanh Toán Qua MoMo</h1>
    <form method="POST" action="/momo-payment">
        <label for="amount">Nhập số tiền (VNĐ):</label>
        <input type="number" id="amount" name="amount" value="10000" required>
        <button type="submit">Thanh Toán</button>
    </form>
</body>
</html>
    