<?php

namespace Belvedere\FormMaker\Traits;

trait InputRules
{
    /**
     * The field under validation must be yes, on, 1, or true.
     * This is useful for validating "Terms of Service" acceptance.
     *
     * @param string $accepted
     * @return self
     */
    public function ruleAccepted(?string $accepted = 'accepted'): self
    {
        $this->rules = ['accepted' => $accepted];

        return $this;
    }

    /**
     * The field under validation must have a valid A or AAAA record according
     * to the dns_get_record PHP function.
     *
     * @param string $activeUrl
     * @return self
     */
    public function ruleActiveUrl(?string $activeUrl = 'active_url'): self
    {
        $this->rules = ['active_url' => $activeUrl];

        return $this;
    }

    /**
     * The field under validation must be a value after a given date.
     * The dates will be passed into the strtotime PHP function.
     *
     * @param string $date
     * @return self
     */
    public function ruleAfter(?string $date): self
    {
        if (is_null($date)) {
            $this->rules = ['after' => null];
        } else {
            $this->rules = ['after' => sprintf('after:%s', $date)];
        }

        return $this;
    }

    /**
     * The field under validation must be a value after or equal to the given date.
     * For more information, see the after rule.
     *
     * @param string $date
     * @return self
     */
    public function ruleAfterOrEqual(?string $date): self
    {
        if (is_null($date)) {
            $this->rules = ['after_or_equal' => null];
        } else {
            $this->rules = ['after_or_equal' => sprintf('after_or_equal:%s', $date)];
        }

        return $this;
    }

    /**
     * The field under validation must be entirely alphabetic characters.
     *
     * @param string $alpha
     * @return self
     */
    public function ruleAlpha(?string $alpha = 'alpha'): self
    {
        $this->rules = ['alpha' => $alpha];

        return $this;
    }

    /**
     * The field under validation may have alpha-numeric characters,
     * as well as dashes and underscores.
     *
     * @param string $alphaDash
     * @return self
     */
    public function ruleAlphaDash(?string $alphaDash = 'alpha_dash'): self
    {
        $this->rules = ['alpha_dash' => $alphaDash];

        return $this;
    }

    /**
     * The field under validation must be entirely alpha-numeric characters.
     *
     * @param string $alphaNum
     * @return self
     */
    public function ruleAlphaNum(?string $alphaNum = 'alpha_num'): self
    {
        $this->rules = ['alpha_num' => $alphaNum];

        return $this;
    }

    /**
     * The field under validation must be a PHP array.
     *
     * @param string $array
     * @return self
     */
    public function ruleArray(?string $array = 'array'): self
    {
        $this->rules = ['array' => $array];

        return $this;
    }

    /**
     * Stop running validation rules after the first validation failure.
     *
     * @param string $bail
     * @return self
     */
    public function ruleBail(?string $bail = 'bail'): self
    {
        $this->rules = ['bail' => $bail];

        return $this;
    }

    /**
     * The field under validation must be a value preceding the given date.
     * The dates will be passed into the PHP strtotime function.
     * In addition, like the after rule, the name of another field under
     * validation may be supplied as the value of date.
     *
     * @param string $date
     * @return self
     */
    public function ruleBefore(?string $date): self
    {
        if (is_null($date)) {
            $this->rules = ['before' => null];
        } else {
            $this->rules = ['before' => sprintf('before:%s', $date)];
        }

        return $this;
    }

    /**
     * The field under validation must be a value preceding or equal to the given date.
     * The dates will be passed into the PHP strtotime function.
     * In addition, like the after rule, the name of another field under
     * validation may be supplied as the value of date.
     *
     * @param string $date
     * @return self
     */
    public function ruleBeforeOrEqual(?string $date): self
    {
        if (is_null($date)) {
            $this->rules = ['before_or_equal' => null];
        } else {
            $this->rules = ['before_or_equal' => sprintf('before_or_equal:%s', $date)];
        }

        return $this;
    }

    /**
     * The field under validation must have a size between the given min and max.
     * Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
     *
     * @param int|null ...$interval
     * @return self
     */
    public function ruleBetween(?int ...$interval): self
    {
        $interval = $this->removeNullValues($interval);

        if (count($interval) === 0) {
            $this->rules = ['between' => null];
        } else {
            $this->rules = ['between' => sprintf('between:%s', implode(',', $interval))];
        }

        return $this;
    }

