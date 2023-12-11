<?php

namespace Coderjerk\Hubsnot;

use Coderjerk\Hubsnot\Marketing\Forms;

class Hubsnot
{
    /**
     * Private App credentials
     *
     * @var array
     */
    protected array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Access form endpoints
     *
     * @return Forms
     */
    public function forms(): Forms
    {
        return new Forms($this->credentials);
    }
}
