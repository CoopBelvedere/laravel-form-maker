<?php

namespace Belvedere\FormMaker\Models\HtmlAttributes;

use Belvedere\FormMaker\Contracts\Models\HtmlAttributes\HtmlAttributerContract;
use Illuminate\Support\Str;

class HtmlAttributer implements HtmlAttributerContract
{
    /**
     * A list of all the different html attributes available.
     *
     * @var array
     */
    const HTML_ATTRIBUTES_LIST = [
        'accept' => ['%s', ','],
        'accept-charset' => ['%s', ' '],
        'alt' => '%s',
        'autocomplete' => '%s',
        'autofocus' => 'autofocus',
        'capture' => '%s',
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
     * A list of all set attributes.
     *
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
            $this->addHtmlAttributeInList($htmlAttribute, $value);
        }
    }

    /**
     * Add the html attribute to the list.
     *
     * @param string $htmlAttribute
     * @param $value
     */
    protected function addHtmlAttributeInList(string $htmlAttribute, $value): void
    {
        if ($htmlAttribute === 'data') {
            list($dataKey, $dataValue) = $value;
            $this->htmlAttributes[] = [$dataKey => $dataValue];
        } else if (is_array($value)) {
            $this->htmlAttributes[] = [$htmlAttribute => sprintf(
                self::HTML_ATTRIBUTES_LIST[$htmlAttribute][0],
                implode(self::HTML_ATTRIBUTES_LIST[$htmlAttribute][1], $value)
            )];
        } else if (is_bool($value)) {
            $this->htmlAttributes[] = [$htmlAttribute => var_export($value, true)];
        } else {
            $this->htmlAttributes[] = [$htmlAttribute => sprintf(
                self::HTML_ATTRIBUTES_LIST[$htmlAttribute], $value
            )];
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
     * Get all the current html attributes.
     *
     * @return array
     */
    public function getHtmlAttributes(): array
    {
        return array_merge([], ...$this->htmlAttributes);
    }
}
