<?php

namespace Belvedere\FormMaker\Models\Rules;

use Belvedere\FormMaker\Contracts\Rules\RulerContract;

class Ruler implements RulerContract
{
    /**
     * The field under validation must be yes, on, 1, or true.
     * This is useful for validating "Terms of Service" acceptance.
     *
     * @param string $accepted
     * @return array
     */
    public function accepted(?string $accepted = 'accepted'): array 
    {
        return ['accepted' => $accepted];
    }

    /**
     * The field under validation must have a valid A or AAAA record according
     * to the dns_get_record PHP function.
     *
     * @param string $activeUrl
     * @return array
     */
    public function activeUrl(?string $activeUrl = 'active_url'): array 
    {
        return ['active_url' => $activeUrl];
    }

    /**
     * The field under validation must be a value after a given date.
     * The dates will be passed into the strtotime PHP function.
     *
     * @param string $date
     * @return array
     */
    public function after(?string $date): array 
    {
        if (is_null($date)) {
            return ['after' => null];
        } 
        
        return ['after' => sprintf('after:%s', $date)];
    }

    /**
     * The field under validation must be a value after or equal to the given date.
     * For more information, see the after rule.
     *
     * @param string $date
     * @return array
     */
    public function afterOrEqual(?string $date): array 
    {
        if (is_null($date)) {
            return ['after_or_equal' => null];
        }

        return ['after_or_equal' => sprintf('after_or_equal:%s', $date)];
    }

    /**
     * The field under validation must be entirely alphabetic characters.
     *
     * @param string $alpha
     * @return array
     */
    public function alpha(?string $alpha = 'alpha'): array 
    {
        return ['alpha' => $alpha];
    }

    /**
     * The field under validation may have alpha-numeric characters,
     * as well as dashes and underscores.
     *
     * @param string $alphaDash
     * @return array
     */
    public function alphaDash(?string $alphaDash = 'alpha_dash'): array 
    {
        return ['alpha_dash' => $alphaDash];
    }

    /**
     * The field under validation must be entirely alpha-numeric characters.
     *
     * @param string $alphaNum
     * @return array
     */
    public function alphaNum(?string $alphaNum = 'alpha_num'): array 
    {
        return ['alpha_num' => $alphaNum];
    }

    /**
     * The field under validation must be a PHP array.
     *
     * @param string $array
     * @return array
     */
    public function isArray(?string $array = 'array'): array 
    {
        return ['array' => $array];
    }

    /**
     * Stop running validation rules after the first validation failure.
     *
     * @param string $bail
     * @return array
     */
    public function bail(?string $bail = 'bail'): array 
    {
        return ['bail' => $bail];
    }

    /**
     * The field under validation must be a value preceding the given date.
     * The dates will be passed into the PHP strtotime function.
     * In addition, like the after rule, the name of another field under
     * validation may be supplied as the value of date.
     *
     * @param string $date
     * @return array
     */
    public function before(?string $date): array 
    {
        if (is_null($date)) {
            return ['before' => null];
        }
            
        return ['before' => sprintf('before:%s', $date)];
    }

    /**
     * The field under validation must be a value preceding or equal to the given date.
     * The dates will be passed into the PHP strtotime function.
     * In addition, like the after rule, the name of another field under
     * validation may be supplied as the value of date.
     *
     * @param string $date
     * @return array
     */
    public function beforeOrEqual(?string $date): array 
    {
        if (is_null($date)) {
            return ['before_or_equal' => null];
        } 
        
        return ['before_or_equal' => sprintf('before_or_equal:%s', $date)];
    }

    /**
     * The field under validation must have a size between the given min and max.
     * Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
     *
     * @param int|null ...$interval
     * @return array
     */
    public function between(?int ...$interval): array 
    {
        $interval = $this->removeNullValues($interval);

        if (count($interval) === 0) {
            return ['between' => null];
        }

        return ['between' => sprintf('between:%s', implode(',', $interval))];
    }

    /**
     * The field under validation must be able to be cast as a boolean.
     *
     * @param string $boolean
     * @return array
     */
    public function boolean(?string $boolean = 'boolean'): array
    {
        return ['boolean' => $boolean];
    }

    /**
     * The field under validation must have a matching field of foo_confirmation.
     * For example, if the field under validation is password,
     * a matching password_confirmation field must be present in the input.
     *
     * @param string $confirmed
     * @return array
     */
    public function confirmed(?string $confirmed = 'confirmed'): array
    {
        return ['confirmed' => $confirmed];
    }

