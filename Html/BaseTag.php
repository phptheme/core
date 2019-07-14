<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;

abstract class BaseTag extends \PhpTheme\Core\Widget
{

    public $tag;

    public $options = [];

    public $defaultOptions = [];

    public $renderEmpty = true;

    public function run()
    {
        if (!$this->content && !$this->renderEmpty)
        {
            return '';
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $this->content, $options);
    }

}