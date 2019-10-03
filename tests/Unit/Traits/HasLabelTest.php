<?php

namespace Belvedere\FormMaker\Tests\Unit\Traits;

use Belvedere\FormMaker\Models\Form\Form;
use Belvedere\FormMaker\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasLabelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }
}