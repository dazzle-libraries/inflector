<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    /** @var Word */
    private $word;

    public function testGetWord() : void
    {
        self::assertEquals('test', $this->word->getWord());
    }

    protected function setUp() : void
    {
        $this->word = new Word('test');
    }
}
