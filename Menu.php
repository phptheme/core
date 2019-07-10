<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PHPTheme\Core;

use PhpTheme\Core\Html;

class Menu extends \PHPTheme\Core\Widget
{

    const MENU_ITEM = MenuItem::class;

    public $items = [];

    public $options = [];

    public $defaultOptions = [];

    public $tag;

    public $defaultItem = [];

    protected function createItem(array $params = [])
    {
        $params = Html::mergeOptions($this->defaultItem, $params);

        $params['menu'] = $this;

        return $this->theme->createWidget(static::MENU_ITEM, $params);
    }

    public function run()
    {
        $items = [];

        foreach($this->items as $key => $item)
        {
            $items[$key] = $this->createItem($item);
        }

        $content = '';

        foreach($items as $item)
        {
            $content .= $item->run();
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}