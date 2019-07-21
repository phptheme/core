<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

abstract class BaseTableColumnAbstract extends \PhpTheme\Core\Widget
{

    abstract public function run();

    public function getAttributeValue()
    {
        return null;
    }

    public function renderAttribute()
    {
        return null;
    }

    public function renderContent()
    {
        return null;
    }

    public function renderHeader()
    {
        return null;
    }

    public function renderFooter()
    {
        return null;
    }    

    public function getHeader()
    {
        return null;
    }

    public function getFooter()
    {
        return null;
    }    

}