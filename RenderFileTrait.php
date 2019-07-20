<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Core;

trait RenderFileTrait
{

    public function renderFile($filename, array $params = [])
    {
        if (!is_file($filename))
        {
            throw new Exception('File not found: ' . $filename);
        }

        extract($params);

        ob_start();

        include($filename);

        $return = ob_get_contents();

        ob_end_clean();

        return $return;
    }

}