    /**
     * The field under validation must be able to be cast as a boolean.
     *
     * @param string $boolean
     * @return self
     */
    public function ruleBoolean(?string $boolean = 'boolean'): self
    {
        $this->rules = ['boolean' => $boolean];

        return $this;
    }

    /**
     * The field under validation must have a matching field of foo_confirmation.
     * For example, if the field under validation is password,
     * a matching password_confirmation field must be present in the input.
     *
     * @param string $confirmed
     * @return self
     */
    public function ruleConfirmed(?string $confirmed = 'confirmed'): self
    {
        $this->rules = ['confirmed' => $confirmed];

        return $this;
    }

    /**
     * The field under validation must be a valid date according to the strtotime PHP function.
     *
     * @param string $date
     * @return self
     */
    public function ruleDate(?string $date = 'date'): self
    {
        $this->rules = ['date' => $date];

        return $this;
    }

    /**
     * The field under validation must be equal to the given date.
     * The dates will be passed into the PHP strtotime function.
     *
     * @param string $date
     * @return self
     */
    public function ruleDateEquals(?string $date): self
    {
        if (is_null($date)) {
            $this->rules = ['date_equals' => null];
        } else {
            $this->rules = ['date_equals' => sprintf('date_equals:%s', $date)];
        }

        return $this;
    }

    /**
     * The field under validation must match the given format.
     * You should use either date or date_format when validating a field, not both.
     *
     * @param string $format
     * @return self
     */
    public function ruleDateFormat(?string $format): self
    {
        if (is_null($format)) {
            $this->rules = ['date_format' => null];
        } else {
            $this->rules = ['date_format' => sprintf('date_format:%s', $format)];
        }

        return $this;
    }

    /**
     * The field under validation must have a different value than field.
     *
     * @param string $field
     * @return self
     */
    public function ruleDifferent(?string $field): self
    {
        if (is_null($field)) {
            $this->rules = ['different' => null];
        } else {
            $this->rules = ['different' => sprintf('different:%s', $field)];
        }

        return $this;
    }

    /**
     * The field under validation must be numeric and must have an exact length of value.
     *
     * @param int $value
     * @return self
     */
    public function ruleDigits(?int $value): self
    {
        if (is_null($value)) {
            $this->rules = ['digits' => null];
        } else {
            $this->rules = ['digits' => sprintf('digits:%d', $value)];
        }

        return $this;
    }

    /**
     * The field under validation must have a length between the given min and max.
     *
     * @param int|null ...$interval
     * @return self
     */
    public function ruleDigitsBetween(?int ...$interval): self
    {
        $interval = $this->removeNullValues($interval);

        if (count($interval) === 0) {
            $this->rules = ['digits_between' => null];
        } else {
            $this->rules = ['digits_between' => sprintf('digits_between:%s', implode(',', $interval))];
        }

        return $this;
    }

    /**
     * The file under validation must be an image meeting the dimension
     * constraints as specified by the rule's parameters.
     *
     * @param null|string ...$dimensions
     * @return self
     */
    public function ruleDimensions(?string ...$dimensions): self
    {
        $dimensions = $this->removeNullValues($dimensions);

        if (count($dimensions) === 0) {
            $this->rules = ['dimensions' => null];
        } else {
            $this->rules = ['dimensions' => sprintf(
                'dimensions:%s', implode(',', $dimensions)
            )];
        }

        return $this;
    }

    /**
     * When working with arrays, the field under validation must not have any duplicate values.
     *
     * @param string $distinct
     * @return self
     */
    public function ruleDistinct(?string $distinct = 'distinct'): self
    {
        $this->rules = ['distinct' => $distinct];

        return $this;
    }

    /**
     * The field under validation must be formatted as an e-mail address.
     *
     * @param string $email
     * @return self
     */
    public function ruleEmail(?string $email = 'email'): self
    {
        $this->rules = ['email' => $email];

        return $this;
    }

