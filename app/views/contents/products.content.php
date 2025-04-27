<section class="flex flex-col gap-4">
    <?php
    include view('components/saleContainer.php');
    include view('components/categories.php');
    include view('components/filters.php');


    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

    ?>

    <section class="flex justify-between flex-wrap gap-4">
        <?php if ($response['status'] === 'success') : ?>
            <?php foreach ($response['data'] as $product) : ?>
                <a href="/plnt/product?id=<?php echo $product['id']; ?>">
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
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center w-full font-semibold mt-4"><?php echo htmlspecialchars($data['message']); ?></p>
        <?php endif; ?>
    </section>

    <?php
    include view('components/pagingButtons.php');
    ?>
</section>