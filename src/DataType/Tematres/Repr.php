<?php
namespace ValueSuggest\DataType\Tematres;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Tematres\ReprSuggest;

class Repr extends AbstractDataType
{
    public function getSuggester()
    {
        return new ReprSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:tematres:repr';
    }

    public function getLabel()
    {
        return 'Tematres Vocabularie Représentation'; // @translate
    }
}
