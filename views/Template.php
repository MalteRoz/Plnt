<!DOCTYPE html>
<html lang="en">
<?php
$filnamn = $_SERVER['DOCUMENT_ROOT'] . '/Plnt/views/components/head.php';
include $filnamn;
?>

<body>
    <div class="flex h-screen flex-col items-center">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/Plnt/views/components/searchbarMobile.php';
        ?>

        <main class="flex-1 pt-[76px] pb-[77px]">
            <div class="p-4">
                <?php
                // Här inkluderas huvudinnehållet (view-specifikt)
                if (isset($content)) {
                    include $content;
                }
                ?>
            </div>
        </main>

        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/Plnt/views/components/bottomnavbar.php';
        ?>
    </div>
</body>

</html>