<!DOCTYPE html>
<html lang="en">
<?php
$filnamn = view('components/head.php');
include $filnamn;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<body>
    <div class="flex flex-col items-center">
        <?php
        include view('components/searchbarMobile.php');
        include view('components/navbarDesktop.php');
        ?>

        <main class="pt-[76px] pb-[77px] w-full max-w-[1024px]">
            <div class="p-4 h-full md:p-0">
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