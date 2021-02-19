<?PHP

    $target_input = __DIR__ . DIRECTORY_SEPARATOR . "input.txt";
    $content_hash = hash("sha256", file_get_contents($target_input));

    while(True)
    {
        $current_content_hash = hash("sha256", file_get_contents($target_input));
        if($content_hash == $current_content_hash)
            continue;
        $content_hash = $current_content_hash;
        $content = explode("\n", file_get_contents($target_input));
        $category = $content[0];
        $category = str_ireplace("\n", "", $category);
        if(strlen($category) == 0)
            continue;
        print($current_content_hash . ":" . $category. PHP_EOL);
        array_shift($content);
        array_splice($content, 0, 1);

        $constructed_content = str_ireplace("\n", "\\n", implode("\n", $content));
        while(stripos($constructed_content, "  "))
        {
            $constructed_content = str_ireplace("  ", " ", $constructed_content);
        }

        $target_file = __DIR__ . DIRECTORY_SEPARATOR . "chatrooms" . DIRECTORY_SEPARATOR . $category . ".dat";
        file_put_contents($target_file, $constructed_content . "\n", FILE_APPEND | LOCK_EX);
    }