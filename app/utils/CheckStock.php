<?php

function checkStock(int $stock)
{
    if ($stock < 10) {
        return 1;
    } else if ($stock > 10) {
        return 2;
    } else {
        return 3;
    }
}
