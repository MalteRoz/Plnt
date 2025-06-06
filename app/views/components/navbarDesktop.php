<?php


$navItems = [
    [
        'name' => 'Home',
        'route' => '/plnt/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0 0 48 48">
                    <path d="M 23.951172 4 A 1.50015 1.50015 0 0 0 23.072266 4.3222656 L 8.859375 15.519531 C 7.0554772 16.941163 6 19.113506 6 21.410156 L 6 40.5 C 6 41.863594 7.1364058 43 8.5 43 L 18.5 43 C 19.863594 43 21 41.863594 21 40.5 L 21 30.5 C 21 30.204955 21.204955 30 21.5 30 L 26.5 30 C 26.795045 30 27 30.204955 27 30.5 L 27 40.5 C 27 41.863594 28.136406 43 29.5 43 L 39.5 43 C 40.863594 43 42 41.863594 42 40.5 L 42 21.410156 C 42 19.113506 40.944523 16.941163 39.140625 15.519531 L 24.927734 4.3222656 A 1.50015 1.50015 0 0 0 23.951172 4 z M 24 7.4101562 L 37.285156 17.876953 C 38.369258 18.731322 39 20.030807 39 21.410156 L 39 40 L 30 40 L 30 30.5 C 30 28.585045 28.414955 27 26.5 27 L 21.5 27 C 19.585045 27 18 28.585045 18 30.5 L 18 40 L 9 40 L 9 21.410156 C 9 20.030807 9.6307412 18.731322 10.714844 17.876953 L 24 7.4101562 z"></path>
                    </svg>'
    ],
    [
        'name' => 'Products',
        'route' => '/plnt/products/category',
        'icon' => '<img width="18" height="18" src="https://img.icons8.com/puffy/32/potted-plant.png" alt="potted-plant"/>'
    ],
    [
        'name' => 'Account',
        'route' => '/plnt/account',
        'icon' => '<img width="18" height="18" src="https://img.icons8.com/pastel-glyph/64/gender-neutral-user.png" alt="gender-neutral-user"/>'
    ],
    [
        'name' => 'Cart',
        'route' => '/plnt/cart',
        'icon' => '<img width="18" height="18" src="https://img.icons8.com/fluency-systems-regular/48/shopping-bag--v1.png" alt="shopping-bag--v1"/>'
    ]

];

$currentPagePath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

?>

<div class="hidden md:flex justify-center p-4 w-full">
    <nav class="flex justify-between items-center w-full max-w-[1024px] p-4 rounded-2xl border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)] fixed top-4 z-50">
        <div class="flex gap-8 ">
            <a href="/plnt/">
                <img src="/Plnt/public/LOGO.svg" alt="" class="flex w-[2rem]">
            </a>
            <form action="/plnt/products/search" method="GET" class="flex items-center  p-2 rounded-full border-1 border-zinc-300 bg-white shadow-[0_0_5px_rgba(0,0,0,0.1)]">
                <input type="text" name="query" placeholder="type something" class="">
                <button type="submit">
                    <i class='bx bx-search bx-sm text-zinc-400'></i>
                </button>
            </form>
        </div>
        <div class="flex items-center justify-center gap-8">
            <?php foreach ($navItems as $key => $value) : ?>
                <div class="<?= $currentPagePath === $value['route'] ? 'flex flex-col items-center rounded-full border-3 border-[#C4DDA9] p-2' : 'flex flex-col items-center' ?>">
                    <a href="<?= $value['route']; ?>" class="relative flex flex-col items-center">
                        <?php if ($value['name'] === 'Home' || $value['name'] === 'Products') : ?>
                            <?= $value['name']; ?>
                        <?php elseif ($value['name'] === 'Account' || $value['name'] === 'Cart') : ?>
                            <?= $value['icon']; ?>
                            <?php if (($value['name'] === 'Cart') && !empty($_SESSION['totalItems'])) : ?>
                                <span class="absolute top-[-10px] right-[-10px] flex items-center justify-center bg-[#C4DDA9] w-[20px] h-[20px] rounded-full">
                                    <p class="flex text-[#224820] font-bold text-[0.75rem]"><?php echo $_SESSION['totalItems']; ?></p>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </nav>
</div>