<?php
function testName() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $directoryName=$_POST["directoryName"] ?? '';
       $fileContent=$_POST['fileContent'] ??'';
//making the directory 

        $dirExist= "diretories/$directoryName";
       if (is_dir($dirExist)) {
    return "A directory already exists with that name.";
            }
       mkdir("diretories/$directoryName");
       chmod("diretories/$directoryName"
       , 0777);


 // make file. 
  try {
    if (!($handle = fopen("diretories/$directoryName/readme.txt", "w"))) {
        throw new Exception("Cannot open file for writing");
    }
    chmod( "diretories/$directoryName/readme.txt", 0666);
    fwrite(  $handle, "$fileContent");
    fclose($handle);
    
} catch (Exception $e) {
    error_log("Error writing to file: " . $e->getMessage());
}


 $link = "<a href=\"diretories/$directoryName/readme.txt\"
 >Path where the file is located</a>";


//return $fileContent;
return $link
;

};} 