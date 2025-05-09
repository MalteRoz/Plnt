<?php
$content = 'Login';
include view('components/goback.php');


if (session_status() === PHP_SESSION_NONE) session_start();

$flash = Flash::get();
?>

<div class="flex w-full justify-center items-center mt-16">
    <div class="flex flex-col w-full gap-4 md:w-[50%]">
        <form method="POST" action="/plnt/login" class="flex flex-col w-full gap-4">
            <input type="text" name="email" placeholder="Email" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">

            <input type="text" name="pswrd" placeholder="Password" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">

            <button type="submit" class="text-white font-semibold bg-[#224820] p-3 mt-4 rounded-xl cursor-pointer">Log In</button>
        </form>

        <div class="flex justify-center gap-2">
            <p>New to Plnt?</p>
            <a href="/plnt/signup" class="font-bold">Create account here</a>
        </div>

        <div class="flex items-center justify-center">
            <?php if ($flash) :  ?>
                <p class="font-semibold text-xl"><?php echo htmlspecialchars($flash['message']); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>