<?php

namespace ValueObjects\Tests\Structure;

use ValueObjects\Number\Integer;
use ValueObjects\String\String;
use ValueObjects\Structure\Collection;
use ValueObjects\Structure\Dictionary;
use ValueObjects\Structure\KeyValuePair;
use ValueObjects\Tests\TestCase;

class DictionaryTest extends TestCase
{
    /** @var Dictionary */
    protected $dictionary;

    public function setup()
    {
        $array = \SplFixedArray::fromArray(array(
            new KeyValuePair(new Integer(0), new String('zero')),
            new KeyValuePair(new Integer(1), new String('one')),
            new KeyValuePair(new Integer(2), new String('two')),
        ));

        $this->dictionary = new Dictionary($array);
    }

    public function testFromNative()
    {
        $constructedArray = \SplFixedArray::fromArray(array(
            new KeyValuePair(new String('0'), new String('zero')),
            new KeyValuePair(new String('1'), new String('one')),
            new KeyValuePair(new String('2'), new String('two')),
        ));

        $fromNativeArray = \SplFixedArray::fromArray(array(
            'zero',
            'one',
            'two'
        ));

        $constructedDictionary = new Dictionary($constructedArray);
        $fromNativeDictionary  = Dictionary::fromNative($fromNativeArray);

        $this->assertTrue($constructedDictionary->sameValueAs($fromNativeDictionary));
    }

    /** @expectedException \InvalidArgumentException */
    public function testInvalidArgument()
    {
        $array = \SplFixedArray::fromArray(array('one', 'two', 'three'));

        new Dictionary($array);
    }

    public function testKeys()
    {
        $array = \SplFixedArray::fromArray(array(
            new Integer(0),
            new Integer(1),
            new Integer(2)
        ));
        $keys = new Collection($array);

        $this->assertTrue($this->dictionary->keys()->sameValueAs($keys));
    }

    public function testValues()
    {
        $array = \SplFixedArray::fromArray(array(
            new String('zero'),
            new String('one'),
            new String('two')
        ));
        $values = new Collection($array);

        $this->assertTrue($this->dictionary->values()->sameValueAs($values));
    }

    public function testContainsKey()
    {
        $one = new Integer(1);
        $ten = new Integer(10);

        $this->assertTrue($this->dictionary->containsKey($one));
        $this->assertFalse($this->dictionary->containsKey($ten));
    }

    public function testContainsValue()
    {
        $one = new String('one');
        $ten = new String('ten');

        $this->assertTrue($this->dictionary->containsValue($one));
        $this->assertFalse($this->dictionary->containsValue($ten));
    }
}
