<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Plnt/app/utils/BuildUrl.php";

$filters = [
    'Lowest Price',
    'Highest Price',
    'Name desc',
    'Name asc',
];

$context = '';
$params = [];
$currentPagePath = '';


if (isset($_GET['query'])) {
    $context = 'search';
    $params['query'] = $_GET['query'];
} else {
    $context = 'category';
    $params['category'] = $_GET['category'] ?? 'Indoor';
}

if (isset($_GET['filter'])) {
    $currentPagePath = $_GET['filter'];
    $params['filter'] = $_GET['filter'];
}

?>

<div class="flex flex-col gap-4 ">
    <p class="font-semibold text-xl">Filters</p>
    <div class="flex flex-wrap gap-2 md:flex md:flex-col md:flex-nowrap md:text-center">
        <?php foreach ($filters as $filter) : ?>
            <?php $filterUrl = buildUrl($context, array_merge($params, ['filter' => $filter])); ?>
            <a href="<?php echo $filterUrl; ?>" class="px-5 py-1 border-[1.5px] bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] rounded-full <?= $currentPagePath === $filter ? 'border-zinc-600' : ' border-zinc-300 ' ?>"><?php echo htmlspecialchars($filter); ?></a>
        <?php endforeach; ?>
    </div>
</div>