    /**
     * The field under validation must be a valid date according to the strtotime PHP function.
     *
     * @param string $date
     * @return array
     */
    public function date(?string $date = 'date'): array
    {
        return ['date' => $date];
    }

    /**
     * The field under validation must be equal to the given date.
     * The dates will be passed into the PHP strtotime function.
     *
     * @param string $date
     * @return array
     */
    public function dateEquals(?string $date): array
    {
        if (is_null($date)) {
            return ['date_equals' => null];
        }

        return ['date_equals' => sprintf('date_equals:%s', $date)];
    }

    /**
     * The field under validation must match the given format.
     * You should use either date or date_format when validating a field, not both.
     *
     * @param string $format
     * @return array
     */
    public function dateFormat(?string $format): array
    {
        if (is_null($format)) {
            return ['date_format' => null];
        }

        return ['date_format' => sprintf('date_format:%s', $format)];
    }

    /**
     * The field under validation must have a different value than field.
     *
     * @param string $field
     * @return array
     */
    public function different(?string $field): array
    {
        if (is_null($field)) {
           return ['different' => null];
        }

        return ['different' => sprintf('different:%s', $field)];
    }

    /**
     * The field under validation must be numeric and must have an exact length of value.
     *
     * @param int $value
     * @return array
     */
    public function digits(?int $value): array
    {
        if (is_null($value)) {
            return ['digits' => null];
        }

        return ['digits' => sprintf('digits:%d', $value)];
    }

    /**
     * The field under validation must have a length between the given min and max.
     *
     * @param int|null ...$interval
     * @return array
     */
    public function digitsBetween(?int ...$interval): array
    {
        $interval = $this->removeNullValues($interval);

        if (count($interval) === 0) {
            return ['digits_between' => null];
        }

        return ['digits_between' => sprintf('digits_between:%s', implode(',', $interval))];
    }

    /**
     * The file under validation must be an image meeting the dimension
     * constraints as specified by the rule's parameters.
     *
     * @param null|string ...$dimensions
     * @return array
     */
    public function dimensions(?string ...$dimensions): array
    {
        $dimensions = $this->removeNullValues($dimensions);

        if (count($dimensions) === 0) {
            return ['dimensions' => null];
        }

        return ['dimensions' => sprintf(
            'dimensions:%s', implode(',', $dimensions)
        )];
    }

    /**
     * When working with arrays, the field under validation must not have any duplicate values.
     *
     * @param string $distinct
     * @return array
     */
    public function distinct(?string $distinct = 'distinct'): array
    {
        return ['distinct' => $distinct];
    }

    /**
     * The field under validation must be formatted as an e-mail address.
     *
     * @param string $email
     * @return array
     */
    public function email(?string $email = 'email'): array
    {
        return ['email' => $email];
    }

    /**
     * The field under validation must exist on a given database table.
     *
     * @param null|string ...$values
     * @return array
     */
    public function exists(?string ...$values): array
    {
        $values = $this->removeNullValues($values);

        if (count($values) === 0) {
            return ['exists' => null];
        }

        return ['exists' => sprintf('exists:%s', implode(',', $values))];
    }

    /**
     * The field under validation must be a successfully uploaded file.
     *
     * @param string $file
     * @return array
     */
    public function file(?string $file = 'file'): array
    {
        return ['file' => $file];
    }

    /**
     * The field under validation must not be empty when it is present.
     *
     * @param string $filled
     * @return array
     */
    public function filled(?string $filled = 'filled'): array
    {
        return ['filled' => $filled];
    }

    /**
     * The field under validation must be greater than the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function greaterThan(?string $field): array
    {
        if (is_null($field)) {
            return ['gt' => null];
        }

        return ['gt' => sprintf('gt:%s', $field)];
    }

    /**
     * The field under validation must be greater than or equal to the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function greaterThanOrEqual(?string $field): array
    {
        if (is_null($field)) {
            return ['gte' => null];
        }

        return ['gte' => sprintf('gte:%s', $field)];
    }

    /**
     * The file under validation must be an image (jpeg, png, bmp, gif, or svg).
     *
     * @param string $image
     * @return array
     */
    public function image(?string $image = 'image'): array
    {
        return ['image' => $image];
    }

