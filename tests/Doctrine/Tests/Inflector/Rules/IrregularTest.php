<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Rule;
use Generator;
use PHPUnit\Framework\TestCase;
use function is_array;
use function iterator_to_array;

class IrregularTest extends TestCase
{
    /** @var Rule[] */
    private $rules;

    /** @var Irregular */
    private $irregular;

    public function testGetFlippedRules() : void
    {
        $flippedRules = $this->irregular->getFlippedRules();

        self::assertInstanceOf(Generator::class, $flippedRules);

        $flippedRulesArray = is_array($flippedRules) ? $flippedRules : iterator_to_array($flippedRules, false);

        self::assertEquals([new Rule('spinor', 'spins')], $flippedRulesArray);
    }

    public function testGetRules() : void
    {
        $rules = $this->irregular->getRules();

        self::assertInstanceOf(Generator::class, $rules);

        $rulesArray = is_array($rules) ? $rules : iterator_to_array($rules, false);

        self::assertEquals([new Rule('spins', 'spinor')], $rulesArray);
    }

    public function testInflect() : void
    {
        self::assertEquals('spinor', $this->irregular->inflect('spins'));
    }

    protected function setUp() : void
    {
        $this->rules = [
            new Rule('spins', 'spinor'),
        ];

        $this->irregular = new Irregular(...$this->rules);
    }
}
