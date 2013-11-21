<?php

namespace ValueObjects;

abstract class ValueObject implements ValueObjectInterface
{
    /**
     * Tells whether two objects are the same by comparing their properties.
     *
     * @param ValueObject $object
     * @return bool
     */
    public function equals(ValueObject $object)
    {
        $selfProperties = get_object_vars($this);
        $objectProperties = get_object_vars($object);

        foreach ($selfProperties as $name => $value) {
            // Check if the two objects have same properties with same values
            if (!isset($objectProperties[$name]) || $value !== $objectProperties[$name]) {
                return false;
            }
        }

        // Should we finally check against property count or it is not good for Parent/Child comparison?
        // eg. Color(0,0,0) can be considered equal to AlphaColor(0,0,0,.5)?
        // return count($selfProperties) == count($objectProperties);

        return true;
    }

    /**
     * Returns the fully namespaced class name.
     *
     * @return string
     */
    public function __toString()
    {
        return \get_class($this);
    }

} 