    /**
     * The field under validation must exist on a given database table.
     *
     * @param null|string ...$values
     * @return self
     */
    public function ruleExists(?string ...$values): self
    {
        $values = $this->removeNullValues($values);

        if (count($values) === 0) {
            $this->rules = ['exists' => null];
        } else {
            $this->rules = ['exists' => sprintf('exists:%s', implode(',', $values))];
        }

        return $this;
    }

    /**
     * The field under validation must be a successfully uploaded file.
     *
     * @param string $file
     * @return self
     */
    public function ruleFile(?string $file = 'file'): self
    {
        $this->rules = ['file' => $file];

        return $this;
    }

    /**
     * The field under validation must not be empty when it is present.
     *
     * @param string $filled
     * @return self
     */
    public function ruleFilled(?string $filled = 'filled'): self
    {
        $this->rules = ['filled' => $filled];

        return $this;
    }

    /**
     * The field under validation must be greater than the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return self
     */
    public function ruleGreaterThan(?string $field): self
    {
        if (is_null($field)) {
            $this->rules = ['gt' => null];
        } else {
            $this->rules = ['gt' => sprintf('gt:%s', $field)];
        }

        return $this;
    }

    /**
     * The field under validation must be greater than or equal to the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return self
     */
    public function ruleGreaterThanOrEqual(?string $field): self
    {
        if (is_null($field)) {
            $this->rules = ['gte' => null];
        } else {
            $this->rules = ['gte' => sprintf('gte:%s', $field)];
        }

        return $this;
    }

    /**
     * The file under validation must be an image (jpeg, png, bmp, gif, or svg).
     *
     * @param string $image
     * @return self
     */
    public function ruleImage(?string $image = 'image'): self
    {
        $this->rules = ['image' => $image];

        return $this;
    }

    /**
     * The field under validation must be included in the given list of values.
     *
     * @param null|string ...$list
     * @return self
     */
    public function ruleIn(?string ...$list): self
    {
        $list = $this->removeNullValues($list);

        if (count($list) === 0) {
            $this->rules = ['in' => null];
        } else {
            $this->rules = ['in' => sprintf('in:%s', implode(',', $list))];
        }

        return $this;
    }

    /**
     * The field under validation must exist in anotherfield's values.
     *
     * @param string $anotherfield
     * @return self
     */
    public function ruleInArray(?string $anotherfield): self
    {
        if (is_null($anotherfield)) {
            $this->rules = ['in_array' => null];
        } else {
            $this->rules = ['in_array' => sprintf('in_array:%s', $anotherfield)];
        }

        return $this;
    }

    /**
     * The field under validation must be an integer.
     *
     * @param string $integer
     * @return self
     */
    public function ruleInteger(?string $integer = 'integer'): self
    {
        $this->rules = ['integer' => $integer];

        return $this;
    }

    /**
     * The field under validation must be an integer.
     *
     * @param string $ip
     * @return self
     */
    public function ruleIp(?string $ip = 'ip'): self
    {
        $this->rules = ['ip' => $ip];

        return $this;
    }

    /**
     * The field under validation must be an IPv4 address.
     *
     * @param string $ipv4
     * @return self
     */
    public function ruleIpv4(?string $ipv4 = 'ipv4'): self
    {
        $this->rules = ['ipv4' => $ipv4];

        return $this;
    }

    /**
     * The field under validation must be an IPv6 address.
     *
     * @param string $ipv6
     * @return self
     */
    public function ruleIpv6(?string $ipv6 = 'ipv6'): self
    {
        $this->rules = ['ipv6' => $ipv6];

        return $this;
    }

    /**
     * The field under validation must be a valid JSON string.
     *
     * @param string $json
     * @return self
     */
    public function ruleJson(?string $json = 'json'): self
    {
        $this->rules = ['json' => $json];

        return $this;
    }

    /**
     * The field under validation must be less than the given field.
     * The two fields must be of the same type. Strings, numerics, arrays, and
     * files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return self
     */
    public function ruleLessThan(?string $field): self
    {
        if (is_null($field)) {
            $this->rules = ['lt' => null];
        } else {
            $this->rules = ['lt' => sprintf('lt:%s', $field)];
        }

        return $this;
    }

