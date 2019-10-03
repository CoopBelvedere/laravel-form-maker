<?php

namespace Belvedere\FormMaker\Tests\Unit\Traits;

use Belvedere\FormMaker\Models\Nodes\Inputs\Text\Texter;
use Belvedere\FormMaker\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasLabelTest extends TestCase
{
    use RefreshDatabase;

    protected $input;

    public function setUp(): void
    {
        parent::setUp();

        $this->input = Texter::forceCreate([
            'nodable_type' => 'test',
            'nodable_id' => 1,
            'type' => 'text'
        ]);
    }

    /** @test */
    public function add_label_sibling_to_a_parent_model()
    {
        $label = $this->input->addLabel('Label');

        $this->assertEquals('label', $label->type);
        $this->assertEquals('Label', $label->text);
    }

    /** @test */
    public function get_label_sibling_from_a_parent_model()
    {
        $this->input->addLabel('Label');
        $label = $this->input->label();

        $this->assertEquals('label', $label->type);
        $this->assertEquals('Label', $label->text);
    }

    /** @test */
    public function get_label_sibling_from_a_parent_model_when_label_doesnt_exist()
    {
        $label = $this->input->label();

        $this->assertNull($label);
    }
}