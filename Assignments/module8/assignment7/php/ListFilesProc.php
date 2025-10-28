
<?php
require 'classes/PdoMethods.php';

function listfiles(){


$pdo = new PdoMethods();
$sql = "SELECT fileName, filePath FROM assignment7";

$files = $pdo->selectNotBinded($sql);

if ($files === false || count($files) === 0) {
    return "No files found";
} else {
    $output = "<ul>";
foreach ($files as $file) {
    $output .= "<li><a target='_blank' href='{$file['filePath']}'>{$file['fileName']}</a></li>";
}
$output .= "</ul>";

    return $output; 
}}

