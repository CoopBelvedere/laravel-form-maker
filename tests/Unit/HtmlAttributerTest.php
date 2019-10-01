<?php

namespace Belvedere\FormMaker\Tests\Unit;

use Belvedere\FormMaker\Contracts\Models\HtmlAttributes\HtmlAttributerContract;
use Belvedere\FormMaker\Tests\TestCase;

class HtmlAttributerTest extends TestCase
{
    protected $attributer;

    public function setUp(): void
    {
        parent::setUp();

        $this->attributer = resolve(HtmlAttributerContract::class);
    }

    /** @test */
    public function autofocus_should_not_be_editable()
    {
        $this->attributer->autofocus = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('autofocus', $attributes);
        $this->assertEquals('autofocus', $attributes['autofocus']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function checked_should_not_be_editable()
    {
        $this->attributer->checked = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('checked', $attributes);
        $this->assertEquals('checked', $attributes['checked']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function disabled_should_not_be_editable()
    {
        $this->attributer->disabled = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('disabled', $attributes);
        $this->assertEquals('disabled', $attributes['disabled']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function multiple_should_not_be_editable()
    {
        $this->attributer->multiple = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('multiple', $attributes);
        $this->assertEquals('multiple', $attributes['multiple']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function novalidate_should_not_be_editable()
    {
        $this->attributer->novalidate = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('novalidate', $attributes);
        $this->assertEquals('novalidate', $attributes['novalidate']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function readonly_should_not_be_editable()
    {
        $this->attributer->readonly = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('readonly', $attributes);
        $this->assertEquals('readonly', $attributes['readonly']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function required_should_not_be_editable()
    {
        $this->attributer->required = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('required', $attributes);
        $this->assertEquals('required', $attributes['required']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function selected_should_not_be_editable()
    {
        $this->attributer->selected = 'dummy text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('selected', $attributes);
        $this->assertEquals('selected', $attributes['selected']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_accept_attribute()
    {
        $this->attributer->accept = ['image/png', 'image/jpeg'];

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('accept', $attributes);
        $this->assertEquals('image/png,image/jpeg', $attributes['accept']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_accept_charset_attribute()
    {
        $attribute = 'accept-charset';

        $this->attributer->$attribute = ['utf8', 'latin'];

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('accept-charset', $attributes);
        $this->assertEquals('utf8 latin', $attributes['accept-charset']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_alt_attribute()
    {
        $this->attributer->alt = 'alt text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('alt', $attributes);
        $this->assertEquals('alt text', $attributes['alt']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_autocomplete_attribute()
    {
        $this->attributer->autocomplete = 'name';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('autocomplete', $attributes);
        $this->assertEquals('name', $attributes['autocomplete']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_autofocus_attribute()
    {
        $this->attributer->autofocus = 'autofocus';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('autofocus', $attributes);
        $this->assertEquals('autofocus', $attributes['autofocus']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_capture_attribute()
    {
        $this->attributer->capture = 'environment';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('capture', $attributes);
        $this->assertEquals('environment', $attributes['capture']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_checked_attribute()
    {
        $this->attributer->checked = 'checked';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('checked', $attributes);
        $this->assertEquals('checked', $attributes['checked']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_class_attribute()
    {
        $this->attributer->class = 'col-12';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('class', $attributes);
        $this->assertEquals('col-12', $attributes['class']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_cols_attribute()
    {
        $this->attributer->cols = 12;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('cols', $attributes);
        $this->assertEquals(12, $attributes['cols']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_data_attribute()
    {
        $this->attributer->data = ['data-test', 'test'];

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('data-test', $attributes);
        $this->assertEquals('test', $attributes['data-test']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_disabled_attribute()
    {
        $this->attributer->disabled = 'disabled';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('disabled', $attributes);
        $this->assertEquals('disabled', $attributes['disabled']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_enctype_attribute()
    {
        $this->attributer->enctype = 'multipart/form-data';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('enctype', $attributes);
        $this->assertEquals('multipart/form-data', $attributes['enctype']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_for_attribute()
    {
        $this->attributer->for = 'id';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('for', $attributes);
        $this->assertEquals('id', $attributes['for']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_form_attribute()
    {
        $this->attributer->form = 'id';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('form', $attributes);
        $this->assertEquals('id', $attributes['form']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_height_attribute()
    {
        $this->attributer->height = 100;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('height', $attributes);
        $this->assertEquals(100, $attributes['height']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_id_attribute()
    {
        $this->attributer->id = 'id';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('id', $attributes);
        $this->assertEquals('id', $attributes['id']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_max_attribute()
    {
        $this->attributer->max = 100;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('max', $attributes);
        $this->assertEquals(100, $attributes['max']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_maxlength_attribute()
    {
        $this->attributer->maxlength = 100;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('maxlength', $attributes);
        $this->assertEquals(100, $attributes['maxlength']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_min_attribute()
    {
        $this->attributer->min = 5;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('min', $attributes);
        $this->assertEquals(5, $attributes['min']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_minlength_attribute()
    {
        $this->attributer->minlength = 5;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('minlength', $attributes);
        $this->assertEquals(5, $attributes['minlength']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_multiple_attribute()
    {
        $this->attributer->multiple = 'multiple';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('multiple', $attributes);
        $this->assertEquals('multiple', $attributes['multiple']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_name_attribute()
    {
        $this->attributer->name = 'new_text_name';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('name', $attributes);
        $this->assertEquals('new_text_name', $attributes['name']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_novalidate_attribute()
    {
        $this->attributer->novalidate = 'novalidate';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('novalidate', $attributes);
        $this->assertEquals('novalidate', $attributes['novalidate']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_pattern_attribute()
    {
        $this->attributer->pattern = '[A-Za-z]+';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('pattern', $attributes);
        $this->assertEquals('[A-Za-z]+', $attributes['pattern']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_placeholder_attribute()
    {
        $this->attributer->placeholder = 'Placeholder text';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('placeholder', $attributes);
        $this->assertEquals('Placeholder text', $attributes['placeholder']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_readonly_attribute()
    {
        $this->attributer->readonly = 'readonly';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('readonly', $attributes);
        $this->assertEquals('readonly', $attributes['readonly']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_required_attribute()
    {
        $this->attributer->required = 'required';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('required', $attributes);
        $this->assertEquals('required', $attributes['required']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_role_attribute()
    {
        $this->attributer->role = 'test';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('role', $attributes);
        $this->assertEquals('test', $attributes['role']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_rows_attribute()
    {
        $this->attributer->rows = 25;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('rows', $attributes);
        $this->assertEquals(25, $attributes['rows']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_selected_attribute()
    {
        $this->attributer->selected = 'selected';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('selected', $attributes);
        $this->assertEquals('selected', $attributes['selected']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_size_attribute()
    {
        $this->attributer->size = 100;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('size', $attributes);
        $this->assertEquals(100, $attributes['size']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_spellcheck_attribute()
    {
        $this->attributer->spellcheck = false;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('spellcheck', $attributes);
        $this->assertEquals('false', $attributes['spellcheck']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_src_attribute()
    {
        $this->attributer->src = '/media/examples/grapefruit-slice-332-332.jpg';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('src', $attributes);
        $this->assertEquals('/media/examples/grapefruit-slice-332-332.jpg', $attributes['src']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_step_attribute()
    {
        $this->attributer->step = 10;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('step', $attributes);
        $this->assertEquals(10, $attributes['step']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_target_attribute()
    {
        $this->attributer->target = '_blank';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('target', $attributes);
        $this->assertEquals('_blank', $attributes['target']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_title_attribute()
    {
        $this->attributer->title = 'text title';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('title', $attributes);
        $this->assertEquals('text title', $attributes['title']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_value_attribute()
    {
        $this->attributer->value = 'test';

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('value', $attributes);
        $this->assertEquals('test', $attributes['value']);
        $this->attributer->clearHtmlAttributes();
    }

    /** @test */
    public function can_add_width_attribute()
    {
        $this->attributer->width = 500;

        $attributes = $this->attributer->getHtmlAttributes();

        $this->assertArrayHasKey('width', $attributes);
        $this->assertEquals(500, $attributes['width']);
        $this->attributer->clearHtmlAttributes();
    }
}