<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Ruleset
{
    /** @var Rules */
    private $rules;

    /** @var Uninflected */
    private $uninflected;

    /** @var Irregular */
    private $irregular;

    public function __construct(Rules $rules, Uninflected $uninflected, Irregular $irregular)
    {
        $this->rules       = $rules;
        $this->uninflected = $uninflected;
        $this->irregular   = $irregular;
    }

    public function getRules() : Rules
    {
        return $this->rules;
    }

    public function getUninflected() : Uninflected
    {
        return $this->uninflected;
    }

    public function getIrregular() : Irregular
    {
        return $this->irregular;
    }
}
