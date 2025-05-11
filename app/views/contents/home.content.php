<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/Controllers/api/ProductController.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

$controller = new ProductController();
$response = $controller->getPopularProducts(null, $limit, $offset, $page);
$products = $response['data'];

$currentPagePath = 'Popular';
?>

<div class="w-full">

    <!-- HERO SECTION  -->
    <div class="h-[calc(100svh-190px)] flex flex-col justify-center gap-8 mb-4 md:h-[calc(100svh-110px)] ">
        <p class="font-bold text-5xl text-[#224820]">Plant a tree for life</p>
        <p class="text-2xl text-[#224820] md:w-[80%]">We focus on healthy, vibrant plants for your home. Quality curated, ready to bring life and freshness. We help create your green oasis.</p>
        <a href="#" class="flex justify-center text-[#224820] w-full rounded-2xl font-bold border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] p-3 md:w-[50%]">Find your next plant</a>
    </div>

    <!-- CONTENT SECTION  -->
    <div class="flex flex-col gap-8">


        <?php include view('components/saleContainer.php'); ?>

        <div class="flex flex-col md:flex-row gap-8">

            <div class="flex flex-col md:w-[20%]">
                <?php include view('components/categories.php'); ?>
                <?php include view('components/filters.php'); ?>
            </div>

            <section class="flex flex-col gap-8 md:flex-row md:flex-wrap md:w-[80%] md:justify-end">
                <?php if ($response['status'] === 'success') : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="flex flex-col md:w-[30%] gap-2">
                            <a href="/plnt/product?id=<?php echo $product['id']; ?>" class="">
                                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="" class="rounded-2xl">
                                <div class="flex flex-col mt-2">
                                    <p class="font-semibold text-xl"><?php echo htmlspecialchars($product['name']); ?></p>
                                    <p class="font-semibold">$<?php echo htmlspecialchars($product['price']); ?></p>
                                </div>

                                <div class="w-full">
                                    <?php if (isset($_SESSION['userid'])) : ?>
                                        <form method="POST" action="/plnt/cart" class="flex justify-between">
                                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="font-semibold rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] py-2.5 w-full text-center cursor-pointer">
                                                ADD TO CART
                                            </button>
                                            <!-- <a href="/" class="flex p-2.5 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-11 w-11">
                                                <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/like--v1.png" alt="like">
                                            </a> -->
                                        </form>
                                    <?php else : ?>
                                        <form method="GET" action="/plnt/login" class="flex justify-between">
                                            <button type="submit" class="font-semibold rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] py-2.5 px-2 w-full text-center ">
                                                SIGN IN TO PURCHASE
                                            </button>
                                            <a href="/" class="flex p-2.5 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-11 w-11 cursor-pointer">
                                                <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/like--v1.png" alt="like">
                                            </a>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center w-full font-semibold mt-4"><?php echo htmlspecialchars($response['message'] ?? 'No products found.'); ?></p>
                <?php endif; ?>
            </section>
        </div>

        <div class="flex justify-center items-center">
            <?php include view('components/pagingButtons.php'); ?>
        </div>

    </div>
</div>