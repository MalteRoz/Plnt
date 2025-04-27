<?php

function view($path)
{
    return $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/views/' . $path;
}

function dataView($path, array $response = [])
{
    $viewPath = $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/views/' . $path;

    if (file_exists($viewPath)) {
        include $viewPath;
    } else {
        die("View not found: " . $viewPath);
    }
}
