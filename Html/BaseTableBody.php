<?php
/**
 * @copyright Copyright (c) 2018-2019 PhpTheme Dev Team
 * @link http://getphptheme.com
 * @license MIT License
 */
namespace PhpTheme\Html;

use PhpTheme\Helpers\Html;

class TableBody extends \PhpTheme\Core\Widget
{

    public $table; // parent table

    public $tag = 'tbody';

    public $options = [];

    public $defaultOptions = [];

    public function run()
    {
        $content = '';

        foreach($this->table->rows as $row)
        {
            $rowContent = '';

            foreach($this->table->getRowColumns($row) as $column)
            {
                $column->row = $row;

                $rowContent .= $column->run();
            }

            $content .= $this->table->renderRow($rowContent);
        }

        $options = Html::mergeOptions($this->defaultOptions, $this->options);

        return Html::tag($this->tag, $content, $options);
    }

}