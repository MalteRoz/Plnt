<?php
function buildUrl($context, $params)
{
    $basePath = '/plnt/products/' . $context;
    $queryString = http_build_query($params);
    return $basePath . '?' . $queryString;
}
