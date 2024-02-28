<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

/*
* Class Callback

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */
final class Callback
{
    /**
     * Validates whether the input is a valid callback (callable).
     *
     * @param mixed $input The input to be validated.
     *
     * @return bool True if the input is a valid callback, false otherwise.
     */
    public function validate($input): bool
    {
        $value = $input['valueData'];

        return is_callable($input);
    }

    /**
     * Get the error message for validation failure.
     *
     * @return string The error message.
     */
    public function message()
    {
        return 'The input is not a valid callback.';
    }
}
