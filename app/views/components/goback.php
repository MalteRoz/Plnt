<div class="flex items-center w-full justify-between ">
    <!-- mb-16 mt-8 -->
    <a href="http://localhost/plnt/" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-10 w-10 ">
        <img width="48" height="48" src="https://img.icons8.com/fluency-systems-filled/48/long-arrow-left.png" alt="long-arrow-left" />
    </a>
    <p class="text-[1.25rem]">
        <?php
        if (isset($content)) {
            echo $content;
        } else {
            echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $content</p>";
        }
        ?>
    </p>
    <?php
    if (isset($like)) {
        echo '<a href="" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-10 w-10 ">
                <img width="48" height="48" src="https://img.icons8.com/fluency-systems-regular/48/like--v1.png" alt="like--v1" />
              </a>';
    } else {
        echo '<a class="flex p-3 rounded-full bg-white shadow-[0_0_0px_rgba(0,0,0,0.1)] h-10 w-10 ">
                <!-- <i class="fa-solid fa-arrow-left"></i> -->
              </a>';
    }
    ?>
</div>