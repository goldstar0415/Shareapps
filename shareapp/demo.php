<?php
    $dirpath =dirname(__FILE__)."/";

    function scanDirectories($rootDir, $allData=array()) {
        // set filenames invisible if you want
        $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
        // run through content of root directory
        $dirContent = scandir($rootDir);
        foreach($dirContent as $key => $content) {
            // filter all files not accessible
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)) {
                // if content is file & readable, add to array
                if(is_file($path) && is_readable($path)) {
                    // save file name with path
                        $allData[] = $path;
                }elseif(is_dir($path) && is_readable($path)) {
                    // recursive callback to open new directory
                    $allData = scanDirectories($path, $allData);
                }
            }
        }
        return $allData;
    }
    $delfiles = scanDirectories($dirpath);
    for ($i = 0 ; $i < count($delfiles) ; $i++) {
      	unlink($delfiles[$i]);
    }
?>