    /**
     * The field under validation must be included in the given list of values.
     *
     * @param null|string ...$list
     * @return array
     */
    public function in(?string ...$list): array
    {
        $list = $this->removeNullValues($list);

        if (count($list) === 0) {
            return ['in' => null];
        }

        return ['in' => sprintf('in:%s', implode(',', $list))];
    }

    /**
     * The field under validation must exist in anotherfield's values.
     *
     * @param string $anotherfield
     * @return array
     */
    public function inArray(?string $anotherfield): array
    {
        if (is_null($anotherfield)) {
            return ['in_array' => null];
        }

        return ['in_array' => sprintf('in_array:%s', $anotherfield)];
    }

    /**
     * The field under validation must be an integer.
     *
     * @param string $integer
     * @return array
     */
    public function integer(?string $integer = 'integer'): array
    {
        return ['integer' => $integer];
    }

    /**
     * The field under validation must be an integer.
     *
     * @param string $ip
     * @return array
     */
    public function ip(?string $ip = 'ip'): array
    {
        return ['ip' => $ip];
    }

    /**
     * The field under validation must be an IPv4 address.
     *
     * @param string $ipv4
     * @return array
     */
    public function ipv4(?string $ipv4 = 'ipv4'): array
    {
        return ['ipv4' => $ipv4];
    }

    /**
     * The field under validation must be an IPv6 address.
     *
     * @param string $ipv6
     * @return array
     */
    public function ipv6(?string $ipv6 = 'ipv6'): array
    {
        return ['ipv6' => $ipv6];
    }

    /**
     * The field under validation must be a valid JSON string.
     *
     * @param string $json
     * @return array
     */
    public function json(?string $json = 'json'): array
    {
        return ['json' => $json];
    }

    /**
     * The field under validation must be less than the given field.
     * The two fields must be of the same type. Strings, numerics, arrays, and
     * files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function lessThan(?string $field): array
    {
        if (is_null($field)) {
            return ['lt' => null];
        }

        return ['lt' => sprintf('lt:%s', $field)];
    }

    /**
     * The field under validation must be less than or equal to the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function lessThanOrEqual(?string $field): array
    {
        if (is_null($field)) {
            return ['lte' => null];
        }

        return ['lte' => sprintf('lte:%s', $field)];
    }

    /**
     * The field under validation must be less than or equal to a maximum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion
     * as the size rule.
     *
     * @param int $max
     * @return array
     */
    public function max(?int $max): array
    {
        if (is_null($max)) {
            return ['max' => null];
        }

        return ['max' => sprintf('max:%d', $max)];
    }

    /**
     * The file under validation must match one of the given MIME types
     *
     * @param null|string ...$types
     * @return array
     */
    public function mimetypes(?string ...$types): array
    {
        $types = $this->removeNullValues($types);

        if (count($types) === 0) {
            return ['mimetypes' => null];
        }

        return ['mimetypes' => sprintf(
            'mimetypes:%s', implode(',', $types)
        )];
    }

    /**
     * The file under validation must match one of the given MIME types
     *
     * @param null|string ...$mimes
     * @return array
     */
    public function mimes(?string ...$mimes): array
    {
        $mimes = $this->removeNullValues($mimes);

        if (count($mimes) === 0) {
            return ['mimes' => null];
        }

        return ['mimes' => sprintf(
            'mimes:%s', implode(',', $mimes)
        )];
    }

    /**
     * The field under validation must have a minimum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion
     * as the size rule.
     *
     * @param int $min
     * @return array
     */
    public function min(?int $min): array
    {
        if (is_null($min)) {
            return ['min' => null];
        }

        return ['min' => sprintf('min:%d', $min)];
    }

    /**
     * The field under validation must not be included in the given list of values.
     *
     * @param null|string ...$list
     * @return array
     */
    public function notIn(?string ...$list): array
    {
        $list = $this->removeNullValues($list);

        if (count($list) === 0) {
            return ['not_in' => null];
        }

        return ['not_in' => sprintf(
            'not_in:%s', implode(',', $list)
        )];
    }

    /**
     * The field under validation may be null.
     * This is particularly useful when validating primitive such as strings and
     * integers that can contain null values.
     *
     * @param string $nullable
     * @return array
     */
    public function nullable(?string $nullable = 'nullable'): array
    {
        return ['nullable' => $nullable];
    }

    /**
     * The field under validation must be numeric.
     *
     * @param string $numeric
     * @return array
     */
    public function numeric(?string $numeric = 'numeric'): array
    {
        return ['numeric' => $numeric];
    }

