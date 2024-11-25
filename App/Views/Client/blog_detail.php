<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p class="text-muted">Published on <?php echo date('F d, Y', strtotime($post['created_at'])); ?></p>
    <div>
        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
