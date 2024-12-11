<?php
// Include header
include __DIR__ . '/../partials/header.php'; 

// Lấy từ khóa tìm kiếm từ query string
$searchTerm = $_GET['q'] ?? ''; 
?>

<div class="container mt-5">
    <h2 class="mb-4">Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($searchTerm); ?>"</h2>
    
    <?php if (!empty($searchResults)): ?>
        <ul>
            <?php foreach ($searchResults as $product): ?>
                <li>
                    <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                    <p>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VND</p>
                    <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100">
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Không tìm thấy sản phẩm nào với từ khóa "<?php echo htmlspecialchars($searchTerm); ?>"</p>
    <?php endif; ?>
</div>

<?php
// Include footer
include __DIR__ . '/../partials/footer.php'; 
?>
