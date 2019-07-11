<?php

namespace PhpTheme\Core;

class TableAttributeColumn extends TableColumn
{

    public $attribute;

    protected function renderContent()
    {
        if ($this->attribute && $this->data && array_key_exists($this->attribute, $this->data))
        {
            return $this->data[$this->attribute];
        }

        return $this->renderDefaultContent();
    }

}