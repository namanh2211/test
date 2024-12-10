<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($post['summary']); ?>
                        </p>
                        <p class="card-text"><small class="text-muted">Được đăng vào ngày <?php echo date('d F, Y', strtotime($post['created_at'])); ?></small></p>
                        <a href="/blog/detail?id=<?php echo $post['id']; ?>" class="btn btn-primary">Đọc tiếp</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
