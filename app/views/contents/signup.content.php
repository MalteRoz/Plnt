<?php
$content = 'Create Account';
include view('components/goback.php');

session_start();

function old($field)
{
    return $_SESSION['old_input'][$field] ?? '';
}

function error($field)
{
    return $_SESSION['validation_errors'][$field] ?? '';
}
?>

<div class="flex flex-col w-full gap-4">
    <form method="POST" action="/plnt/signup" class="flex flex-col w-full gap-4">
        <label for="Name">Name</label>
        <input type="text" name="name" placeholder="User123" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
        <span class="error"><?= error('name') ?></span>


        <label for="email">Email</label>
        <input type="text" name="email" placeholder="user123@mail.com" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
        <span class="error"><?= error('email') ?></span>

        <label for="pswrd">Password</label>
        <input type="text" name="pswrd" placeholder="MyPassword123!" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
        <span class="error"><?= error('pswrd') ?></span>

        <label for="pswrd-rep">Password Repeat</label>
        <input type="text" name="pswrd-rep" placeholder="MyPassword123!" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
        <span class="error"><?= error('pswrd-rep') ?></span>

        <label for="adress">Street Adress</label>
        <input type="text" name="adress" placeholder="MyAdress" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
        <span class="error"><?= error('adress') ?></span>

        <label for="postcode">Postcode</label>
        <input type="text" name="postcode" placeholder="123 123" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
        <span class="error"><?= error('postcode') ?></span>


        <label for="city">City</label>
        <input type="text" name="city" placeholder="Stockholm" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
        <span class="error"><?= error('city') ?></span>

        <button type="submit" class="text-white font-semibold bg-[#224820] p-3 mt-4 rounded-full">Sign Up</button>
    </form>

    <div class="flex justify-center gap-2">
        <p>Already have an account?</p>
        <a href="/plnt/login" class="font-bold">Login Here</a>
    </div>
</div>

<?php
unset($_SESSION['validation_errors']);
unset($_SESSION['old_input']);
?>