<?php

namespace App\Serializer;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class OverseasNameConverter implements NameConverterInterface
{
    /**
     * Converts a property name to its normalized value.
     *
     * @param string $propertyName
     *
     * @return string
     */
    public function normalize($propertyName)
    {
        return 'overseas_' . $propertyName ;
    }

    /**
     * Converts a property name to its denormalized value.
     *
     * @param string $propertyName
     *
     * @return string
     */
    public function denormalize($propertyName)
    {
        return 'overseas_' === substr($propertyName, 0, 9) ? substr($propertyName, 9) : $propertyName;
    }
}