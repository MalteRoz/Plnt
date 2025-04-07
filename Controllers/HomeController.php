<?php
class HomeController
{
    public function show()
    {
        require $_SERVER['DOCUMENT_ROOT'] . '/Plnt/views/Home.php';
    }
}
