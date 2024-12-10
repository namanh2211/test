<?php include __DIR__ . '/../partials/header.php'; ?>
<link rel="stylesheet" href="/Public/css/style.css">
<script src="/Public/js/script.js"></script>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/">Trang chủ</a>
                <span class="breadcrumb-item active">Liên hệ</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Liên hệ với chúng tôi</span>
    </h2>

    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">

                <!-- Hiển thị thông báo lỗi -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Hiển thị thông báo thành công -->
                <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                    <div class="alert alert-success">
                        Cảm ơn bạn đã liên hệ với chúng tôi! Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.
                    </div>
                <?php endif; ?>

                <form method="post" action="/contact/submit">
                    <div class="control-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Họ và tên"
                               value="<?php echo htmlspecialchars($formData['name'] ?? ''); ?>" >
                        <p class="text-danger"><?php echo $errors['name'] ?? ''; ?></p>
                    </div>
                    <div class="control-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email của bạn"
                               value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>" >
                        <p class="text-danger"><?php echo $errors['email'] ?? ''; ?></p>
                    </div>
                    <div class="control-group mb-3">
                        <input type="text" class="form-control" name="subject" placeholder="Chủ đề"
                               value="<?php echo htmlspecialchars($formData['subject'] ?? ''); ?>" >
                        <p class="text-danger"><?php echo $errors['subject'] ?? ''; ?></p>
                    </div>
                    <div class="control-group mb-3">
                        <textarea class="form-control" name="message" placeholder="Nội dung" rows="8" ><?php echo htmlspecialchars($formData['message'] ?? ''); ?></textarea>
                        <p class="text-danger"><?php echo $errors['message'] ?? ''; ?></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit">Gửi tin nhắn</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Thông tin liên hệ và bản đồ -->
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
                <iframe 
                    style="width: 100%; height: 250px;" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.7402828142804!2d105.76052467479403!3d10.038277590069091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a089a066c57bbf%3A0xdfc852cb4936ddf7!2zS2h1IGTDom4gY8awIMSQ4bqhaSBOZ8Oibg!5e0!3m2!1svi!2s!4v1733827397151!5m2!1svi!2s" 
                    frameborder="0" 
                    style="border:0;" 
                    allowfullscreen="" 
                    aria-hidden="false" 
                    tabindex="0">
                </iframe>
            </div>
            <div class="bg-light p-30">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 An Khánh, Ninh Kiều, Cần Thơ</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>hmtshop@gmail.com.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
