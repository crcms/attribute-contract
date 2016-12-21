<?php
namespace CrCms\AttributeContract;

use CrCms\AttributeContract\Exceptions\NotFoundException;

/**
 * Interface AttributeContract
 */
abstract class AbstractAttributeContract
{

    /**
     * @return array
     */
    abstract public function getAttributes() : array ;


    /**
     * @param $key
     * @return string
     * @throws NotFoundException
     */
    public function getTransform($key): string
    {
        if (!isset($this->getAttributes()[$key]))
        {
            throw new NotFoundException('No conversion value was found');
        }

        return $this->getAttributes()[$key];
    }

}