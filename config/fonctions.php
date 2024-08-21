<?php
declare(strict_types=1);

function dbug($value)
{
    echo '<pre style="background-color:black;color:white;overflow: auto;padding: 1rem;font-family:monospace;">';
    print_r($value);
    echo '</pre>';
}

function dd($value)
{
    dbug($value);
    die('Script php arrété !');
}