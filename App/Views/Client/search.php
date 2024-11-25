<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Search Results for "<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>"</h2>

    <?php if (!empty($searchResults)): ?>
        <div class="row">
            <?php foreach ($searchResults as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                            <p class="card-text"><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</p>
                            <a href="/detail?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No products found for your search term.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
