<?php
$content = 'Create Account';
include view('components/goback.php');

if (session_status() === PHP_SESSION_NONE) session_start();

function old($field)
{
    return $_SESSION['old_input'][$field] ?? '';
}

function error($field)
{
    return $_SESSION['validation_errors'][$field] ?? '';
}

$flash = Flash::get();
?>

<div class="flex flex-col justify-center items-center w-full mt-16">
    <div class="flex flex-col w-full gap-4 md:w-[50%]">
        <form method="POST" action="/plnt/signup" class="flex flex-col w-full gap-2">

            <input type="text" name="name" placeholder="Enter name" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
            <span class="error"><?= error('name') ?></span>


            <input type="text" name="email" placeholder="Enter your email" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
            <span class="error"><?= error('email') ?></span>

            <input type="text" name="pswrd" placeholder="Enter password" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
            <span class="error"><?= error('pswrd') ?></span>

            <input type="text" name="pswrd-rep" placeholder="Repeat password" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
            <span class="error"><?= error('pswrd-rep') ?></span>

            <input type="text" name="adress" placeholder="Enter your adress" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
            <span class="error"><?= error('adress') ?></span>

            <input type="text" name="postcode" placeholder="Enter your postalcode" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
            <span class="error"><?= error('postcode') ?></span>


            <input type="text" name="city" placeholder="Enter city" class="flex p-3 rounded-xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
            <span class="error"><?= error('city') ?></span>

            <button type="submit" class="text-white font-semibold bg-[#224820] p-3 mt-4 rounded-xl">Sign Up</button>
        </form>

        <div class="flex justify-center gap-2">
            <p>Already have an account?</p>
            <a href="/plnt/login" class="font-bold">Login Here</a>
        </div>

        <div class="flex items-center justify-center">
            <?php if ($flash) :  ?>
                <p class="font-semibold text-xl"><?php echo htmlspecialchars($flash['message']); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
unset($_SESSION['validation_errors']);
unset($_SESSION['old_input']);
?>