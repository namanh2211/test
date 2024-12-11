<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán MoMo</title>
</head>
<body>
    <h1>Thanh Toán Qua MoMo</h1>
    <form action="/process-payment" method="POST">
    <label for="accountNumber">Số tài khoản MoMo:</label>
    <input type="text" id="accountNumber" name="accountNumber" required>

    <label for="accountName">Tên tài khoản MoMo:</label>
    <input type="text" id="accountName" name="accountName" required>

    <label for="amount">Số tiền:</label>
    <input type="number" id="amount" name="amount" required>

    <button type="submit">Thanh toán</button>
</form>

</body>
</html>
