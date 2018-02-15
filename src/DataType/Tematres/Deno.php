<?php
namespace ValueSuggest\DataType\Tematres;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Tematres\DenoSuggest;

class Deno extends AbstractDataType
{
    public function getSuggester()
    {
        return new DenoSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:tematres:deno';
    }

    public function getLabel()
    {
        return 'Tematres Vocabularie Dénomination'; // @translate
    }
}
