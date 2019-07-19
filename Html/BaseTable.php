<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;
use Closure;

abstract class BaseTable extends \PhpTheme\Core\Widget
{

    protected $tableRowClass = Tag::class;

    protected $tableHeaderClass = TableHeader::class;

    protected $tableFooterClass = TableFooter::class;

    protected $tableBodyClass = TableBody::class;

    protected $tableColumnClass = TableColumn::class;

    public $defaultRow;

    public $defaultRowOptions = ['tag' => 'tr'];

    public $rows = [];

    public $columns = [];

    public $options = [];

    public $defaultOptions = [];

    public $header = [];

    public $defaultHeaderOptions = [];

    public $footer = [];

    public $defaultFooterOptions = [];

    public $body = [];

    public $defaultBodyOptions = [];

    public $defaultColumnOptions = [];

    public function renderRow($content)
    {
        $options = Html::mergeOptions($this->defaultRowOptions, ['content' => $content]);

        return $this->theme->widget($this->tableRowClass, $options);
    }

    public function rowColumns($row)
    {
        $columns = $this->columns;

        if ($columns instanceof Closure)
        {
            $columns = $columns->bindTo($this);

            $columns = $columns($row);
        }

        return $columns;
    }

    protected function renderHeader()
    {
        $options = Html::mergeOptions(
            $this->defaultHeaderOptions, 
            $this->header,
            [
                'table' => $this
            ]
        );

        return $this->theme->widget($this->tableHeaderClass, $options);
    }

    protected function renderFooter()
    {
        $options = Html::mergeOptions(
            $this->defaultFooterOptions, 
            $this->footer,
            [
                'table' => $this
            ]
        ); 

        return $this->theme->widget($this->tableFooterClass, $options);
    }

    protected function renderBody()
    {
        $options = Html::mergeOptions(
            $this->defaultBodyOptions, 
            $this->body, 
            [
                'table' => $this
            ]
        );

        return $this->theme->widget($this->tableBodyClass, $options);
    }

    public function createColumn($options = [])
    {
        $options = Html::mergeOptions($this->defaultColumnOptions, $options);

        if (array_key_exists('class', $options))
        {
            $class = $options['class'];

            unset($options['class']);
        }
        else
        {
            $class = $this->tableColumnClass;
        }

        return $this->theme->createWidget($class, $options);
    }

    protected function prepareColumns()
    {
        foreach($this->columns as $key => $column)
        {
            if (is_string($column))
            {
                $column = ['content' => $column];
            }

            if (is_array($column))
            {
                $column = $this->createColumn($column);
            }

            $this->columns[$key] = $column;
        }
    }

    public function run()
    {
        $this->prepareColumns();

        $content = $this->renderHeader() . $this->renderBody() . $this->renderFooter();

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag('table', $content, $options);
    }

}