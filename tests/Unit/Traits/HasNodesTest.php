<?php

namespace Belvedere\FormMaker\Tests\Unit\Traits;

use Belvedere\FormMaker\Models\Form\Form;
use Belvedere\FormMaker\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasNodesTest extends TestCase
{
    use RefreshDatabase;

    protected $form;

    public function setUp(): void
    {
        parent::setUp();

        $this->form = Form::forceCreate([
            'name' => 'test',
            'description' => 'Form for testing'
        ]);
    }

    /** @test */
    public function add_node_to_a_parent_model_when_node_is_input()
    {
        $input = $this->form->add('text')->saveAndFirst();

        $this->assertEquals(true, $this->form->ranking->inRanking($input));
        $this->assertEquals('text', $input->type);
        $this->assertArrayHasKey('id', $input->html_attributes);
        $this->assertArrayHasKey('name', $input->html_attributes);
    }

    /** @test */
    public function add_node_to_a_parent_model_when_node_is_sibling()
    {
        $sibling = $this->form->add('paragraph')->withText('Paragraph test')->saveAndFirst();

        $this->assertEquals(true, $this->form->ranking->inRanking($sibling));
        $this->assertEquals('paragraph', $sibling->type);
        $this->assertEquals('Paragraph test', $sibling->text);
    }

    /** @test */
    public function add_node_to_a_parent_model_after_an_existing_node()
    {
        $afterInput = $this->form->add('text')->saveAndFirst();
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $afterInputRank = $this->form->ranking->rank($afterInput);
        $input = $this->form->addAfter($afterInput->html_attributes['id'], 'text');
        $inputRank = $this->form->ranking->rank($input);

        $this->assertEquals($afterInputRank + 1, $inputRank);
        $this->assertEquals('text', $input->type);
        $this->assertArrayHasKey('id', $input->html_attributes);
        $this->assertArrayHasKey('name', $input->html_attributes);
    }

    /** @test */
    public function add_node_to_a_parent_model_before_an_existing_node()
    {
        $beforeInput = $this->form->add('text')->saveAndFirst();
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $beforeInputRank = $this->form->ranking->rank($beforeInput);
        $input = $this->form->addBefore($beforeInput->html_attributes['id'], 'text');
        $inputRank = $this->form->ranking->rank($input);

        $this->assertEquals($beforeInputRank, $inputRank);
        $this->assertEquals('text', $input->type);
        $this->assertArrayHasKey('id', $input->html_attributes);
        $this->assertArrayHasKey('name', $input->html_attributes);
    }

    /** @test */
    public function add_node_to_a_parent_model_at_specific_rank()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $input = $this->form->addAtRank(2, 'text');
        $inputRank = $this->form->ranking->rank($input);

        $this->assertEquals(2, $inputRank);
        $this->assertEquals('text', $input->type);
        $this->assertArrayHasKey('id', $input->html_attributes);
        $this->assertArrayHasKey('name', $input->html_attributes);
    }

    /** @test */
    public function get_node_by_html_attribute_id()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->withHtmlAttributes(['id' => 'test'])->save();
        $this->form->add('paragraph')->save();
        $node = $this->form->node('test');

        $this->assertEquals('text', $node->type);
        $this->assertArrayHasKey('id', $node->html_attributes);
        $this->assertEquals('test', $node->html_attributes['id']);
        $this->assertArrayHasKey('name', $node->html_attributes);
    }

    /** @test */
    public function get_node_by_html_attribute_name()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->withHtmlAttributes(['name' => 'test'])->save();
        $this->form->add('paragraph')->save();
        $node = $this->form->node('test');

        $this->assertEquals('text', $node->type);
        $this->assertArrayHasKey('id', $node->html_attributes);
        $this->assertArrayHasKey('name', $node->html_attributes);
        $this->assertEquals('test', $node->html_attributes['name']);
    }

    /** @test */
    public function get_node_by_html_attribute_value()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->withHtmlAttributes(['value' => 'test'])->save();
        $this->form->add('paragraph')->save();
        $node = $this->form->node('test');

        $this->assertEquals('text', $node->type);
        $this->assertArrayHasKey('id', $node->html_attributes);
        $this->assertArrayHasKey('name', $node->html_attributes);
        $this->assertArrayHasKey('value', $node->html_attributes);
        $this->assertEquals('test', $node->html_attributes['value']);
    }

    /** @test */
    public function get_node_when_doesnt_exist()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->add('paragraph')->save();
        $node = $this->form->node('test');

        $this->assertNull($node);
    }

    /** @test */
    public function get_all_nodes_from_parent_model()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->add('paragraph')->save();
        $nodes = $this->form->nodes();

        $this->assertEquals(3, $nodes->count());

        foreach ($nodes as $key => $node) {
            if ($key === 2) {
                $this->assertEquals('paragraph', $node->type);
            } else {
                $this->assertEquals('text', $node->type);
                $this->assertArrayHasKey('id', $node->html_attributes);
                $this->assertArrayHasKey('name', $node->html_attributes);
            }
        }
    }

    /** @test */
    public function get_all_nodes_from_parent_model_filtered_by_type()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->add('paragraph')->save();
        $nodes = $this->form->nodes('text');

        $this->assertEquals(2, $nodes->count());

        foreach ($nodes as $key => $node) {
            $this->assertEquals('text', $node->type);
            $this->assertArrayHasKey('id', $node->html_attributes);
            $this->assertArrayHasKey('name', $node->html_attributes);
        }
    }

    /** @test */
    public function get_all_nodes_from_parent_model_when_parent_doesnt_have_node()
    {
        $nodes = $this->form->nodes();

        $this->assertEquals(true, $nodes->isEmpty());
    }
}