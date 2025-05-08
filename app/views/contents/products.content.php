<section class="flex flex-col md:gap-8">

    <?php
    include view('components/saleContainer.php');
    ?>

    <div class="flex md:flex-row gap-8">

        <div class="flex flex-col md:w-[20%]">
            <?php
            include view('components/categories.php');
            include view('components/filters.php');
            ?>
        </div>

        <section class="flex flex-col md:flex-row md:flex-wrap md:gap-8 md:w-[80%] md:justify-end">
            <?php if ($response['status'] === 'success') : ?>
                <?php foreach ($response['data'] as $product) : ?>
                    <div class="flex flex-col w-[30%] gap-2">
                        <a href="/plnt/product?id=<?php echo $product['id']; ?>" class="">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="" class="rounded-2xl">
                            <div class="flex flex-col mt-2">
                                <p class="font-semibold text-xl"><?php echo htmlspecialchars($product['name']); ?></p>
                                <p class="font-semibold">$<?php echo htmlspecialchars($product['price']); ?></p>
                            </div>

                            <div class="w-full">
                                <?php if (isset($_SESSION['userid'])) : ?>
                                    <form method="POST" action="/plnt/cart" class="flex justify-between w-full">
                                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="font-semibold rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] py-2.5 w-full text-center mr-4">
                                            ADD TO CART
                                        </button>
                                        <a href="/" class="flex p-2.5 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-11 w-11">
                                            <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/like--v1.png" alt="like">
                                        </a>
                                    </form>
                                <?php else : ?>
                                    <form method="GET" action="/plnt/login" class="">
                                        <button type="submit" class="font-semibold rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] py-2.5 w-[80%] text-center mr-4">
                                            SIGN IN TO PURCHASE
                                        </button>
                                        <a href="/" class="flex p-2.5 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-11 w-11">
                                            <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/like--v1.png" alt="like">
                                        </a>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center w-full font-semibold mt-4"><?php echo htmlspecialchars($data['message']); ?></p>
            <?php endif; ?>
        </section>

    </div>

    <div class="flex justify-center items-center">
        <?php include view('components/pagingButtons.php'); ?>
    </div>
</section>