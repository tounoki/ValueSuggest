<?php
namespace ValueSuggest\Suggester\Tematres;

use ValueSuggest\Suggester\SuggesterInterface;
use Zend\Http\Client;

class ReprSuggest implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve suggestions from the Geonames web services API.
     *
     * @see http://www.geonames.org/export/geonames-search.html
     * @param string $query
     * @return array
     */
    public function getSuggestions($query)
    {
        /*
        $response = $this->client
        ->setUri('http://api.geonames.org/searchJSON')
        ->setParameterGet(['q' => $query, 'maxRows' => 100, 'username' => 'kdlinfo'])
        ->send();
        if (!$response->isSuccess()) {
            return [];
        }*/
        $response = $this->client
        ->setUri('http://museo.tounoki.org/thesaurus/representation/services.php')
        ->setParameterGet(['arg' => $query, 'task' => "suggestDetails", 'output' => 'json'])
        ->send();
        if (!$response->isSuccess()) {
            return [];
        }

        // Parse the JSON response.
        /*$suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['geonames'] as $result) {
            $info = array_key_exists('fclName', $result) ? $result['fclName'] : '';
            $info = $info . (array_key_exists('countryName', $result) ? ' in ' . $result['countryName'] : '');

            $suggestions[] = [
                'value' => $result['name'] . ' (' . $info . ')',
                'data' => [
                    'uri' => sprintf('http://www.geonames.org/%s', $result['geonameId']),
                    'info' => $info,
                ],
            ];
        }*/
        $suggestions = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results['result'] as $result) {
            //$info = array_key_exists('term_id', $result) ? $result['term_id'] : '';
            //$info = $info . (array_key_exists('string', $result) ? ' in ' . $result['string'] : '');
            $info = "" ;

            $suggestions[] = [
                'value' => $result['string'] ,
                'data' => [
                    'uri' => sprintf('http://museo.tounoki.org/thesaurus/representation/index.php?tema=%s', $result['term_id']),
                    'info' => $info,
                ],
            ];
        }
        return $suggestions;
    }
}
