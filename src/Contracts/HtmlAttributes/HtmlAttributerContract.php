<?php

namespace Belvedere\FormMaker\Contracts\HtmlAttributes;

interface HtmlAttributerContract
{
    /**
     * Specifies if the browser should autocomplete the form.
     * default: on
     *
     * @param string $autocomplete
     * @return array
     */
    public function autocomplete(?string $autocomplete = 'on'): array;

    /**
     * Specifies that the input field should automatically get focus when the page loads.
     *
     * @param string $autofocus
     * @return array
     */
    public function autofocus(?string $autofocus = 'autofocus'): array;

    /**
     * Specifies the charset used in the submitted form.
     * default: the page charset
     *
     * @param string $charset
     * @return array
     */
    public function charset(?string $charset): array;

    /**
     * Pre-checks the control before the user interacts with it.
     *
     * @param string $checked
     * @return array
     */
    public function checked(?string $checked = 'checked'): array;

    /**
     * Specifies a data attribute for the html element.
     *
     * @param string $data
     * @param mixed $value
     * @return array
     */
    public function data(string $data, $value = null): array;

    /**
     * Specifies that the input field is disabled.
     *
     * @param string $disabled
     * @return array
     */
    public function disabled(?string $disabled = 'disabled'): array;

    /**
     * Specifies the encoding of the submitted data.
     * default: is url-encoded
     *
     * @param string $enctype
     * @return array
     */
    public function enctype(?string $enctype): array;

    /**
     * Specifies an id attribute for the html element.
     *
     * @param mixed $id
     * @return array
     */
    public function id($id = null): array;

    /**
     * Specifies a class attribute for the html element.
     *
     * @param string $class
     * @return array
     */
    public function isClass(?string $class): array;

    /**
     * Specifies the maximum value for an input field.
     *
     * @param mixed $max
     * @return array
     */
    public function max($max = null): array;

    /**
     * Specifies the maximum allowed length for the input field.
     *
     * @param int $maxlength
     * @return array
     */
    public function maxlength(?int $maxlength): array;

    /**
     * Specifies the minimum value for an input field.
     *
     * @param mixed $min
     * @return array
     */
    public function min($min = null): array;

    /**
     * Specifies the minimum allowed length for the input field.
     *
     * @param int $minlength
     * @return array
     */
    public function minlength(?int $minlength): array;

    /**
     * Specifies that the user is allowed to enter more than one value in the input field.
     *
     * @param string $multiple
     * @return array
     */
    public function multiple(?string $multiple = 'multiple'): array;

    /**
     * Specifies a name used to identify the form or the input.
     *
     * @param string $name
     * @return array
     */
    public function name(?string $name): array;

    /**
     * Specifies that the browser should not validate the form.
     *
     * @param string $novalidate
     * @return array
     */
    public function novalidate(?string $novalidate = 'novalidate'): array;

    /**
     * Specifies a regular expression that the input field value is checked against.
     *
     * @param string $pattern
     * @return array
     */
    public function pattern(?string $pattern): array;

    /**
     * Specifies a hint that describes the expected value of an input field.
     * (a sample value or a short description of the format)
     *
     * @param string $placeholder
     * @return array
     */
    public function placeholder(?string $placeholder): array;

    /**
     * Specifies that the input field is read only (cannot be changed).
     *
     * @param string $readonly
     * @return array
     */
    public function readonly(?string $readonly = 'readonly'): array;

    /**
     * Specifies that an input field must be filled out before submitting the form.
     *
     * @param string $required
     * @return array
     */
    public function required(?string $required = 'required'): array;

    /**
     * Specifies a role attribute for the html element.
     *
     * @param string $role
     * @return array
     */
    public function role(?string $role): array;

    /**
     * Specifies the size (in characters) for the input field.
     * The default value is 20.
     *
     * @param int $size
     * @return array
     */
    public function size(?int $size = 20): array;

    /**
     * Specifies whether the input field is to have its spelling and grammar
     * checked or not.
     *
     * @param bool $spellcheck
     * @return array
     */
    public function spellcheck(?bool $spellcheck = true): array;

    /**
     * Specifies the legal number intervals for an input field.
     * The control accepts only values at multiples of the step value
     * greater than the minimum
     *
     * @param $step
     * @return array
     */
    public function step($step = null): array;

    /**
     * Specifies the target of the address in the action attribute.
     * This will make the form result open in a new browser tab.
     *
     * @param string $blank
     * @return array
     */
    public function target(?string $blank = '_blank'): array;

    /**
     * Add a description to help the user.
     *
     * @param string $title
     * @return array
     */
    public function title(?string $title): array;

    /**
     * Specifies the value property for an input field.
     *
     * @param string $value
     * @return array
     */
    public function value(?string $value): array;
}