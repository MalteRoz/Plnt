<!DOCTYPE html>
<html lang="en">
<?php
$filnamn = $_SERVER['DOCUMENT_ROOT'] . '/Plnt/views/components/head.php';
include $filnamn;
?>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Plnt/views/components/searchbarMobile.php';
    ?>

    <main class="flex h-screen flex-col items-center justify-center p-4">
        <?php
        // Här inkluderas huvudinnehållet (view-specifikt)
        if (isset($content)) {
            include $content;
        }
        ?>
    </main>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Plnt/views/components/bottomnavbar.php';
    ?>
</body>

</html>