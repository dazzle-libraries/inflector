<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Uninflected;
use Doctrine\Inflector\RulesetInflector;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RulesetInflectorTest extends TestCase
{
    /** @var Ruleset|MockObject */
    private $ruleset;

    /** @var RulesetInflector */
    private $rulesetInflector;

    public function testInflectIrregular() : void
    {
        /** @var Irregular|MockObject $irregular */
        $irregular = $this->createMock(Irregular::class);

        $this->ruleset->expects($this->once())
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular->expects($this->once())
            ->method('inflect')
            ->with('in')
            ->willReturn('out');

        self::assertEquals('out', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectUninflected() : void
    {
        /** @var Irregular|MockObject $irregular */
        $irregular = $this->createMock(Irregular::class);

        /** @var Uninflected|MockObject $uninflected */
        $uninflected = $this->createMock(Uninflected::class);

        $this->ruleset->expects($this->once())
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular->expects($this->once())
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $uninflected = $this->createMock(Uninflected::class);

        $this->ruleset->expects($this->once())
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected->expects($this->once())
            ->method('isUninflected')
            ->with('in')
            ->willReturn(true);

        self::assertEquals('in', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectRules() : void
    {
        /** @var Irregular|MockObject $irregular */
        $irregular = $this->createMock(Irregular::class);

        /** @var Uninflected|MockObject $uninflected */
        $uninflected = $this->createMock(Uninflected::class);

        /** @var Rules|MockObject $rules */
        $rules = $this->createMock(Rules::class);

        $this->ruleset->expects($this->once())
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular->expects($this->once())
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $uninflected = $this->createMock(Uninflected::class);

        $this->ruleset->expects($this->once())
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected->expects($this->once())
            ->method('isUninflected')
            ->with('in')
            ->willReturn(false);

        $this->ruleset->expects($this->once())
            ->method('getRules')
            ->willReturn($rules);

        $rules->expects($this->once())
            ->method('inflect')
            ->with('in')
            ->willReturn('out');

        self::assertEquals('out', $this->rulesetInflector->inflect('in'));
    }

    protected function setUp() : void
    {
        $this->ruleset = $this->createMock(Ruleset::class);

        $this->rulesetInflector = new RulesetInflector($this->ruleset);
    }
}
