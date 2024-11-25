<?php include __DIR__ . '/../partials/header.php'; ?>
<link rel="stylesheet" href="/Public/css/style.css">
<script src="/Public/js/script.js"></script>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/">Home</a>
                <span class="breadcrumb-item active">Contact</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Contact Us</span>
    </h2>
    <div class="row px-xl-5">
        <!-- Form liên hệ -->
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
                        Thank you for contacting us! We will get back to you shortly.
                    </div>
                <?php endif; ?>

                <form method="post" action="/contact/submit">
                    <div class="control-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Your Name"
                               value="<?php echo htmlspecialchars($formData['name'] ?? ''); ?>" >
                        <p class="text-danger"><?php echo $errors['name'] ?? ''; ?></p>
                    </div>
                    <div class="control-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Your Email"
                               value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>" >
                        <p class="text-danger"><?php echo $errors['email'] ?? ''; ?></p>
                    </div>
                    <div class="control-group mb-3">
                        <input type="text" class="form-control" name="subject" placeholder="Subject"
                               value="<?php echo htmlspecialchars($formData['subject'] ?? ''); ?>" >
                        <p class="text-danger"><?php echo $errors['subject'] ?? ''; ?></p>
                    </div>
                    <div class="control-group mb-3">
                        <textarea class="form-control" name="message" placeholder="Message" rows="8" ><?php echo htmlspecialchars($formData['message'] ?? ''); ?></textarea>
                        <p class="text-danger"><?php echo $errors['message'] ?? ''; ?></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Thông tin liên hệ và bản đồ -->
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
                <iframe 
                    style="width: 100%; height: 250px;" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" 
                    frameborder="0" 
                    style="border:0;" 
                    allowfullscreen="" 
                    aria-hidden="false" 
                    tabindex="0">
                </iframe>
            </div>
            <div class="bg-light p-30">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
