<?php

namespace Belvedere\FormMaker\Contracts\Rules;

interface RulerContract
{
    /**
     * The field under validation must be yes, on, 1, or true.
     * This is useful for validating "Terms of Service" acceptance.
     *
     * @param string $accepted
     * @return array
     */
    public function accepted(?string $accepted = 'accepted'): array;

    /**
     * The field under validation must have a valid A or AAAA record according
     * to the dns_get_record PHP function.
     *
     * @param string $activeUrl
     * @return array
     */
    public function activeUrl(?string $activeUrl = 'active_url'): array;

    /**
     * The field under validation must be a value after a given date.
     * The dates will be passed into the strtotime PHP function.
     *
     * @param string $date
     * @return array
     */
    public function after(?string $date): array;

    /**
     * The field under validation must be a value after or equal to the given date.
     * For more information, see the after rule.
     *
     * @param string $date
     * @return array
     */
    public function afterOrEqual(?string $date): array;

    /**
     * The field under validation must be entirely alphabetic characters.
     *
     * @param string $alpha
     * @return array
     */
    public function alpha(?string $alpha = 'alpha'): array;

    /**
     * The field under validation may have alpha-numeric characters,
     * as well as dashes and underscores.
     *
     * @param string $alphaDash
     * @return array
     */
    public function alphaDash(?string $alphaDash = 'alpha_dash'): array;

    /**
     * The field under validation must be entirely alpha-numeric characters.
     *
     * @param string $alphaNum
     * @return array
     */
    public function alphaNum(?string $alphaNum = 'alpha_num'): array;

    /**
     * The field under validation must be a PHP array.
     *
     * @param string $array
     * @return array
     */
    public function isArray(?string $array = 'array'): array;

    /**
     * Stop running validation rules after the first validation failure.
     *
     * @param string $bail
     * @return array
     */
    public function bail(?string $bail = 'bail'): array;

    /**
     * The field under validation must be a value preceding the given date.
     * The dates will be passed into the PHP strtotime function.
     * In addition, like the after rule, the name of another field under
     * validation may be supplied as the value of date.
     *
     * @param string $date
     * @return array
     */
    public function before(?string $date): array;

    /**
     * The field under validation must be a value preceding or equal to the given date.
     * The dates will be passed into the PHP strtotime function.
     * In addition, like the after rule, the name of another field under
     * validation may be supplied as the value of date.
     *
     * @param string $date
     * @return array
     */
    public function beforeOrEqual(?string $date): array;

    /**
     * The field under validation must have a size between the given min and max.
     * Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
     *
     * @param int|null ...$interval
     * @return array
     */
    public function between(?int ...$interval): array;

    /**
     * The field under validation must be able to be cast as a boolean.
     *
     * @param string $boolean
     * @return array
     */
    public function boolean(?string $boolean = 'boolean'): array;

    /**
     * The field under validation must have a matching field of foo_confirmation.
     * For example, if the field under validation is password,
     * a matching password_confirmation field must be present in the input.
     *
     * @param string $confirmed
     * @return array
     */
    public function confirmed(?string $confirmed = 'confirmed'): array;

    /**
     * The field under validation must be a valid date according to the strtotime PHP function.
     *
     * @param string $date
     * @return array
     */
    public function date(?string $date = 'date'): array;

    /**
     * The field under validation must be equal to the given date.
     * The dates will be passed into the PHP strtotime function.
     *
     * @param string $date
     * @return array
     */
    public function dateEquals(?string $date): array;

    /**
     * The field under validation must match the given format.
     * You should use either date or date_format when validating a field, not both.
     *
     * @param string $format
     * @return array
     */
    public function dateFormat(?string $format): array;

    /**
     * The field under validation must have a different value than field.
     *
     * @param string $field
     * @return array
     */
    public function different(?string $field): array;

    /**
     * The field under validation must be numeric and must have an exact length of value.
     *
     * @param int $value
     * @return array
     */
    public function digits(?int $value): array;

    /**
     * The field under validation must have a length between the given min and max.
     *
     * @param int|null ...$interval
     * @return array
     */
    public function digitsBetween(?int ...$interval): array;

    /**
     * The file under validation must be an image meeting the dimension
     * constraints as specified by the rule's parameters.
     *
     * @param null|string ...$dimensions
     * @return array
     */
    public function dimensions(?string ...$dimensions): array;

    /**
     * When working with arrays, the field under validation must not have any duplicate values.
     *
     * @param string $distinct
     * @return array
     */
    public function distinct(?string $distinct = 'distinct'): array;

    /**
     * The field under validation must be formatted as an e-mail address.
     *
     * @param string $email
     * @return array
     */
    public function email(?string $email = 'email'): array;

    /**
     * The field under validation must exist on a given database table.
     *
     * @param null|string ...$values
     * @return array
     */
    public function exists(?string ...$values): array;

    /**
     * The field under validation must be a successfully uploaded file.
     *
     * @param string $file
     * @return array
     */
    public function file(?string $file = 'file'): array;

    /**
     * The field under validation must not be empty when it is present.
     *
     * @param string $filled
     * @return array
     */
    public function filled(?string $filled = 'filled'): array;

