<?php

namespace PhpTheme\Core;

class TableAttributeColumn extends TableColumn
{

    public $attribute;

    protected function renderContent()
    {
        if ($this->attribute && $this->row && array_key_exists($this->attribute, $this->row))
        {
            return $this->row[$this->attribute];
        }

        return $this->renderDefaultContent();
    }

}