    /**
     * The field under validation must be less than or equal to the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return self
     */
    public function ruleLessThanOrEqual(?string $field): self
    {
        if (is_null($field)) {
            $this->rules = ['lte' => null];
        } else {
            $this->rules = ['lte' => sprintf('lte:%s', $field)];
        }

        return $this;
    }

    /**
     * The field under validation must be less than or equal to a maximum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion
     * as the size rule.
     *
     * @param int $max
     * @return self
     */
    public function ruleMax(?int $max): self
    {
        if (is_null($max)) {
            $this->rules = ['max' => null];
        } else {
            $this->rules = ['max' => sprintf('max:%d', $max)];
        }

        return $this;
    }

    /**
     * The file under validation must match one of the given MIME types
     *
     * @param null|string ...$types
     * @return self
     */
    public function ruleMimetypes(?string ...$types): self
    {
        $types = $this->removeNullValues($types);

        if (count($types) === 0) {
            $this->rules = ['mimetypes' => null];
        } else {
            $this->rules = ['mimetypes' => sprintf(
                'mimetypes:%s', implode(',', $types)
            )];
        }

        return $this;
    }

    /**
     * The file under validation must match one of the given MIME types
     *
     * @param null|string ...$mimes
     * @return self
     */
    public function ruleMimes(?string ...$mimes): self
    {
        $mimes = $this->removeNullValues($mimes);

        if (count($mimes) === 0) {
            $this->rules = ['mimes' => null];
        } else {
            $this->rules = ['mimes' => sprintf(
                'mimes:%s', implode(',', $mimes)
            )];
        }

        return $this;
    }

    /**
     * The field under validation must have a minimum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion
     * as the size rule.
     *
     * @param int $min
     * @return self
     */
    public function ruleMin(?int $min): self
    {
        if (is_null($min)) {
            $this->rules = ['min' => null];
        } else {
            $this->rules = ['min' => sprintf('min:%d', $min)];
        }

        return $this;
    }

    /**
     * The field under validation must not be included in the given list of values.
     *
     * @param null|string ...$list
     * @return self
     */
    public function ruleNotIn(?string ...$list): self
    {
        $list = $this->removeNullValues($list);

        if (count($list) === 0) {
            $this->rules = ['not_in' => null];
        } else {
            $this->rules = ['not_in' => sprintf(
                'not_in:%s', implode(',', $list)
            )];
        }

        return $this;
    }

    /**
     * The field under validation may be null.
     * This is particularly useful when validating primitive such as strings and
     * integers that can contain null values.
     *
     * @param string $nullable
     * @return self
     */
    public function ruleNullable(?string $nullable = 'nullable'): self
    {
        $this->rules = ['nullable' => $nullable];

        return $this;
    }

    /**
     * The field under validation must be numeric.
     *
     * @param string $numeric
     * @return self
     */
    public function ruleNumeric(?string $numeric = 'numeric'): self
    {
        $this->rules = ['numeric' => $numeric];

        return $this;
    }

    /**
     * The field under validation must be present in the input data but can be empty.
     *
     * @param string $present
     * @return self
     */
    public function rulePresent(?string $present = 'present'): self
    {
        $this->rules = ['present' => $present];

        return $this;
    }

    /**
     * The field under validation must be present in the input data and not empty.
     *
     * @param string $required
     * @return self
     */
    public function ruleRequired(?string $required = 'required'): self
    {
        $this->rules = ['required' => $required];

        return $this;
    }

    /**
     * The field under validation must be present and not empty if
     * the anotherfield field is equal to any value.
     *
     * @param null|string ...$field
     * @return self
     */
    public function ruleRequiredIf(?string ...$field): self
    {
        $field = $this->removeNullValues($field);

        if (count($field) === 0) {
            $this->rules = ['required_if' => null];
        } else {
            $this->rules = ['required_if' => sprintf(
                'required_if:%s,%s', implode(',', $field)
            )];
        }

        return $this;
    }

