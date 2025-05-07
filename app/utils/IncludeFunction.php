<?php

function view($path)
{
    return $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/views/' . $path;
}

// function dataView($path, array $response = [])
// {
//     $viewPath = $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/views/' . $path;

//     if (file_exists($viewPath)) {
//         include $viewPath;
//     } else {
//         die("View not found: " . $viewPath);
//     }
// }


function dataView($path, array $response = [])
{
    extract($response); // Gör så att du kan använda $status, $message, $data direkt i vyn

    $viewPath = $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/views/' . $path;

    if (file_exists($viewPath)) {
        include $viewPath;
    } else {
        die("View not found: " . $viewPath);
    }
}
