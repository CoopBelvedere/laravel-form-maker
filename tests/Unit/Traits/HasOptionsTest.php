<?php

namespace Belvedere\FormMaker\Tests\Unit\Traits;

use Belvedere\FormMaker\Models\Nodes\Inputs\Select\Selecter;
use Belvedere\FormMaker\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasOptionsTest extends TestCase
{
    use RefreshDatabase;

    protected $select;

    public function setUp(): void
    {
        parent::setUp();

        $this->select = Selecter::forceCreate([
            'nodable_type' => 'test',
            'nodable_id' => 1,
            'type' => 'select'
        ]);
    }

    /** @test */
    public function add_option_input_to_a_parent_model()
    {
        $option = $this->select->addOption(['title' => 'Cat', 'value' => 'cat', 'text' => 'Cat!']);

        $this->assertEquals(true, $this->select->ranking->inRanking($option));
        $this->assertEquals('option', $option->type);
        $this->assertEquals('Cat!', $option->text);
        $this->assertEquals('Cat', $option->html_attributes['title']);
        $this->assertEquals('cat', $option->html_attributes['value']);
    }

    /** @test */
    public function add_multiple_options_input_to_a_parent_model()
    {
        $options = $this->select->addOptions(
            ['title' => 'Cat', 'value' => 'cat', 'text' => 'Cat!'],
            ['title' => 'Dog', 'value' => 'dog', 'text' => 'Dog!'],
            ['title' => 'Bird', 'value' => 'bird', 'text' => 'Bird!']
        );

        $this->assertIsArray($options);

        foreach ($options as $key => $option) {
            $this->assertEquals(true, $this->select->ranking->inRanking($option));
            $this->assertEquals('option', $option->type);
            if ($key === 0) {
                $this->assertEquals('Cat!', $option->text);
                $this->assertEquals('Cat', $option->html_attributes['title']);
                $this->assertEquals('cat', $option->html_attributes['value']);
            } else if ($key === 1) {
                $this->assertEquals('Dog!', $option->text);
                $this->assertEquals('Dog', $option->html_attributes['title']);
                $this->assertEquals('dog', $option->html_attributes['value']);
            } else {
                $this->assertEquals('Bird!', $option->text);
                $this->assertEquals('Bird', $option->html_attributes['title']);
                $this->assertEquals('bird', $option->html_attributes['value']);
            }
        }
    }

    /** @test */
    public function get_option_input_from_a_parent_model()
    {
        $this->select->addOptions(
            ['title' => 'Cat', 'value' => 'cat', 'text' => 'Cat!'],
            ['title' => 'Dog', 'value' => 'dog', 'text' => 'Dog!'],
            ['title' => 'Bird', 'value' => 'bird', 'text' => 'Bird!']
        );

        $option = $this->select->option('dog');

        $this->assertEquals(true, $this->select->ranking->inRanking($option));
        $this->assertEquals('option', $option->type);
        $this->assertEquals('Dog!', $option->text);
        $this->assertEquals('Dog', $option->html_attributes['title']);
        $this->assertEquals('dog', $option->html_attributes['value']);
    }

    /** @test */
    public function get_option_input_from_a_parent_model_when_option_doesnt_exist()
    {
        $this->select->addOptions(
            ['title' => 'Cat', 'value' => 'cat', 'text' => 'Cat!'],
            ['title' => 'Dog', 'value' => 'dog', 'text' => 'Dog!'],
            ['title' => 'Bird', 'value' => 'bird', 'text' => 'Bird!']
        );

        $option = $this->select->option('test');

        $this->assertNull($option);
    }

    /** @test */
    public function get_all_options_input_from_a_parent_model()
    {
        $this->select->addOptions(
            ['title' => 'Cat', 'value' => 'cat', 'text' => 'Cat!'],
            ['title' => 'Dog', 'value' => 'dog', 'text' => 'Dog!'],
            ['title' => 'Bird', 'value' => 'bird', 'text' => 'Bird!']
        );

        foreach ($this->select->options() as $key => $option) {
            $this->assertEquals(true, $this->select->ranking->inRanking($option));
            $this->assertEquals('option', $option->type);
            if ($key === 0) {
                $this->assertEquals('Cat!', $option->text);
                $this->assertEquals('Cat', $option->html_attributes['title']);
                $this->assertEquals('cat', $option->html_attributes['value']);
            } else if ($key === 1) {
                $this->assertEquals('Dog!', $option->text);
                $this->assertEquals('Dog', $option->html_attributes['title']);
                $this->assertEquals('dog', $option->html_attributes['value']);
            } else {
                $this->assertEquals('Bird!', $option->text);
                $this->assertEquals('Bird', $option->html_attributes['title']);
                $this->assertEquals('bird', $option->html_attributes['value']);
            }
        }
    }

    /** @test */
    public function get_all_options_input_from_a_parent_model_when_no_options()
    {
        $this->assertEquals(true, $this->select->options()->isEmpty());
    }
}