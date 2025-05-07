<?php
$content = 'Cart';
include view('components/goback.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// $name =  $_SESSION["name"];
// $email =  $_SESSION["email"];
// $created_at =  $_SESSION["created_at"];
?>

<section class="flex flex-col gap-4 mt-8">
    <?php if (($response['status'] === 'success') && !empty($response['data'])) : ?>
        <?php foreach ($response['data'] as $product) : ?>
            <div class="flex gap-4">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="" class="flex max-w-[40%] rounded-2xl">
                <div class="flex flex-col justify-between w-full">
                    <div>
                        <p><?php echo htmlspecialchars($product['name']); ?></p>
                        <p class="font-semibold">$<?php echo htmlspecialchars($product['price']); ?></p>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex gap-4 items-center">

                            <form method="POST" action="/plnt/cart/update" class="flex items-center justify-center rounded border-1 border-zinc-300  bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] p-1">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="action" value="decrease">
                                <input type="hidden" name="quantity" value="<?php $product['quantity']; ?>">
                                <button type="submit">
                                    <img class="w-[1rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAASElEQVR4nO3SwQmAMAAEwa0llujDhw1YpL1oDXkIAWdgCzi4AgAAAFjJVu3VsUh7NWYG3NWzWPevBozqrK5FOmcvBAAAANCnXky7b2xsvwJ1AAAAAElFTkSuQmCC" alt="minus-math">
                                </button>
                            </form>
                            <p class="font-semibold"><?php echo htmlspecialchars($product['quantity']); ?></p>
                            <form method="POST" action="/plnt/cart/update" class="flex items-center justify-center rounded border-1 border-zinc-300  bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] p-1">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="action" value="increase">
                                <input type="hidden" name="quantity" value="<?php $product['quantity']; ?>">
                                <button type="submit">
                                    <img class="w-[1rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAqElEQVR4nO3XMQrCQBCF4f8sK+IBUwRNk9I7pc0xthAvogRSTGMRRngOvg8WUu0y/CFkwczsgwvwBB7AmYJuwGtfVwqawwDbczmzBxBzATUXUHMBNRdQcwE1F8g4AQMwJtYS/kaX5F4D0I4M0MPhv7L6Xw3QgAm4J9YaDl+Te01HX6Fv8FdIzQXUXEDNBdRcQM0F1FxArXyBMQywPZfT9ltUV1xGzIwa3hco1hUbnac5AAAAAElFTkSuQmCC" alt="plus-math--v1">
                                </button>
                            </form>
                        </div>
                        <form method="POST" action="/plnt/cart/update" class="flex items-center">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit">
                                <img class="w-[1.25rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACcElEQVR4nO2Zv48NURTHP7awIUFhPRWhICqroiO6rQgifkRiI6JGItnVSPDEjyjwFxCNjY6KQlidHyFUHg27Gr9jNy+7xJOT3Em+mTCZee/cyZD5JKc6J99zzrz77txzB2pqarxZCpwGngNTwZ4Bp4AGFWcH8A3o/MW+AtupcPE/M4pPzGK2UcFl80WKfAXsBAaAJcAuoCX+T1VbTieluFYoOo0V/FriTlAhnkphezPi9knc45gFnQHaOdZzWdYGmnmLnwN8r0DRnZRZTblp/su/QJqtInSL+NyWfFs8BDeI4CPi80TyrfcQXC6CE8RnUvIt8xCcC/wKgj+APuLRF3J0Qk7L7cJHeSqNyG/0TrAPnsIvRHgwI+5i2DHOF/QlDEoey+nGHREeyoibCTEzBX0JQ5LHcrpxTYSHM+J07y7iSzggMVdx5JwIj0Zs4LjEnMWRIyJ8KWIDVyTmMI7sFuGxiA3clBibIdzYJMLjERt4KDEbcWS1CNtQEquBNxKzCkcWivB0xAamJWYBzkzlEO+lgUXit1zu6DxrS8q7gTWpudqdcUlgf2rvBjaL/wERGJMEtq16N7BH/DeIwOUcL5leGjia82XZNaOSwI4W3g1cEP8IERiWBHa4827guvj3E4E8R93kJqNd0GfczXlk75o8w0Yz3N80C/qMlzmHpq5pSAIbMb35LPp/ult1GbhnZeDud9TuL+viYEKe0gpH3ZVlXd3cl0QHHXUPie49IjKS+khhn4vm9aA3P3zZ0fV/jIjYsfpdak/3tLcxjtFp1gHvIxQ/CaylJAbCcaIlO1M3Nhu+p9kNxOKyiq+p+Z/4DZX67xAFcCDaAAAAAElFTkSuQmCC" alt="trash--v1">
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <p>Total: $<?php echo $response['total']; ?> </p>
    <?php else : ?>
        <p>You have a empty cart</p>
        <p>Lets fix that!</p>
    <?php endif; ?>
</section>