<?php

require_once 'init.php';
$dirlocation = 'C:\Users\cmast\Desktop\CODEX';
$fileinfos = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dirlocation)
);
$i = 0;
foreach ($fileinfos as $pathname => $fileinfo) {
    if (in_array($pathname, ['.', '..'])) {
           continue;
    }

    if (!$fileinfo->isFile()) {
        continue;
    }

// if (strpos($pathname, DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR)) {
//      continue;
// }
// if (strpos($pathname, DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR)) {
//     continue;
// }
 
    $content = file_get_contents($pathname);



             $withpath = explode('\\', $pathname);
            $fname = array_pop($withpath);
           $name = ucfirst(str_replace(['-', '_', ',', '.txt', '.php', '.docs'], [' ', ' ', ' ', '', '', ''], $fname));

    $code = new Snip();
    $code->title = $name;
    $code->code_text = $content;
    $code->id_project =1;
    $code->id_category =1;
    $code->created_at = filemtime($pathname);

    $code->add();
    $i++;
}


echo $i.' files added to snips ';
