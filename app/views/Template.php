<!DOCTYPE html>
<html lang="en">
<?php
$filnamn = view('components/head.php');
include $filnamn;
?>

<body>
    <div class="flex h-screen flex-col items-center">
        <?php
        include view('components/searchbarMobile.php');
        ?>

        <main class="flex-1 pt-[76px] pb-[77px]">
            <div class="p-4 h-full">
                <?php
                if (isset($content) && file_exists($content)) {
                    include $content;
                } else {
                    echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $content</p>";
                }
                ?>
            </div>
        </main>

        <?php
        include view('components/bottomnavbar.php');
        ?>
    </div>
</body>

</html>