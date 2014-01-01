<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Tests\TestCase;
use ValueObjects\Web\FragmentIdentifier;

class FragmentIdentifierTest extends TestCase
{
    public function testValidFragmentIdentifier()
    {
        $fragment = new FragmentIdentifier('#id');

        $this->assertInstanceOf('ValueObjects\Web\FragmentIdentifier', $fragment);
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidFragmentIdentifier()
    {
        new FragmentIdentifier('invalìd');
    }
}