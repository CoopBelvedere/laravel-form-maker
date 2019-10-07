<?php

namespace Belvedere\FormMaker\Tests\Unit\Models;

use Belvedere\FormMaker\Listeners\AssignAttributes;
use Belvedere\FormMaker\Listeners\CascadeDelete;
use Belvedere\FormMaker\Listeners\RemoveFromRanking;
use Belvedere\FormMaker\Models\Form\Form;
use Belvedere\FormMaker\Models\Nodes\Inputs\Input;
use Belvedere\FormMaker\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Facades\Event;

class InputTest extends TestCase
{
    use RefreshDatabase;

    protected $form;

    public function setUp(): void
    {
        parent::setUp();

        $this->form = Form::forceCreate([
            'name' => 'test',
        ]);
    }

    /** @test */
    public function add_input_to_form()
    {
        Event::fake();

        $this->form->add('text')->save();

        Event::assertDispatched(AssignAttributes::class);
    }

    /** @test */
    public function remove_input_from_form()
    {
        Event::fake();

        $input = $this->form->add('text')->saveAndFirst();

        $input->delete();

        Event::assertDispatched(CascadeDelete::class);
        Event::assertDispatched(RemoveFromRanking::class);
    }

    /** @test */
    public function get_assigned_attributes()
    {
        $input = new Input();

        $assignedAttributes = $input->getHtmlAttributesAssigned();

        $this->assertIsArray($assignedAttributes);
        $this->assertEquals('id', $assignedAttributes[0]);
        $this->assertEquals('name', $assignedAttributes[1]);
    }

