<?php
/**
 * @copyright Copyright (c) 2018-2019 getphptheme.com
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Core;

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

        return $this->theme->createWidget(static::MENU_ITEM, $params);
    }

    protected function itemIsActive($item)
    {
        if (array_key_exists('active', $item))
        {
            return $item['active'];
        }

        if (array_key_exists('items', $item))
        {
            foreach($item['items'] as $k => $v)
            {
                if ($this->itemIsActive($v))
                {
                    return true;
                }
            }
        }

        return false;
    }

    protected function prepareItem(array $item)
    {
        if ($this->itemIsActive($item))
        {
            $item['active'] = true;
        }

        return $item;
    }

    public function run()
    {
        $items = [];

        foreach($this->items as $key => $item)
        {
            $item = $this->prepareItem($item);

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