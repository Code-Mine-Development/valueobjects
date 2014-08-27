<?php

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\String\String;

class FragmentIdentifier extends String implements FragmentIdentifierInterface
{
    /**
     * Returns a new FragmentIdentifier
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (0 === \preg_match('/^#[?%!$&\'()*+,;=a-zA-Z0-9-._~:@\/]*$/', $value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid fragment identifier)'));
        }

        $this->value = $value;
    }
}