    /** @test */
    public function api_response_with_no_text_no_html_attributes_no_label_and_no_options()
    {
        $input = $this->form->add('text')->saveAndFirst();

        $apiResponse = $input->toApi()->toArray(null);

        $this->assertIsArray($apiResponse);
        $this->assertArrayHasKey('id', $apiResponse);
        $this->assertEquals(1, $apiResponse['id']);
        $this->assertArrayHasKey('type', $apiResponse);
        $this->assertEquals('text', $apiResponse['type']);
        $this->assertArrayHasKey('created_at', $apiResponse);
        $this->assertArrayHasKey('updated_at', $apiResponse);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[0]);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[1]);
        $this->assertIsArray($apiResponse[1]->data);
        $this->assertIsArray($apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('id', $apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('name', $apiResponse[1]->data['html_attributes']);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[2]);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[3]);
    }

    /** @test */
    public function api_response_with_text_no_html_attributes_no_label_and_no_options()
    {
        $input = $this->form->add('option')->withText('Test')->saveAndFirst();

        $apiResponse = $input->toApi()->toArray(null);

        $this->assertIsArray($apiResponse);
        $this->assertArrayHasKey('id', $apiResponse);
        $this->assertEquals(1, $apiResponse['id']);
        $this->assertArrayHasKey('type', $apiResponse);
        $this->assertEquals('option', $apiResponse['type']);
        $this->assertArrayHasKey('created_at', $apiResponse);
        $this->assertArrayHasKey('updated_at', $apiResponse);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[0]);
        $this->assertIsArray($apiResponse[0]->data);
        $this->assertEquals('Test', $apiResponse[0]->data['text']);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[1]);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[2]);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[3]);
    }

    /** @test */
    public function api_response_with_no_text_html_attributes_label_and_no_options()
    {
        $this->form->add('text')
            ->withHtmlAttributes(['name' => 'test', 'required' => 'required', 'maxlength' => 10])
            ->saveAndFirst()
            ->addLabel('Label');

        $apiResponse = $this->form->node('test')->toApi()->toArray(null);

        $this->assertIsArray($apiResponse);
        $this->assertArrayHasKey('id', $apiResponse);
        $this->assertEquals(1, $apiResponse['id']);
        $this->assertArrayHasKey('type', $apiResponse);
        $this->assertEquals('text', $apiResponse['type']);
        $this->assertArrayHasKey('created_at', $apiResponse);
        $this->assertArrayHasKey('updated_at', $apiResponse);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[0]);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[1]);
        $this->assertIsArray($apiResponse[1]->data);
        $this->assertIsArray($apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('id', $apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('name', $apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('required', $apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('maxlength', $apiResponse[1]->data['html_attributes']);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[2]);
        $this->assertArrayHasKey('label', $apiResponse[2]->data);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[3]);
    }

    /** @test */
    public function api_response_with_no_text_html_attributes_label_and_options()
    {
        $this->form->add('select')
            ->withHtmlAttributes(['name' => 'test', 'required' => 'required'])
            ->saveAndFirst()
            ->addLabel('Label');

        $input = $this->form->node('test');

        $input->addOptions(
            ['title' => 'Cat', 'value' => 'cat', 'text' => 'Cat!'],
            ['title' => 'Dog', 'value' => 'dog', 'text' => 'Dog!'],
            ['title' => 'Bird', 'value' => 'bird', 'text' => 'Bird!']
        );

        $apiResponse = $input->toApi()->toArray(null);

        $this->assertIsArray($apiResponse);
        $this->assertArrayHasKey('id', $apiResponse);
        $this->assertEquals(1, $apiResponse['id']);
        $this->assertArrayHasKey('type', $apiResponse);
        $this->assertEquals('select', $apiResponse['type']);
        $this->assertArrayHasKey('created_at', $apiResponse);
        $this->assertArrayHasKey('updated_at', $apiResponse);
        $this->assertInstanceOf(MissingValue::class, $apiResponse[0]);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[1]);
        $this->assertIsArray($apiResponse[1]->data);
        $this->assertIsArray($apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('id', $apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('name', $apiResponse[1]->data['html_attributes']);
        $this->assertArrayHasKey('required', $apiResponse[1]->data['html_attributes']);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[2]);
        $this->assertArrayHasKey('label', $apiResponse[2]->data);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[3]);
        $this->assertArrayHasKey('options', $apiResponse[3]->data);
    }

    /** @test */
    public function api_response_with_datalist()
    {
        $datalist = $this->form->add('datalist')
            ->withHtmlAttributes(['required' => 'required'])
            ->saveAndFirst();

        $datalist->addLabel('Choose a flavor:');

        $datalist->addOptions(
            ['value' => 'Chocolate'],
            ['value' => 'Coconut'],
            ['value' => 'Mint'],
            ['value' => 'Strawberry'],
            ['value' => 'Vanilla']
        );

        $apiResponse = $datalist->toApi()->toArray(null);
        
        $this->assertIsArray($apiResponse);
        $this->assertArrayHasKey('id', $apiResponse);
        $this->assertEquals(1, $apiResponse['id']);
        $this->assertArrayHasKey('type', $apiResponse);
        $this->assertEquals('datalist', $apiResponse['type']);
        $this->assertArrayHasKey('created_at', $apiResponse);
        $this->assertArrayHasKey('updated_at', $apiResponse);
        $this->assertIsArray($apiResponse[0]->data['html_attributes']);
        $this->assertArrayHasKey('id', $apiResponse[0]->data['html_attributes']);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[1]);
        $this->assertArrayHasKey('label', $apiResponse[1]->data);
        $this->assertArrayHasKey('input', $apiResponse);
        $this->assertArrayHasKey('type', $apiResponse['input']);
        $this->assertEquals('list', $apiResponse['input']['type']);
        $this->assertArrayHasKey('html_attributes', $apiResponse['input']);
        $this->assertArrayHasKey('id', $apiResponse['input']['html_attributes']);
        $this->assertArrayHasKey('name', $apiResponse['input']['html_attributes']);
        $this->assertArrayHasKey('required', $apiResponse['input']['html_attributes']);
        $this->assertArrayHasKey('list', $apiResponse['input']['html_attributes']);
        $this->assertInstanceOf(MergeValue::class, $apiResponse[2]);
        $this->assertArrayHasKey('options', $apiResponse[2]->data);
    }
}