<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function showListedTemplate($templateName, $output, $tableName, $id) {
    switch ($templateName) {
        case "default":
            echo $output[0]." - ".$output[1];
            break;

        case "no":
            echo "no";
            break;

        default:
            echo $tableName . "<br>";
            echo $id . "<br>";
            print_r($output);
            echo "<hr>";
    }
}

function pageNumberTemplate($page, $pages) {
    $first = 1;
    $prev = $page - 1;
    $next = $page + 1;
    $last = $pages;
    echo "<br><p style=\"text-align:center\">";
    if ($page > 1) {
        echo "<a href='listTemplate.php?page=" . $first . "'>|-</a>&nbsp&nbsp";
        echo "<a href='listTemplate.php?page=" . $prev . "'> -- </a>&nbsp&nbsp";
    }
    for ($i = 1; $i <= $pages; $i++) {
        if ($i == $page) {
            echo $i . "&nbsp&nbsp";
        } else {
            echo "<a href='listTemplate.php?page=" . $i . "'>[" . $i . "]</a>&nbsp&nbsp";
        }
    }
    if ($page < $pages) {
        echo "<a href='listTemplate.php?page=" . $next . "'>--</a>&nbsp&nbsp";
        echo "<a href='listTemplate.php?page=" . $last . "'>-|</a> ";
    }
    echo "</p>";
}
