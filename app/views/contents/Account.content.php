<?php
$content = 'Account';
include view('components/goback.php');
require $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/utils/Flash.php';


if (session_status() === PHP_SESSION_NONE) session_start();


?>

<section class="flex flex-col md:justify-center md:items-center mt-16">
    <?php if (isset($_SESSION['userid'])) : ?>
        <div class=" flex flex-col gap-8 md:w-[50%]">
            <div class="flex flex-col border-zinc-300 rounded-2xl bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] p-4 gap-2">
                <p>Name: <?php echo $_SESSION["name"]; ?></p>
                <p>Email: <?php echo $_SESSION["email"]; ?></p>
                <p>Created at: <?php echo $_SESSION["created_at"]; ?></p>
            </div>
            <div class="flex flex-col gap-4 items-center">
                <form method="POST" action="/plnt/logout" class="w-full">
                    <button type="submit" name="logout" class="font-bold text-[#224820] border-[zinc-300] rounded-2xl bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] p-4 w-full cursor-pointer">
                        Logout
                    </button>
                </form>
                <a class="text-[#8B3537] text-[0.75rem] font-semibold" href="">Delete Account</a>
            </div>
        </div>


    <?php else : ?>
        <div class="flex flex-col justify-center items-center gap-2 w-full mt-16">
            <p>You are logged out</p>
            <a class=" font-semibold" href="/plnt/login">Log in here</a>
        </div>
    <?php endif; ?>
</section>