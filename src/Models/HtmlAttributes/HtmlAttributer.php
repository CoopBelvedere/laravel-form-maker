<?php

namespace Belvedere\FormMaker\Models\HtmlAttributes;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HtmlAttributerContract;

class HtmlAttributer implements HtmlAttributerContract
{
    /**
     * Indicates the types of files that the server accepts.
     *
     * @param string|null ...$accepted
     * @return array
     */
    public function accept(?string ...$accepted): array
    {
        return ['accept' => sprintf('%s', implode(',', $accepted))];
    }

    /**
     * Specifies the alt of the input field image element.
     *
     * @param string $alt
     * @return array
     */
    public function alt(?string $alt): array
    {
        return ['alt' => $alt];
    }

    /**
     * Specifies if the browser should autocomplete the form.
     * default: on
     *
     * @param string $autocomplete
     * @return array
     */
    public function autocomplete(?string $autocomplete): array
    {
        return ['autocomplete' => $autocomplete];
    }

    /**
     * Specifies that the input field should automatically get focus when the page loads.
     *
     * @param string $autofocus
     * @return array
     */
    public function autofocus(?string $autofocus): array
    {
        return ['autofocus' => $autofocus];
    }

    /**
     * Indicates that capture of media directly from the device's sensors
     * using a media capture mechanism is preferred, such as a webcam or microphone.
     *
     * @param string $capture
     * @return array
     */
    public function capture(?string $capture): array
    {
        return ['capture' => $capture];
    }

    /**
     * Specifies the charset used in the submitted form.
     * default: the page charset
     *
     * @param string|null ...$charsets
     * @return array
     */
    public function charset(?string ...$charsets): array
    {
        return ['accept-charset' => sprintf('%s', implode(' ', $charsets))];
    }

    /**
     * Pre-checks the control before the user interacts with it.
     *
     * @param string $checked
     * @return array
     */
    public function checked(?string $checked): array
    {
        return ['checked' => $checked];
    }

    /**
     * Specifies the visible width of a textarea.
     *
     * @param int $cols
     * @return array
     */
    public function cols(?int $cols): array
    {
        return ['cols' => $cols];
    }

    /**
     * Specifies a data attribute for the html element.
     *
     * @param string $data
     * @param mixed $value
     * @return array
     */
    public function data(string $data, $value): array
    {
        return [$data => $value];
    }

    /**
     * Specifies that the input field is disabled.
     *
     * @param string $disabled
     * @return array
     */
    public function disabled(?string $disabled): array
    {
        return ['disabled' => $disabled];
    }

    /**
     * Specifies the encoding of the submitted data.
     * default: is url-encoded
     *
     * @param string $enctype
     * @return array
     */
    public function enctype(?string $enctype): array
    {
        return ['enctype' => $enctype];
    }

    /**
     * Specifies the form element with which the label is associated (its form owner).
     *
     * @param mixed $form
     * @return array
     */
    public function form($form): array
    {
        return ['form' => $form];
    }

    /**
     * Specifies the height of the input field image element.
     *
     * @param int $height
     * @return array
     */
    public function height(?int $height): array
    {
        return ['height' => $height];
    }

    /**
     * Specifies an id attribute for the html element.
     *
     * @param mixed $id
     * @return array
     */
    public function id($id = null): array
    {
        return ['id' => $id];
    }

    /**
     * Specifies a class attribute for the html element.
     *
     * @param string $class
     * @return array
     */
    public function isClass(?string $class): array
    {
        return ['class' => $class];
    }

    /**
     * Specifies the id of a labelable form-related element.
     *
     * @param mixed $for
     * @return array
     */
    public function isFor($for): array
    {
        return ['for' => $for];
    }

    /**
     * Specifies the maximum value for an input field.
     *
     * @param mixed $max
     * @return array
     */
    public function max($max): array
    {
        return ['max' => $max];
    }

    /**
     * Specifies the maximum allowed length for the input field.
     *
     * @param int $maxlength
     * @return array
     */
    public function maxlength(?int $maxlength): array
    {
        return ['maxlength' => $maxlength];
    }