    /**
     * The field under validation must be present and not empty unless
     * the anotherfield field is equal to any value.
     *
     * @param null|string ...$field
     * @return self
     */
    public function ruleRequiredUnless(?string ...$field): self
    {
        $field = $this->removeNullValues($field);

        if (count($field) === 0) {
            $this->rules = ['required_unless' => null];
        } else {
            $this->rules = ['required_unless' => sprintf(
                'required_unless:%s', implode(',', $field)
            )];
        }

        return $this;
    }

    /**
     * The field under validation must be present and not empty only if any
     * of the other specified fields are present.
     *
     * @param null|string ...$fields
     * @return self
     */
    public function ruleRequiredWith(?string ...$fields): self
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            $this->rules = ['required_with' => null];
        } else {
            $this->rules = ['required_with' => sprintf(
                'required_with:%s', implode(',', $fields)
            )];
        }

        return $this;
    }

    /**
     * The field under validation must be present and not empty only if all
     * of the other specified fields are present.
     *
     * @param null|string ...$fields
     * @return self
     */
    public function ruleRequiredWithAll(?string ...$fields): self
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            $this->rules = ['required_with_all' => null];
        } else {
            $this->rules = ['required_with_all' => sprintf(
                'required_with_all:%s', implode(',', $fields)
            )];
        }

        return $this;
    }

    /**
     * The field under validation must be present and not empty only when any
     * of the other specified fields are not present.
     *
     * @param null|string ...$fields
     * @return self
     */
    public function ruleRequiredWithout(?string ...$fields): self
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            $this->rules = ['required_without' => null];
        } else {
            $this->rules = ['required_without' => sprintf(
                'required_without:%s', implode(',', $fields)
            )];
        }

        return $this;
    }

    /**
     * The field under validation must be present and not empty only when all
     * of the other specified fields are not present.
     *
     * @param null|string ...$fields
     * @return self
     */
    public function ruleRequiredWithoutAll(?string ...$fields): self
    {
        $fields = $this->removeNullValues($fields);

        if (count($fields) === 0) {
            $this->rules = ['required_without_all' => null];
        } else {
            $this->rules = ['required_without_all' => sprintf(
                'required_without_all:%s', implode(',', $fields)
            )];
        }

        return $this;
    }

    /**
     * The given field must match the field under validation.
     *
     * @param string $field
     * @return self
     */
    public function ruleSame(?string $field): self
    {
        if (is_null($field)) {
            $this->rules = ['same' => null];
        } else {
            $this->rules = ['same' => sprintf('same:%s', $field)];
        }

        return $this;
    }

    /**
     * The field under validation must have a size matching the given value.
     * For string data, value corresponds to the number of characters.
     * For numeric data, value corresponds to a given integer value.
     * For an array, size corresponds to the count of the array.
     * For files, size corresponds to the file size in kilobytes.
     *
     * @param int $value
     * @return self
     */
    public function ruleSize(?int $value): self
    {
        if (is_null($value)) {
            $this->rules = ['size' => null];
        } else {
            $this->rules = ['size' => sprintf('size:%d', $value)];
        }

        return $this;
    }

    /**
     * The field under validation must be a string. If you would like to allow
     * the field to also be null, you should assign the nullable rule to the field.
     *
     * @param string $string
     * @return self
     */
    public function ruleString(?string $string = 'string'): self
    {
        $this->rules = ['string' => $string];

        return $this;
    }

    /**
     * The field under validation must be a valid timezone identifier according
     * to the timezone_identifiers_list PHP function.
     *
     * @param string $timezone
     * @return self
     */
    public function ruleTimezone(?string $timezone = 'timezone'): self
    {
        $this->rules = ['timezone' => $timezone];

        return $this;
    }

    /**
     * The field under validation must be unique in a given database table.
     *
     * @param string|null ...$values
     * @return InputRules
     */
    public function ruleUnique(?string ...$values): self
    {
        $values = $this->removeNullValues($values);

        if (count($values) === 0) {
            $this->rules = ['unique' => null];
        } else {
            $this->rules = ['unique' => sprintf('unique:%s', implode(',', $values))];
        }

        return $this;
    }

    /**
     * The field under validation must be a valid URL.
     *
     * @param string $url
     * @return self
     */
    public function ruleUrl(?string $url = 'url'): self
    {
        $this->rules = ['url' => $url];

        return $this;
    }
}
