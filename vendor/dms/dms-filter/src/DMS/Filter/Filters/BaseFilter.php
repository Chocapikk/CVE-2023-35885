<?php
declare(strict_types=1);

namespace DMS\Filter\Filters;

use DMS\Filter\Rules\Rule;

/**
 * Base Filter Class
 *
 * Abstract class that defined the basic needs of a "Filter"
 * Filter classes are the enforcers of rules. This means they
 * are the classes that know how a given rule is applied to
 * a value.
 */
abstract class BaseFilter
{
    /**
     * Enforces the desired filtering on the the value
     * returning a filtered value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    abstract public function apply(Rule $rule, $value);
}
