<?php
/**
 * @author PhpTheme Dev Team <dev@getphptheme.com>
 * @license MIT
 * @link http://getphptheme.com
 */
namespace PhpTheme\Core;

trait RenderFileTrait
{

    public function renderFile($filename, array $params = [])
    {
        extract($params);

        ob_start();

        require($filename);

        $return = ob_get_contents();

        ob_end_clean();

        return $return;
    }

}