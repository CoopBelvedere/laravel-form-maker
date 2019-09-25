<?php

namespace Belvedere\FormMaker\Models\Rules;

use Belvedere\FormMaker\Contracts\Models\Rules\RulerContract;
use Illuminate\Support\Str;

class Ruler implements RulerContract
{
    /**
     * @var array
     */
    const RULES_LIST = [
        'accepted' => 'accepted',
        'active_url' => 'active_url',
        'after' => 'after:%s',
        'after_or_equal' => 'after_or_equal:%s',
        'alpha' => 'alpha',
        'alpha_dash' => 'alpha_dash',
        'alpha_num' => 'alpha_num',
        'array' => 'array',
        'bail' => 'bail',
        'before' => 'before:%s',
        'before_or_equal' => 'before_or_equal:%s',
        'between' => 'between:%s',
        'boolean' => 'boolean',
        'confirmed' => 'confirmed',
        'date' => 'date',
        'date_equals' => 'date_equals:%s',
        'date_format' => 'date_format:%s',
        'different' => 'different:%s',
        'digits' => 'digits:%d',
        'digits_between' => 'digits_between:%s',
        'dimensions' => 'dimensions:%s',
        'distinct' => 'distinct',
        'email' => 'email',
        'ends_with' => 'ends_with:%s',
        'exists' => 'exists:%s',
        'file' => 'file',
        'filled' => 'filled',
        'greater_than' => 'gt:%s',
        'greater_than_or_equal' => 'gte:%s',
        'image' => 'image',
        'in' => 'in:%s',
        'in_array' => 'in_array:%s',
        'integer' => 'integer',
        'ip' => 'ip',
        'ipv4' => 'ipv4',
        'ipv6' => 'ipv6',
        'json' => 'json',
        'less_than' => 'lt:%s',
        'less_than_or_equal' => 'lte:%s',
        'max' => 'max:%d',
        'mimetypes' => 'mimetypes:%s',
        'mimes' => 'mimes:%s',
        'min' => 'min:%d',
        'not_in' => 'not_in:%s',
        'not_regex' => 'not_regex:%s',
        'nullable' => 'nullable',
        'numeric' => 'numeric',
        'present' => 'present',
        'regex' => 'regex:%s',
        'required' => 'required',
        'required_if' => 'required_if:%s',
        'required_unless' => 'required_unless:%s',
        'required_with' => 'required_with:%s',
        'required_with_all' => 'required_with_all:%s',
        'required_without' => 'required_without:%s',
        'required_without_all' => 'required_without_all:%s',
        'same' => 'same:%s',
        'size' => 'size:%d',
        'sometimes' => 'sometimes',
        'starts_with' => 'starts_with:%s',
        'string' => 'string',
        'timezone' => 'timezone',
        'unique' => 'unique:%s',
        'url' => 'url',
        'uuid' => 'uuid'
    ];

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @param string $name
     * @param $value
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $rule = Str::snake($name);

        if (array_key_exists($rule, self::RULES_LIST)) {
            switch ($value) {
                case null:
                    $this->rules[] = [$rule => null];
                    break;
                case is_array($value):
                    $this->rules[] = [$rule => sprintf(self::RULES_LIST[$rule], implode(',', $value))];
                    break;
                default:
                    $this->rules[] = [$rule => sprintf(self::RULES_LIST[$rule], $value)];
            }
        }
    }

    /**
     * Remove all the current rules.
     *
     * @return void
     */
    public function clearRules(): void
    {
        $this->rules = [];
    }

    /**
     * Get all the current rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return array_merge([], ...$this->rules);
    }
}
