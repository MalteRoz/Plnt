<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/ProductsModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/Controllers/api/ProductController.php';

$controller = new ProductController();
$products = [];
$selectedCategory = 'Popular';


if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    if ($selectedCategory === 'All') {
        $response = $controller->getProducts();
        if (isset($response['data'])) {
            $products = $response['data'];
        }
    } else if ($selectedCategory === 'Popular') {
        $response = $controller->getPopularProducts();
        if (isset($response['data'])) {
            $products = $response['data'];
        }
    } else {
        $response = $controller->getProductsByCategory($selectedCategory);
        if (isset($response['data'])) {
            $products = $response['data'];
        } else {
            echo "Fel vid hämtning av produkter för kategorin: " . htmlspecialchars($selectedCategory);
        }
    }
} else {
    $response = $controller->getProducts();
    if (isset($response['data'])) {
        $products = $response['data'];
    }
}

$currentPagePath = $_GET['category'];


?>

<?php
include view('components/saleContainer.php');
include view('components/categories.php');
include view('components/filters.php');
?>

<section class="overflow-x-auto flex flex-nowrap gap-4">
    <?php if (!empty($products)) : ?>
        <?php foreach ($products as $product) : ?>

            <div class="flex flex-col gap-4 w-[250px] shrink-0">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="" class="rounded-2xl">
                <div class="flex justify-between items-center">
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