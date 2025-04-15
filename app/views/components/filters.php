<?php

$filters = [
    'Lowest Price',
    'Higest Price',
    'Name desc',
    'Name asc',
];
?>

<div>
    <p class="font-semibold text-xl">Filters</p>
    <div class="flex flex-wrap gap-2">
        <?php foreach ($filters as $filter) : ?>
            <a href="" class="px-5 py-1 border-[1.5px] bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] rounded-full <?= $currentPagePath === $filter ? 'border-zinc-600' : ' border-zinc-300 ' ?>"><?php echo htmlspecialchars($filter); ?></a>
        <?php endforeach; ?>
    </div>
</div>