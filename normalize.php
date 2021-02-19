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

        $current_index = 0;
        $constructed_content = "";
        foreach($content as $line)
        {
            if($current_index > 0)
            {
                $constructed_content .= $line . "\n";
            }
            $current_index += 1;
        }

        $constructed_content = str_ireplace("\n", "\\n", $constructed_content);
        while(stripos($constructed_content, "  "))
        {
            $constructed_content = str_ireplace("  ", " ", $constructed_content);
        }

        $target_file = __DIR__ . DIRECTORY_SEPARATOR . "chatrooms" . DIRECTORY_SEPARATOR . $category . ".dat";
        print($current_content_hash . ":" . $category. PHP_EOL);
        file_put_contents($target_file, $constructed_content . "\n", FILE_APPEND | LOCK_EX);
    }