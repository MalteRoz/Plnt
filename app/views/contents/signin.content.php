<?php
$content = 'Create Account';
include view('components/goback.php');
?>

<div class="flex flex-col w-full gap-4">
    <form action="" class="flex flex-col w-full gap-4">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="User123" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">

        <label for="email">Email</label>
        <input type="text" name="username" placeholder="user123@mail.com" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">

        <label for="pswrd">Password</label>
        <input type="text" name="pswrd" placeholder="MyPassword123!" class="flex p-3 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">

        <button type="submit" class="text-white font-semibold bg-[#224820] p-3 mt-4 rounded-full">Sign Up</button>
    </form>

    <div class="flex justify-center gap-2">
        <p>Already have an account?</p>
        <a href="/plnt/login" class="font-bold">Login Here</a>
    </div>
</div>