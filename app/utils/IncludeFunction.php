<?php

function view($path)
{
    return $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/views/' . $path;
}

function dataView($path, array $data = [])
{
    $viewPath = $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/views/' . $path;

    // if (is_array($data) && $data !== null) {
    //     extract($data);
    // }

    if (file_exists($viewPath)) {
        // Inkludera vyn (variabler från $data blir tillgängliga här om de skickades med)
        include $viewPath;
    } else {
        // Hantera fallet om vyn inte hittas (du kan anpassa felhanteringen)
        die("View not found: " . $viewPath);
    }
}
