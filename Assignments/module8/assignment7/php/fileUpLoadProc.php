
<?php
require_once 'classes/PdoMethods.php';

function fileUpload(){
    $fileName = $_POST["fileName"] ?? '';
    $file = $_FILES["file"] ?? null;
    $filePath = "files/" . basename($fileName);

    if(checkFile($file) == 'pass'){
        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            return "Error moving uploaded file.";
        }

        $pdo = new PdoMethods();
        $sql = "INSERT INTO assignment7 (fileName, filePath) VALUES (:fileName, :filePath)";
        $bindings = [
            [':fileName', $fileName, 'str'],
            [':filePath', $filePath, 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            return "Database error";
        } else {
            return "file has been added";
        }
    } else {
        return checkFile($file);
    }
}

function checkFile($file){
    if ($file['error'] !== 0) {
        return "No file was uploaded. Make sure you choose a file to upload..";
    }
    elseif ($file['type'] !== 'application/pdf') {
        return 'File not PDF';
    }
    elseif ($file['size'] > 100000) {
        return "File is too large";
    } else {
        return 'pass'; 
    }
}
?>
