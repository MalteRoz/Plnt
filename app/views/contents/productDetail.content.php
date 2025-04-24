<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Plnt/app/utils/checkStock.php";

$content = 'Details';
$like = true;
include view('components/goback.php');
?>

<section class="mt-8">
    <?php if ($data['status'] === 'success') :  ?>
        <!-- <p><?php echo $data['status']; ?> </p> -->
        <?php foreach ($data['data'] as $product) : ?>
            <div class="flex flex-col items-center gap-8 w-full">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="" class="w-[70%] rounded-2xl">

                <div class="flex flex-col items-center gap-4 w-full">
                    <div class="flex justify-between w-full">
                        <div>
                            <p class="text-2xl font-semibold"><?php echo $product['name']; ?></p>
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- <div class="p-2 rounded-full border-1 border-[#224820]"> -->
                            <img class="w-[1rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD60lEQVR4nO1YS4gcZRD+83B9LT4gkESyXY/eLNjqxcGAemjR3a6aTVRUBi+KigcVYoIGk4jIKjnoTQmCIIo3PYmRICI+0JOIghjRJIJRc/EkBhOTaEKU6p2Z/afX3e6ex84G+oOGYWbq+6uq6/k7V6FChQoVlgLB5uBKTuAhUtjHCodY8QQrnmLFI6T4Fivc5RpuVS5Rw61igbtJ8G2TbXKcME4SfJcFHoQ74Yq+Kb6hseFiEniaFY6x4r85z8FQ4MaFuMIkuMn+k8sj+Acr7IYYLupJ+bHJsatI4KsCircfUjhjBjvnVrSJZtxKUnjGfivDxQpfmg7dK69wtNMz8C0LbhvXIFo7tfZS85B9pgR2sMAvHYYI7G1xseIrGeV+JoUnYBquNg7jCmXsGhbczgIHMg45WtqIZti0PU8Cp1nwEfNkjszejBHPkcDzGYVeXjQ0ZtxKFng0PdN7E6XCaTbm55RHxbioLAs+tWB4CTxZlCcUuKXDCMGdxauNn7Dm+ZJgwdfnJya8VppH4TE/sQtVJyuVfswvFjYLYf2W9ZeQwncezwELsbI8brbk+jnxQK5MWovnrN5W+tAWT50mmv3iIE/yxm552BK7nT/4TgEBONwSsArjhozQqtNcMh/KFSCF4y2BKI5G3ZARxdGoV8GO5wo0R4TmGxi/bEm0XAQ8yZeXNCCN21QAFRM3ZIQJqJeTP+QKWLkrlTQDBqXDY1ufV3MFWIPbvLJ1jhLa5IaEMAlqpkNLH2tuReRWpDNPu3viJ930gp4xYwMgfuqFzzeFZbke3NoxAiSwY6DKFhhJSucjKb7pZf8/SxlKoQTXk8DfnvffKE1iI65lvT8CwzSscwMGTMM6O8sL4e9tNOmKjOt8HQue9KrA14NsblEcjdoZnudP8hRf2xMpJcE9LHjW88j7cexWuz4jjt1q4/aUP2u7c1/IbaTOrHr7x3X8wr6QO+dqtdoF1nP8M0LFx10/QQp7MpvVvqgRjfTKGzWiEb9ZNbn3uEFgvhH4QS83B1EjGmGF9zq3NnzJDRK252Y2rQ+7WVYsBFlh/5Iq3wILPpvJiY/KlLp0YxP8eCjKt8CKuzJv4rMi47f9hwU+75TFF9ww0Fy628OW1fCJLRNrFr0wEPwic1PxohsmKKGtvhG2hP9fx7bvOhZ9xXN9L5XdgpTuy1wbHtm4OeDW7zzJASn86Dcp0uBht5wQ1vFeG/q8xP7VbiaCqYBI8Cevxp9BwfvdcgQK3pG5TfstfebezClSut0tZ4SzV4J/zr+Zw78ooSl3PoCUbmDF371wOsb14GZ3PiFMglqauAKHbUEZtj4VKlSo4AaC/wAM4kJqLiow/AAAAABJRU5ErkJggg==" alt="like--v1">
                            <!-- </div> -->
                            <p class="text-[#224820] font-semibold">
                                <?php echo $product['likes']; ?>
                                likes
                            </p>
                        </div>

                    </div>


                    <p><?php echo $product['description']; ?></p>
                    <!-- <div class="flex flex-col w-full">
                        <p class="text-xl font-semibold mb-4">Plant Information</p>
                        <div class="flex w-full justify-between">
                            <div class="flex flex-col gap-1">
                                <p class="text-[14px]">Environment</p>
                                <p class="font-semibold"><?php echo $product['environment']; ?></p>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-[14px]">Temperature</p>
                                <p class="font-semibold"><?php echo $product['temperature']; ?> °C</p>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-[14px]">Height</p>
                                <p class="font-semibold"><?php echo $product['height']; ?> cm</p>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-[14px]">Watering</p>
                                <p class="font-semibold"><?php echo $product['watering']; ?></p>
                            </div>
                        </div>
                    </div> -->

                    <div class="flex flex-col w-full">

                        <p class="text-xl font-semibold mb-4">Plant Information</p>
                        <div class="flex w-full justify-between">
                            <div class="flex flex-col items-center min-w-[20%] border-1 px-2 py-4 rounded-2xl border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)]">
                                <img class="w-[1.5rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABrUlEQVR4nN2WS07DQAxAs0HQPVQC0vqj0Av0AGyobAlWiB4I6D1gwzUQUMRnwUflIhSQ+CwKciBVoHQ6adPyseRNZuw3djweB8FfExY4I8WTyYMVX03/B3hpNVwM62FhVHC1Wp0qrZQWvKC2kQSeSOGGa1zsCxZossJR3/UaF1mgxYqPZSnPDwTDMsx8GLwOgrugsa1lRaAVaTSd3dARlTsbQx6cDS54zIp76W8s2GDBK1Z8MCXBS1LYTgPMJrYdIls9Qkp1ErhLiuqr2hopbQR5CinVWbHTD5rSTm5wjlPeP9JvIm9HGs2NDhZs+EK7cIWt0cEK15nBgpeZyp8TFWgma1nSnC40H99Bz2Lq7g4Jbvv4dsrHnR1Pql0SN4fsEW8Gk75OrHBbWavMjgw2sabg20BYYD3IU0hpw4rGFWkuUI5fKNwnxZ3km3Ukaw6keEEK9++KF/ZP0+klgd2hHgn+/J4eZD60wGHmZzGsh4UEmtcgMGiM6s5bpPASTyGu0UfhnAVPXXDzQQLP3nNXpFFoI5BrT1JUrj3mw3x5QX3FBzwW4R8Di3u8/bXyBlLoeSb8yT2fAAAAAElFTkSuQmCC" alt="sun--v1">
                                <p class="text-[12px]"><?php echo $product['environment']; ?></p>
                            </div>
                            <div class="flex flex-col items-center min-w-[20%] border-1 px-2 py-4 rounded-2xl border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)]">
                                <img class="w-[1.5rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC9UlEQVR4nO1ZTWsUQRBtNd78Qk9K2KrqWV3NQdTFo+zBMFUbNfGQ/AKjf0AEowmuBCP4IxSJHlRQEA9KQPDs0e94ERGMgqJREBQSqd2dnc6yk4kYZmbZfdAwdNfAe92vuntqjOmii2yhMFjYSAxjxPDUCv7UVnuGs32lvg0my/D8XJEYP1jBxVaNBN57nDtgsggq0y7L+DWKvNO+eL6XN1mDFZhxSZLkTuQ4t10bMY0uEcfwyGQJMAB7HJv8IaGDzTFqHRL4HcQhY8FkBVjGk87s3o+Ks4IPGkKZRk1WYBnHHftMRcYJToVCcdxkBcRQCWcWKv8b1xYCnPbLCl5KlvHqClgkgR/JMl6GWMesALV7DlDWBSBjQe8+luGd7bc7285CxHDO6RtruySmmL52WIHKSvoygY4UYNvdQrabxKuIjswB6gpYRZDgtX9eAcGrJguwjGfcHUW/j6MEeIKnluw+PpxOlTwKlqzgQkgU7xaLxfVRAnSMGO85IhaI6VAq5JWMZXzpVCPumBGzTsc8xiFifOHY5bnl3BEdK5VMjwp1x0ol05O4ACXkVBg+9vq9W7WfBK60Oqzqt85Jjdl9eMc2KzDXGCtDOQUBMO1Y5KL2IeNgFPmgeT5IXeik8/71xAVUbVEnkBfYXxf1JE5AUFbUQrANV+ZZ8gIYvjdI9dvNVQG1cnpscVdjYQi2hH3wLQ0B8wGBoO6vX1YrFaD/EWxoofnEBViGN6EFaG9NAD6OFwAPNRYGYJ/T9zp5AYI3HQ+frwmgY3ECUNCvTQBOOHkxnbgAEhpxZnBOLVEndjlyG63vVnnJbyKGz84KDicuoHqqCrx1RNwyxqypivPpqNpJc6KWFzATbJ8ao4ees3qzwemdOLwyHG/y9+1gJVpBZ94lbwUX9OwwaaLZMiTwSWv/ejbo7qRNn9Xzrm3i/iUkhwtm7XK+j2h6AZzSd01WUL3ACczGkdeY1G2zfGLTsGW8YQVfNZJYb60M0zqWWsJ20YVpib9e1dxkli1zUQAAAABJRU5ErkJggg==" alt="temperature--v1">
                                <p class="text-[12px]"><?php echo $product['temperature']; ?> °C</p>
                            </div>
                            <div class="flex flex-col items-center min-w-[20%] border-1 px-2 py-4 rounded-2xl border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)]">
                                <img class="w-[1.5rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABb0lEQVR4nOXWO0pDURAG4GunoK4gnHkkIZAFWAgxoDEzGhAssiIbC8FWUQQ7wT1EC1G0ERuxERcg8YGoVYycJEQRNTmPBMSBgcu9xcc/58FNkr9UqWpqjAVPSPEYijA6NJgE11mx2em1IaFUYMFGFxZsoGJxoGhuKTfBijef0raaBK/zxfz4wGASWP2KdnGFlYGgZt4QK77+BNtvIIDRYRbY/wXtjBz2oqLpsplmxbdecBunQix3hAXO+kHbDadRVBZT6R9tNwpKMEyCR66wvdFirG3Tp6lMUwFpYdcXZsFtLzSjmUkWfAmAn+1N555WqeqNfuzwZQ8Yd4Jhn3GzwEUE+NwdVniIAN87w6TwFAqTwKNP4qsIiS994K3gxAobzjAJlYITL5hZZ9gWKdb8xwyHiW9lK4ZJ4NYDrqfL6UwSUriIMyx454JG+xngEmdJ8aD3ZsJacNLvitXMkcCmPSb2nLfOun2273w3UvJf6h2uJgr+br6+ywAAAABJRU5ErkJggg==" alt="water">
                                <p class="text-[12px]"><?php echo $product['watering']; ?></p>
                            </div>
                            <div class="flex flex-col items-center min-w-[20%] border-1 px-2 py-4 rounded-2xl border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)]">
                                <img class="w-[1.5rem]" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABwElEQVR4nO3auU7DQBAG4H0Rdo6EGlFQESQUILMRrwANJRWnxPE6FBQIQYkEFc9Aap6BowW0Doccr4+AbI3R/tI2s87an0Z2MYoxNYcd7Phl2hxOEPg+XnBk2o/AdmI4iGgZhgsRLcFwJYRyDE+FUIrhEELwtVJNy6eZcxF2ZbJOQkvk4FldZ7gAMd5P7/maOgyXIPIgqjAouBlEDG0/jQ1Dkr2h7YfeGXK00RiEBUdliDJIHoYEHxqDkOBdGaIKJIQhwVvTVGbXLZPAOTm4IkcLeddVgfj4M9jBtT/Trlky2lIVoj4cIcoSO6ItsSPaEjuiLbEj2hI7oi2xI9oSO6ItsSPaor4jXTfTYYcXJHjZdTD/VwgOcM6fxYJnvMq2tgfPPKDA/c9AzU8MuffrcZDjXmrqKHBTO+D75gKP6elgGFM6oJtEuGRONmoMQg62s6POLKZwZBpCuOScrcYgCWYA+9khNL50BJbLIDy0iyTwFECcNoqoiglB1CG+QgJ7eZhMPQ8hcGI0hAUPw+9Mec3/1mgKOdgNdKZwkcCx0RiaAqMWMQ1GPeJf/YVjAvPWakT4a9ZShPkMOjzwq+4bfQBaoXzsevXcswAAAABJRU5ErkJggg==" alt="resize-vertical">
                                <p class="text-[12px]"><?php echo $product['height']; ?> cm</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex flex-col gap-2 w-full">

                    <div class="flex justify-between w-full">
                        <div>
                            <p class="text-[14px]">Price</p>
                            <p class="text-xl font-semibold">$<?php echo $product['price']; ?></p>
                        </div>
                        <button class=" text-white font-semibold bg-[#224820] p-3 rounded-full min-w-[70%]">ADD TO CART</button>
                    </div>

                    <div class="flex justify-between w-full mb-4">
                        <div class="flex items-center w-full gap-2">
                            <?php if (checkStock($product['stock']) === 1) : ?>
                                <div class="w-[15px] h-[15px] bg-[#FFDA47] rounded-full"></div>
                                <p class="text-[14px]">Low stock</p>
                            <?php elseif (checkStock($product['stock']) === 2) : ?>
                                <span class="w-[15px] h-[15px] bg-[#C4DDA9] rounded-full"></span>
                                <p class="text-[14px]">In stock</p>
                            <?php else : ?>
                                <span class="w-[15px] h-[15px] bg-[#FF474C] rounded-full"></span>
                                <p class="text-[14px]">No one in stock</p>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center justify-end w-full gap-2">
                            <img width="18" height="18" src="https://img.icons8.com/fluency-systems-regular/48/delivery.png" alt="delivery" />
                            <p class="text-[14px]">Deliver in 3 - 4 days</p>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach;  ?>
    <?php endif; ?>
</section>