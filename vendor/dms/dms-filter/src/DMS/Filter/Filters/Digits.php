<?php
declare(strict_types=1);

namespace DMS\Filter\Filters;

use DMS\Filter\Rules\Rule;

/**
 * Digits Rule
 */
class Digits extends RegExp
{
    /**
     * {@inheritDoc}
     *
     * @param \DMS\Filter\Rules\Digits $rule
     */
    public function apply(Rule $rule, $value)
    {
        //Check for Whitespace support
        $whitespaceChar = $rule->allowWhitespace ? ' ' : '';

        $rule->unicodePattern = '/[^\p{N}' . $whitespaceChar . ']/';
        $rule->pattern        = '/[^0-9' . $whitespaceChar . ']/';

        return parent::apply($rule, $value);
    }
}
