<?php

$categories = [
    'Popular',
    'All',
    'Indoor',
    'Outdoor',
    'Low maintance',
];

if (isset($_GET['category'])) {
    $currentPagePath = $_GET['category'];
}
?>

<div class="flex flex-col gap-4">
    <p class="font-semibold text-xl">Categories</p>
    <div class="flex flex-wrap gap-2">
        <?php foreach ($categories as $category) : ?>
            <a href="/plnt/products/category?category=<?php echo urlencode($category); ?>" class="px-5 py-1 border-[1.5px] bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] rounded-full <?= $currentPagePath === $category ? 'border-zinc-600' : ' border-zinc-300 ' ?>"><?php echo htmlspecialchars($category); ?></a>
        <?php endforeach; ?>
    </div>
</div>