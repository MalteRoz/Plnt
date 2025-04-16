<?php
$currentPagePath = $_GET['category'];
?>
<section class="flex flex-col gap-4">

    <?php
    include view('components/saleContainer.php');
    include view('components/categories.php');
    include view('components/filters.php');
    ?>

    <section class="overflow-x-auto flex flex-nowrap gap-4">
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $data) : ?>

                <div class="flex flex-col gap-4 w-[250px] shrink-0">
                    <img src="<?php echo htmlspecialchars($data['image_url']); ?>" alt="" class="rounded-2xl">
                    <div class="flex justify-between items-center">
                        <p class="font-semibold text-xl"><?php echo htmlspecialchars($data['name']); ?> </p>
                        <p class="font-semibold text-xl">$<?php echo htmlspecialchars($data['price']); ?> </p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No products available.</p>
            <?php endif; ?>
    </section>

</section>