    /**
     * Specifies the minimum value for an input field.
     *
     * @param mixed $min
     * @return array
     */
    public function min($min): array
    {
        return ['min' => $min];
    }

    /**
     * Specifies the minimum allowed length for the input field.
     *
     * @param int $minlength
     * @return array
     */
    public function minlength(?int $minlength): array
    {
        return ['minlength' => $minlength];
    }

    /**
     * Specifies that the user is allowed to enter more than one value in the input field.
     *
     * @param string $multiple
     * @return array
     */
    public function multiple(?string $multiple): array
    {
        return ['multiple' => $multiple];
    }

    /**
     * Specifies a name used to identify the form or the input.
     *
     * @param string $name
     * @return array
     */
    public function name(?string $name): array
    {
        return ['name' => $name];
    }

    /**
     * Specifies that the browser should not validate the form.
     *
     * @param string $novalidate
     * @return array
     */
    public function novalidate(?string $novalidate): array
    {
        return ['novalidate' => $novalidate];
    }

    /**
     * Specifies a regular expression that the input field value is checked against.
     *
     * @param string $pattern
     * @return array
     */
    public function pattern(?string $pattern): array
    {
        return ['pattern' => $pattern];
    }

    /**
     * Specifies a hint that describes the expected value of an input field.
     * (a sample value or a short description of the format)
     *
     * @param string $placeholder
     * @return array
     */
    public function placeholder(?string $placeholder): array
    {
        return ['placeholder' => $placeholder];
    }

    /**
     * Specifies that the input field is read only (cannot be changed).
     *
     * @param string $readonly
     * @return array
     */
    public function readonly(?string $readonly): array
    {
        return ['readonly' => $readonly];
    }

    /**
     * Specifies that an input field must be filled out before submitting the form.
     *
     * @param string $required
     * @return array
     */
    public function required(?string $required): array
    {
        return ['required' => $required];
    }

    /**
     * Specifies a role attribute for the html element.
     *
     * @param string $role
     * @return array
     */
    public function role(?string $role): array
    {
        return ['role' => $role];
    }

    /**
     * Specifies the visible number of lines in a text area.
     *
     * @param int $rows
     * @return array
     */
    public function rows(?int $rows): array
    {
        return ['rows' => $rows];
    }

    /**
     * Specifies the selected attribute to the option.
     *
     * @param string $selected
     * @return array
     */
    public function selected(?string $selected): array
    {
        return ['selected' => $selected];
    }

    /**
     * Specifies the size (in characters) for the input field.
     * The default value is 20.
     *
     * @param int $size
     * @return array
     */
    public function size(?int $size): array
    {
        return ['size' => $size];
    }

    /**
     * Specifies whether the input field is to have its spelling and grammar
     * checked or not.
     *
     * @param bool $spellcheck
     * @return array
     */
    public function spellcheck(?bool $spellcheck): array
    {
        if ($spellcheck) {
            return ['spellcheck' => 'true'];
        }

        return ['spellcheck' => 'false'];
    }

    /**
     * Specifies the src of the input field image element.
     *
     * @param string $src
     * @return array
     */
    public function src(?string $src): array
    {
        return ['src' => $src];
    }

    /**
     * Specifies the legal number intervals for an input field.
     * The control accepts only values at multiples of the step value
     * greater than the minimum
     *
     * @param $step
     * @return array
     */
    public function step($step): array
    {
        return ['step' => $step];
    }

    /**
     * Specifies the target of the address in the action attribute.
     * This will make the form result open in a new browser tab.
     *
     * @param string $blank
     * @return array
     */
    public function target(?string $blank): array
    {
        return ['target' => $blank];
    }

    /**
     * Add a description to help the user.
     *
     * @param string $title
     * @return array
     */
    public function title(?string $title): array
    {
        return ['title' => $title];
    }

    /**
     * Specifies the value property for an input field.
     *
     * @param string $value
     * @return array
     */
    public function value(?string $value): array
    {
        return ['value' => $value];
    }

    /**
     * Specifies the width of the input field image element.
     *
     * @param int $width
     * @return array
     */
    public function width(?int $width): array
    {
        return ['width' => $width];
    }
}