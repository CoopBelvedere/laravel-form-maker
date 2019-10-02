<?php

namespace Belvedere\FormMaker\Tests\Unit;

use Belvedere\FormMaker\Models\Form\Form;
use Belvedere\FormMaker\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
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
    public function disable_all_inputs()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->disabled();

        foreach ($this->form->nodes('inputs') as $input) {
            $this->assertEquals('disabled', $input->html_attributes['disabled']);
            $this->assertIsString($input->html_attributes['disabled']);
        }
    }

    /** @test */
    public function enable_all_inputs()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->enabled();

        foreach ($this->form->nodes('inputs') as $input) {
            $this->assertArrayNotHasKey('disabled', $input->html_attributes);
        }
    }

    /** @test */
    public function enable_all_inputs_after_they_have_been_disabled()
    {
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->add('text')->save();
        $this->form->disabled();

        foreach ($this->form->nodes('inputs') as $input) {
            $this->assertEquals('disabled', $input->html_attributes['disabled']);
            $this->assertIsString($input->html_attributes['disabled']);
        }

        $this->form->enabled();

        foreach ($this->form->nodes('inputs') as $input) {
            $this->assertArrayNotHasKey('disabled', $input->html_attributes);
        }
    }

    /** @test */
    public function get_rules_in_a_form_request_format()
    {
        $this->form->add('text')->withHtmlAttributes(['name' => 'test_1'])->withRules(['required' => 'required', 'max' => 10])->save();
        $this->form->add('text')->withHtmlAttributes(['name' => 'test_2'])->withRules(['required' => 'required', 'max' => 20])->save();
        $this->form->add('text')->withHtmlAttributes(['name' => 'test_3'])->withRules(['required' => 'required', 'max' => 30])->save();

        $rules = $this->form->rules();

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('test_1', $rules);
        $this->assertEquals('required|max:10', $rules['test_1']);
        $this->assertArrayHasKey('test_2', $rules);
        $this->assertEquals('required|max:20', $rules['test_2']);
        $this->assertArrayHasKey('test_3', $rules);
        $this->assertEquals('required|max:30', $rules['test_3']);
    }

    /** @test */
    public function set_action_attribute()
    {
        $form = $this->form->action('/post_route');

        $this->assertEquals('/post_route', $form->html_attributes['action']);
        $this->assertIsString($form->html_attributes['action']);
    }

    /** @test */
    public function set_method_attribute()
    {
        $form = $this->form->method('post');

        $this->assertEquals('post', $form->html_attributes['method']);
        $this->assertIsString($form->html_attributes['method']);
    }
}