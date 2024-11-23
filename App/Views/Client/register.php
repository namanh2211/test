<?php


$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = isset($_SESSION['old']) ? $_SESSION['old'] : [];

// Xóa dữ liệu lỗi và dữ liệu cũ khỏi session sau khi tải trang
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Register</h2>
                    </div>
                    <div class="card-body">
                        <form action="/register-xuly" method="POST">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" id="full_name" name="full_name" class="form-control"
                                    value="<?php echo isset($old['full_name']) ? htmlspecialchars($old['full_name']) : ''; ?>">
                                <?php if (isset($errors['full_name'])): ?>
                                    <small class="text-danger"><?php echo $errors['full_name']; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    value="<?php echo isset($old['address']) ? htmlspecialchars($old['address']) : ''; ?>">
                                <?php if (isset($errors['address'])): ?>
                                    <small class="text-danger"><?php echo $errors['address']; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="<?php echo isset($old['phone']) ? htmlspecialchars($old['phone']) : ''; ?>">
                                <?php if (isset($errors['phone'])): ?>
                                    <small class="text-danger"><?php echo $errors['phone']; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control"
                                    value="<?php echo isset($old['username']) ? htmlspecialchars($old['username']) : ''; ?>">
                                <?php if (isset($errors['username'])): ?>
                                    <small class="text-danger"><?php echo $errors['username']; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="<?php echo isset($old['email']) ? htmlspecialchars($old['email']) : ''; ?>">
                                <?php if (isset($errors['email'])): ?>
                                    <small class="text-danger"><?php echo $errors['email']; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                                <?php if (isset($errors['password'])): ?>
                                    <small class="text-danger"><?php echo $errors['password']; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="form-control">
                                <?php if (isset($errors['confirm_password'])): ?>
                                    <small class="text-danger"><?php echo $errors['confirm_password']; ?></small>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="w-100 btn btn-primary">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="/login">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>