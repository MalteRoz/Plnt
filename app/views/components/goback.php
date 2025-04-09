<div class="flex items-center mb-16 mt-8 w-full justify-between">

    <a href="http://localhost/plnt/" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] h-10 w-10 ">
        <i class="fa-solid fa-arrow-left"></i>
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
    <a class="flex p-3 rounded-full bg-white shadow-[0_0_0px_rgba(0,0,0,0.1)] h-10 w-10 ">
        <!-- <i class="fa-solid fa-arrow-left"></i> -->
    </a>
</div>