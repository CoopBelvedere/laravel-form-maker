<?php

namespace Belvedere\FormMaker\Tests\Unit;

use Belvedere\FormMaker\Contracts\Models\Rules\RulerContract;
use Belvedere\FormMaker\Tests\TestCase;

class RulerTest extends TestCase
{
    protected $ruler;

    public function setUp(): void
    {
        parent::setUp();

        $this->ruler = resolve(RulerContract::class);
    }

    /** @test */
    public function can_add_accepted_rule()
    {
        $this->ruler->accepted = 'accepted';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('accepted', $attributes);
        $this->assertEquals('accepted', $attributes['accepted']);
        $this->ruler->clearRules();
    }
}