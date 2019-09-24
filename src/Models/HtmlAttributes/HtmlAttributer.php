<?php

namespace Belvedere\FormMaker\Models\HtmlAttributes;

use Belvedere\FormMaker\Contracts\Models\HtmlAttributes\HtmlAttributerContract;
use Illuminate\Support\Str;

class HtmlAttributer implements HtmlAttributerContract
{
    /**
     * @var array
     */
    const HTML_ATTRIBUTES_LIST = [
        'accept' => ['%s', ','],
        'accept-charset' => ['%s', ' '],
        'alt' => '%s',
        'autocomplete' => '%s',
        'autofocus' => 'autofocus',
        'capture' => 'capture',
        'checked' => 'checked',
        'class' => '%s',
        'cols' => '%d',
        'data' => '%s',
        'disabled' => 'disabled',
        'enctype' => '%s',
        'for' => '%s',
        'form' => '%s',
        'height' => '%d',
        'id' => '%s',
        'max' => '%s',
        'maxlength' => '%d',
        'min' => '%s',
        'minlength' => '%d',
        'multiple' => 'multiple',
        'name' => '%s',
        'novalidate' => 'novalidate',
        'pattern' => '%s',
        'placeholder' => '%s',
        'readonly' => 'readonly',
        'required' => 'required',
        'role' => '%s',
        'rows' => '%d',
        'selected' => 'selected',
        'size' => '%d',
        'spellcheck' => 'true',
        'src' => '%s',
        'step' => '%s',
        'target' => '%s',
        'title' => '%s',
        'value' => '%s',
        'width' => '%d',
    ];

    /**
     * @var array
     */
    protected $htmlAttributes = [];

    /**
     * Set the model html attributes.
     *
     * @param string $name
     * @param $value
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $htmlAttribute = Str::kebab($name);

        if (is_null($value)) {
            $this->htmlAttributes[] = [$htmlAttribute => null];
        } else if (array_key_exists($htmlAttribute, self::HTML_ATTRIBUTES_LIST)) {
            switch ($value) {
                case $htmlAttribute === 'data':
                    list($dataKey, $dataValue) = $value;
                    $this->htmlAttributes[] = [$dataKey => $dataValue];
                    break;
                case is_array($value):
                    $this->htmlAttributes[] = [$htmlAttribute => sprintf(
                        self::HTML_ATTRIBUTES_LIST[$htmlAttribute][0],
                        implode( self::HTML_ATTRIBUTES_LIST[$htmlAttribute][1], $value)
                    )];
                    break;
                case is_bool($value):
                    $this->htmlAttributes[] = [$htmlAttribute => var_export($value, true)];
                    break;
                default:
                    $this->htmlAttributes[] = [$htmlAttribute => sprintf(
                        self::HTML_ATTRIBUTES_LIST[$htmlAttribute], $value
                    )];
            }
        }
    }

    /**
     * Remove all the current html attributes.
     *
     * @return void
     */
    public function clearHtmlAttributes(): void
    {
        $this->htmlAttributes = [];
    }

    /**
     * Get all the current htlm attributes.
     *
     * @return array
     */
    public function getHtmlAttributes(): array
    {
        return array_merge([], ...$this->htmlAttributes);
    }
}
