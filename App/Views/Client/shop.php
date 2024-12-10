<!-- views/Client/shop.php -->
<?php require __DIR__ . '/../partials/header.php'; ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/home">Trang chủ</a>
                <span class="breadcrumb-item active">Cửa hàng</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <h5 class="categories-title mb-3">Danh mục</h5>
            <div class="bg-light p-4 mb-30">
                <ul class="list-unstyled category-list mb-0">
                    <li class="mb-2">
                        <a href="/shop" class="text-dark <?php if (!isset($category_id)) echo 'active'; ?>">Tất cả sản phẩm</a>
                    </li>
                    <?php foreach ($categories as $category): ?>
                        <li class="mb-2">
                            <a href="/shop?category_id=<?php echo $category['id']; ?>" 
                               class="<?php echo (isset($category_id) && $category_id == $category['id']) ? 'active' : ''; ?>">
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- Sidebar End -->

        <!-- Product List Start -->
        <div class="col-lg-9 col-md-8">
    <div class="row pb-3">
        <?php if (isset($products) && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="<?php echo htmlspecialchars($product['image_path']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" 
                               href="/detail?id=<?php echo $product['id']; ?>">
                                <?php echo htmlspecialchars($product['product_name']); ?>
                            </a>
                            <h5><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>Không có sản phẩm nào để hiển thị.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

    </div>
</div>
<!-- Shop End -->

<!-- Custom CSS for Sidebar -->
<style>
    .categories-title {
        font-weight: 700;
        color: #333;
        text-transform: uppercase;
        padding-bottom: 10px;
        border-bottom: 2px solid #ffc107;
    }

    .category-list a {
        display: block;
        color: #555;
        padding: 10px 15px;
        text-decoration: none;
        font-size: 16px;
        transition: background 0.3s, color 0.3s;
        border-radius: 5px;
    }

    .category-list a:hover {
        background-color: #ffc107;
        color: #fff;
    }

    .category-list a.active {
        background-color: #ffc107;
        color: #fff;
    }
</style>
<?php require __DIR__ . '/../partials/footer.php'; ?>
