<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/Controllers/api/ProductController.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

$controller = new ProductController();
$response = $controller->getProducts(null, $limit, $offset, $page);
$products = $response['data'];

$currentPagePath = 'All';
?>

<div class="w-full">

    <!-- HERO SECTION  -->

    <div class="h-[calc(100svh-190px)] flex flex-col justify-center gap-8 mb-4">
        <p class="font-bold text-5xl text-[#224820]">Plant a tree for life</p>
        <p class="text-2xl text-[#224820]">We focus on healthy, vibrant plants for your home. Quality curated, ready to bring life and freshness. We help create your green oasis.</p>
        <a href="" class="flex justify-center text-[#224820] w-full rounded-[2rem] font-bold border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] p-3">Find your next plant</a>
    </div>

    <!-- CONTENT SECTION  -->
    <div class="flex flex-col gap-4">

        <?php
        include view('components/saleContainer.php');
        ?>

        <?php
        include view('components/categories.php');
        ?>

        <?php
        include view('components/filters.php');
        ?>

        <section class="flex justify-between flex-wrap gap-4">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>

                    <div class="flex flex-col gap-4 w-[47.5%] shrink-0">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="" class="rounded-2xl">
                        <div class="flex flex-col">
                            <p class="font-semibold text-xl"><?php echo htmlspecialchars($product['name']); ?> </p>
                            <p class="font-semibold text-xl">$<?php echo htmlspecialchars($product['price']); ?> </p>
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="" class="font-semibold rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] py-2.5 w-[70%] text-center">Add to cart</a>
                            <a href="http://localhost/plnt/" class="flex p-2.5 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-10 w-10">
                                <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/like--v1.png" alt="like--v1" />
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No products available.</p>
            <?php endif; ?>
        </section>

        <?php
        include view('components/pagingButtons.php');
        ?>
    </div>
</div>