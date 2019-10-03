<?php

namespace Belvedere\FormMaker\Tests\Unit\Models;

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
    public function add_accepted_rule()
    {
        $this->ruler->accepted = 'accepted';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('accepted', $attributes);
        $this->assertEquals('accepted', $attributes['accepted']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_active_url_rule()
    {
        $this->ruler->active_url = 'active_url';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('active_url', $attributes);
        $this->assertEquals('active_url', $attributes['active_url']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_after_rule()
    {
        $this->ruler->after = 'tomorrow';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('after', $attributes);
        $this->assertEquals('after:tomorrow', $attributes['after']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_after_or_equal_rule()
    {
        $this->ruler->after_or_equal = 'tomorrow';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('after_or_equal', $attributes);
        $this->assertEquals('after_or_equal:tomorrow', $attributes['after_or_equal']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_alpha_rule()
    {
        $this->ruler->alpha = 'alpha';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('alpha', $attributes);
        $this->assertEquals('alpha', $attributes['alpha']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_alpha_dash_rule()
    {
        $this->ruler->alpha_dash = 'alpha_dash';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('alpha_dash', $attributes);
        $this->assertEquals('alpha_dash', $attributes['alpha_dash']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_alpha_num_rule()
    {
        $this->ruler->alpha_num = 'alpha_num';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('alpha_num', $attributes);
        $this->assertEquals('alpha_num', $attributes['alpha_num']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_array_rule()
    {
        $this->ruler->array = 'array';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('array', $attributes);
        $this->assertEquals('array', $attributes['array']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_bail_rule()
    {
        $this->ruler->bail = 'bail';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('bail', $attributes);
        $this->assertEquals('bail', $attributes['bail']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_before_rule()
    {
        $this->ruler->before = 'today';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('before', $attributes);
        $this->assertEquals('before:today', $attributes['before']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_before_or_equal_rule()
    {
        $this->ruler->before_or_equal = 'today';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('before_or_equal', $attributes);
        $this->assertEquals('before_or_equal:today', $attributes['before_or_equal']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_between_rule()
    {
        $this->ruler->between = [1, 10];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('between', $attributes);
        $this->assertEquals('between:1,10', $attributes['between']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_boolean_rule()
    {
        $this->ruler->boolean = 'boolean';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('boolean', $attributes);
        $this->assertEquals('boolean', $attributes['boolean']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_confirmed_rule()
    {
        $this->ruler->confirmed = 'confirmed';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('confirmed', $attributes);
        $this->assertEquals('confirmed', $attributes['confirmed']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_date_rule()
    {
        $this->ruler->date = 'date';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('date', $attributes);
        $this->assertEquals('date', $attributes['date']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_date_equals_rule()
    {
        $this->ruler->date_equals = 'today';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('date_equals', $attributes);
        $this->assertEquals('date_equals:today', $attributes['date_equals']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_date_format_rule()
    {
        $this->ruler->date_format = 'Y/M/d';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('date_format', $attributes);
        $this->assertEquals('date_format:Y/M/d', $attributes['date_format']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_different_rule()
    {
        $this->ruler->different = 'field';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('different', $attributes);
        $this->assertEquals('different:field', $attributes['different']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_digits_rule()
    {
        $this->ruler->digits = 10;

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('digits', $attributes);
        $this->assertEquals('digits:10', $attributes['digits']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_digits_between_rule()
    {
        $this->ruler->digits_between = [0, 10];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('digits_between', $attributes);
        $this->assertEquals('digits_between:0,10', $attributes['digits_between']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_dimensions_rule()
    {
        $this->ruler->dimensions = ['min_width=100', 'min_height=200'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('dimensions', $attributes);
        $this->assertEquals('dimensions:min_width=100,min_height=200', $attributes['dimensions']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_distinct_rule()
    {
        $this->ruler->distinct = 'distinct';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('distinct', $attributes);
        $this->assertEquals('distinct', $attributes['distinct']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_email_rule()
    {
        $this->ruler->email = 'email';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('email', $attributes);
        $this->assertEquals('email', $attributes['email']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_ends_with_rule()
    {
        $this->ruler->ends_with = ['foo', 'bar'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('ends_with', $attributes);
        $this->assertEquals('ends_with:foo,bar', $attributes['ends_with']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_exists_rule()
    {
        $this->ruler->exists = ['table', 'column'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('exists', $attributes);
        $this->assertEquals('exists:table,column', $attributes['exists']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_file_rule()
    {
        $this->ruler->file = 'file';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('file', $attributes);
        $this->assertEquals('file', $attributes['file']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_filled_rule()
    {
        $this->ruler->filled = 'filled';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('filled', $attributes);
        $this->assertEquals('filled', $attributes['filled']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_greater_than_rule()
    {
        $this->ruler->greater_than = 100;

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('greater_than', $attributes);
        $this->assertEquals('gt:100', $attributes['greater_than']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_greater_than_or_equal_rule()
    {
        $this->ruler->greater_than_or_equal = 100;

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('greater_than_or_equal', $attributes);
        $this->assertEquals('gte:100', $attributes['greater_than_or_equal']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_image_rule()
    {
        $this->ruler->image = 'image';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('image', $attributes);
        $this->assertEquals('image', $attributes['image']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_in_rule()
    {
        $this->ruler->in = ['dog', 'cat', 'bird'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('in', $attributes);
        $this->assertEquals('in:dog,cat,bird', $attributes['in']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_in_array_rule()
    {
        $this->ruler->in_array = 'anotherfield.*';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('in_array', $attributes);
        $this->assertEquals('in_array:anotherfield.*', $attributes['in_array']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_integer_rule()
    {
        $this->ruler->integer = 'integer';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('integer', $attributes);
        $this->assertEquals('integer', $attributes['integer']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_ip_rule()
    {
        $this->ruler->ip = 'ip';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('ip', $attributes);
        $this->assertEquals('ip', $attributes['ip']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_ipv4_rule()
    {
        $this->ruler->ipv4 = 'ipv4';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('ipv4', $attributes);
        $this->assertEquals('ipv4', $attributes['ipv4']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_ipv6_rule()
    {
        $this->ruler->ipv6 = 'ipv6';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('ipv6', $attributes);
        $this->assertEquals('ipv6', $attributes['ipv6']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_json_rule()
    {
        $this->ruler->json = 'json';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('json', $attributes);
        $this->assertEquals('json', $attributes['json']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_less_than_rule()
    {
        $this->ruler->less_than = 'field';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('less_than', $attributes);
        $this->assertEquals('lt:field', $attributes['less_than']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_less_than_or_equal_rule()
    {
        $this->ruler->less_than_or_equal = 'field';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('less_than_or_equal', $attributes);
        $this->assertEquals('lte:field', $attributes['less_than_or_equal']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_max_rule()
    {
        $this->ruler->max = 2019;

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('max', $attributes);
        $this->assertEquals('max:2019', $attributes['max']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_mimetypes_rule()
    {
        $this->ruler->mimetypes = ['video/avi','video/mpeg','video/quicktime'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('mimetypes', $attributes);
        $this->assertEquals('mimetypes:video/avi,video/mpeg,video/quicktime', $attributes['mimetypes']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_mimes_rule()
    {
        $this->ruler->mimes = ['jpeg','bmp','png'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('mimes', $attributes);
        $this->assertEquals('mimes:jpeg,bmp,png', $attributes['mimes']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_min_rule()
    {
        $this->ruler->min = 1;

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('min', $attributes);
        $this->assertEquals('min:1', $attributes['min']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_not_in_rule()
    {
        $this->ruler->not_in = ['sprinkles', 'cherries'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('not_in', $attributes);
        $this->assertEquals('not_in:sprinkles,cherries', $attributes['not_in']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_not_regex_rule()
    {
        $this->ruler->not_regex = '/^.+$/i';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('not_regex', $attributes);
        $this->assertEquals('not_regex:/^.+$/i', $attributes['not_regex']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_nullable_rule()
    {
        $this->ruler->nullable = 'nullable';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('nullable', $attributes);
        $this->assertEquals('nullable', $attributes['nullable']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_numeric_rule()
    {
        $this->ruler->numeric = 'numeric';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('numeric', $attributes);
        $this->assertEquals('numeric', $attributes['numeric']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_present_rule()
    {
        $this->ruler->present = 'present';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('present', $attributes);
        $this->assertEquals('present', $attributes['present']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_regex_rule()
    {
        $this->ruler->regex = '/^.+@.+$/i';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('regex', $attributes);
        $this->assertEquals('regex:/^.+@.+$/i', $attributes['regex']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_required_rule()
    {
        $this->ruler->required = 'required';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('required', $attributes);
        $this->assertEquals('required', $attributes['required']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_required_if_rule()
    {
        $this->ruler->required_if = ['anotherfield', 'value'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('required_if', $attributes);
        $this->assertEquals('required_if:anotherfield,value', $attributes['required_if']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_required_unless_rule()
    {
        $this->ruler->required_unless = ['anotherfield', 'value'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('required_unless', $attributes);
        $this->assertEquals('required_unless:anotherfield,value', $attributes['required_unless']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_required_with_rule()
    {
        $this->ruler->required_with = ['foo', 'bar'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('required_with', $attributes);
        $this->assertEquals('required_with:foo,bar', $attributes['required_with']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_required_with_all_rule()
    {
        $this->ruler->required_with_all = ['foo', 'bar'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('required_with_all', $attributes);
        $this->assertEquals('required_with_all:foo,bar', $attributes['required_with_all']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_required_without_rule()
    {
        $this->ruler->required_without = ['foo', 'bar'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('required_without', $attributes);
        $this->assertEquals('required_without:foo,bar', $attributes['required_without']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_required_without_all_rule()
    {
        $this->ruler->required_without_all = ['foo', 'bar'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('required_without_all', $attributes);
        $this->assertEquals('required_without_all:foo,bar', $attributes['required_without_all']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_same_rule()
    {
        $this->ruler->same = 'field';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('same', $attributes);
        $this->assertEquals('same:field', $attributes['same']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_size_rule()
    {
        $this->ruler->size = 10;

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('size', $attributes);
        $this->assertEquals('size:10', $attributes['size']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_sometimes_rule()
    {
        $this->ruler->sometimes = 'sometimes';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('sometimes', $attributes);
        $this->assertEquals('sometimes', $attributes['sometimes']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_starts_with_rule()
    {
        $this->ruler->starts_with = ['foo', 'bar'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('starts_with', $attributes);
        $this->assertEquals('starts_with:foo,bar', $attributes['starts_with']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_string_rule()
    {
        $this->ruler->string = 'string';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('string', $attributes);
        $this->assertEquals('string', $attributes['string']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_timezone_rule()
    {
        $this->ruler->timezone = 'timezone';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('timezone', $attributes);
        $this->assertEquals('timezone', $attributes['timezone']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_unique_rule()
    {
        $this->ruler->unique = ['table','column','except','idColumn'];

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('unique', $attributes);
        $this->assertEquals('unique:table,column,except,idColumn', $attributes['unique']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_url_rule()
    {
        $this->ruler->url = 'url';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('url', $attributes);
        $this->assertEquals('url', $attributes['url']);
        $this->ruler->clearRules();
    }

    /** @test */
    public function add_uuid_rule()
    {
        $this->ruler->uuid = 'uuid';

        $attributes = $this->ruler->getRules();

        $this->assertArrayHasKey('uuid', $attributes);
        $this->assertEquals('uuid', $attributes['uuid']);
        $this->ruler->clearRules();
    }
}