    /**
     * The field under validation must be greater than the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function greaterThan(?string $field): array;

    /**
     * The field under validation must be greater than or equal to the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function greaterThanOrEqual(?string $field): array;

    /**
     * The file under validation must be an image (jpeg, png, bmp, gif, or svg).
     *
     * @param string $image
     * @return array
     */
    public function image(?string $image = 'image'): array;

    /**
     * The field under validation must be included in the given list of values.
     *
     * @param null|string ...$list
     * @return array
     */
    public function in(?string ...$list): array;

    /**
     * The field under validation must exist in anotherfield's values.
     *
     * @param string $anotherfield
     * @return array
     */
    public function inArray(?string $anotherfield): array;

    /**
     * The field under validation must be an integer.
     *
     * @param string $integer
     * @return array
     */
    public function integer(?string $integer = 'integer'): array;

    /**
     * The field under validation must be an integer.
     *
     * @param string $ip
     * @return array
     */
    public function ip(?string $ip = 'ip'): array;

    /**
     * The field under validation must be an IPv4 address.
     *
     * @param string $ipv4
     * @return array
     */
    public function ipv4(?string $ipv4 = 'ipv4'): array;

    /**
     * The field under validation must be an IPv6 address.
     *
     * @param string $ipv6
     * @return array
     */
    public function ipv6(?string $ipv6 = 'ipv6'): array;

    /**
     * The field under validation must be a valid JSON string.
     *
     * @param string $json
     * @return array
     */
    public function json(?string $json = 'json'): array;

    /**
     * The field under validation must be less than the given field.
     * The two fields must be of the same type. Strings, numerics, arrays, and
     * files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function lessThan(?string $field): array;

    /**
     * The field under validation must be less than or equal to the given field.
     * The two fields must be of the same type. Strings, numerics, arrays,
     * and files are evaluated using the same conventions as the size rule.
     *
     * @param string $field
     * @return array
     */
    public function lessThanOrEqual(?string $field): array;

    /**
     * The field under validation must be less than or equal to a maximum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion
     * as the size rule.
     *
     * @param int $max
     * @return array
     */
    public function max(?int $max): array;

    /**
     * The file under validation must match one of the given MIME types
     *
     * @param null|string ...$types
     * @return array
     */
    public function mimetypes(?string ...$types): array;

    /**
     * The file under validation must match one of the given MIME types
     *
     * @param null|string ...$mimes
     * @return array
     */
    public function mimes(?string ...$mimes): array;

    /**
     * The field under validation must have a minimum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion
     * as the size rule.
     *
     * @param int $min
     * @return array
     */
    public function min(?int $min): array;

    /**
     * The field under validation must not be included in the given list of values.
     *
     * @param null|string ...$list
     * @return array
     */
    public function notIn(?string ...$list): array;

    /**
     * The field under validation may be null.
     * This is particularly useful when validating primitive such as strings and
     * integers that can contain null values.
     *
     * @param string $nullable
     * @return array
     */
    public function nullable(?string $nullable = 'nullable'): array;

    /**
     * The field under validation must be numeric.
     *
     * @param string $numeric
     * @return array
     */
    public function numeric(?string $numeric = 'numeric'): array;

    /**
     * The field under validation must be present in the input data but can be empty.
     *
     * @param string $present
     * @return array
     */
    public function present(?string $present = 'present'): array;

    /**
     * The field under validation must be present in the input data and not empty.
     *
     * @param string $required
     * @return array
     */
    public function required(?string $required = 'required'): array;

    /**
     * The field under validation must be present and not empty if
     * the anotherfield field is equal to any value.
     *
     * @param null|string ...$field
     * @return array
     */
    public function requiredIf(?string ...$field): array;

    /**
     * The field under validation must be present and not empty unless
     * the anotherfield field is equal to any value.
     *
     * @param null|string ...$field
     * @return array
     */
    public function requiredUnless(?string ...$field): array;

    /**
     * The field under validation must be present and not empty only if any
     * of the other specified fields are present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWith(?string ...$fields): array;

    /**
     * The field under validation must be present and not empty only if all
     * of the other specified fields are present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWithAll(?string ...$fields): array;

    /**
     * The field under validation must be present and not empty only when any
     * of the other specified fields are not present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWithout(?string ...$fields): array;

    /**
     * The field under validation must be present and not empty only when all
     * of the other specified fields are not present.
     *
     * @param null|string ...$fields
     * @return array
     */
    public function requiredWithoutAll(?string ...$fields): array;

    /**
     * The given field must match the field under validation.
     *
     * @param string $field
     * @return array
     */
    public function same(?string $field): array;

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
    public function size(?int $value): array;

    /**
     * The field under validation must be a string. If you would like to allow
     * the field to also be null, you should assign the nullable rule to the field.
     *
     * @param string $string
     * @return array
     */
    public function string(?string $string = 'string'): array;

    /**
     * The field under validation must be a valid timezone identifier according
     * to the timezone_identifiers_list PHP function.
     *
     * @param string $timezone
     * @return array
     */
    public function timezone(?string $timezone = 'timezone'): array;

    /**
     * The field under validation must be unique in a given database table.
     *
     * @param string|null ...$values
     * @return array
     */
    public function unique(?string ...$values): array;

    /**
     * The field under validation must be a valid URL.
     *
     * @param string $url
     * @return array
     */
    public function url(?string $url = 'url'): array;
}