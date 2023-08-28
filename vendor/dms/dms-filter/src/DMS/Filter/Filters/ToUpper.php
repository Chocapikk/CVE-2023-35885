<?php
declare(strict_types=1);

namespace DMS\Filter\Filters;

use DMS\Filter\Exception\FilterException;
use DMS\Filter\Rules\Rule;

use function array_map;
use function function_exists;
use function in_array;
use function mb_list_encodings;
use function mb_strtoupper;
use function strtolower;
use function strtoupper;

/**
 * ToUpper Filter
 */
class ToUpper extends BaseFilter
{
    /**
     * {@inheritDoc}
     *
     * @param \DMS\Filter\Rules\ToUpper $rule
     */
    public function apply(Rule $rule, $value)
    {
        if ($this->useEncoding($rule)) {
            return mb_strtoupper((string) $value, $rule->encoding);
        }

        return strtoupper((string) $value);
    }

    /**
     * Verify is encoding is set and if we have the proper
     * function to use it
     *
     * @throws FilterException
     */
    public function useEncoding(\DMS\Filter\Rules\ToUpper $rule): bool
    {
        if ($rule->encoding === null) {
            return false;
        }

        if (! function_exists('mb_strtoupper')) {
            throw new FilterException(
                'mbstring is required to use ToLower with an encoding.'
            );
        }

        $this->encoding = (string) $rule->encoding;
        $encodings      = array_map('strtolower', mb_list_encodings());

        if (! in_array(strtolower($rule->encoding), $encodings)) {
            throw new FilterException(
                "mbstring does not support the '" . $rule->encoding . "' encoding"
            );
        }

        return true;
    }
}