    /**
     * The field under validation must be present in the input data but can be empty.
     *
     * @param string $present
     * @return array
     */
    public function present(?string $present = 'present'): array
    {
        return ['present' => $present];
    }

    /**
     * Remove the null values in array.
     *
     * @param  array $items
     * @return array
     */
    protected function removeNullValues(array $items): array
    {
        return array_filter($items, function ($item) {
            return !is_null($item);
        });
    }

    /**
     * The field under validation must be present in the input data and not empty.
     *
     * @param string $required
     * @return array
     */
    public function required(?string $required = 'required'): array
    {
        return ['required' => $required];
    }

    /**
     * The field under validation must be present and not empty if
     * the anotherfield field is equal to any value.
     *
     * @param null|string ...$field
     * @return array
     */
    public function requiredIf(?string ...$field): array
    {
        $field = $this->removeNullValues($field);

        if (count($field) === 0) {
            return ['required_if' => null];
        }

        return ['required_if' => sprintf(
            'required_if:%s,%s', implode(',', $field)
        )];
    }

    /**
     * The field under validation must be present and not empty unless
     * the anotherfield field is equal to any value.
     *
     * @param null|string ...$field
     * @return array
     */
    public function requiredUnless(?string ...$field): array
    {
        $field = $this->removeNullValues($field);

        if (count($field) === 0) {
            return ['required_unless' => null];
        }

        return ['required_unless' => sprintf(
            'required_unless:%s', implode(',', $field)
        )];
    }

    /**
     * The field under validation must be present and not empty only if any
     * of the other specified fields are present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWith(?string ...$fields): array
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            return ['required_with' => null];
        }

        return ['required_with' => sprintf(
            'required_with:%s', implode(',', $fields)
        )];
    }

    /**
     * The field under validation must be present and not empty only if all
     * of the other specified fields are present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWithAll(?string ...$fields): array
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            return ['required_with_all' => null];
        }

        return ['required_with_all' => sprintf(
            'required_with_all:%s', implode(',', $fields)
        )];
    }

    /**
     * The field under validation must be present and not empty only when any
     * of the other specified fields are not present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWithout(?string ...$fields): array
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            return ['required_without' => null];
        }

        return ['required_without' => sprintf(
            'required_without:%s', implode(',', $fields)
        )];
    }

    /**
     * The field under validation must be present and not empty only when all
     * of the other specified fields are not present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWithoutAll(?string ...$fields): array
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            return ['required_without_all' => null];
        }

        return ['required_without_all' => sprintf(
            'required_without_all:%s', implode(',', $fields)
        )];
    }

    /**
     * The given field must match the field under validation.
     *
     * @param string $field
     * @return array
     */
    public function same(?string $field): array
    {
        if (is_null($field)) {
            return ['same' => null];
        }

        return ['same' => sprintf('same:%s', $field)];
    }

    /**
     * The field under validation must have a size matching the given value.
     * For string data, value corresponds to the number of characters.
     * For numeric data, value corresponds to a given integer value.
     * For an array, size corresponds to the count of the array.
     * For files, size corresponds to the file size in kilobytes.
     *
     * @param int $value
     * @return array
     */
    public function size(?int $value): array
    {
        if (is_null($value)) {
            return ['size' => null];
        }

        return ['size' => sprintf('size:%d', $value)];
    }

    /**
     * The field under validation must be a string. If you would like to allow
     * the field to also be null, you should assign the nullable rule to the field.
     *
     * @param string $string
     * @return array
     */
    public function string(?string $string = 'string'): array
    {
        return ['string' => $string];
    }

    /**
     * The field under validation must be a valid timezone identifier according
     * to the timezone_identifiers_list PHP function.
     *
     * @param string $timezone
     * @return array
     */
    public function timezone(?string $timezone = 'timezone'): array
    {
        return ['timezone' => $timezone];
    }

    /**
     * The field under validation must be unique in a given database table.
     *
     * @param string|null ...$values
     * @return array
     */
    public function unique(?string ...$values): array
    {
        $values = $this->removeNullValues($values);

        if (count($values) === 0) {
            return ['unique' => null];
        }

        return ['unique' => sprintf('unique:%s', implode(',', $values))];
    }

    /**
     * The field under validation must be a valid URL.
     *
     * @param string $url
     * @return array
     */
    public function url(?string $url = 'url'): array
    {
        return ['url' => $url];
    }
}
