<?php

namespace Coderjerk\Hubsnot\Marketing;

use Coderjerk\Hubsnot\ApiBase;

class Forms extends ApiBase
{

    protected string $endpoint = 'forms';

    protected string $section = 'marketing';

    public $params = [];


    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Retrieves 20 forms from hubspot
     *
     * @return object
     */
    public function getForms()
    {
        return $this->get(
            $this->credentials,
            $this->endpoint,
            $this->section,
            $this->params
        );
    }
}
