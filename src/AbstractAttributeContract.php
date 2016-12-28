<?php
namespace CrCms\AttributeContract;

use CrCms\AttributeContract\Exceptions\NotFoundException;

/**
 * Interface AttributeContract
 */
abstract class AbstractAttributeContract
{
    /**
     * @var bool
     */
    protected $openException = false;


    /**
     * @return array
     */
    abstract public function getAttributes() : array ;


    /**
     * @param bool $status
     * @return AbstractAttributeContract
     */
    public function setOpenException(bool $status) : AbstractAttributeContract
    {
        $this->openException = $status;
        return $this;
    }


    /**
     * @param $key
     * @return string
     * @throws NotFoundException
     */
    public function getTransform($key): string
    {
        if (!isset($this->getAttributes()[$key]) && $this->openException)
        {
            throw new NotFoundException('No conversion value was found');
        }

        return $this->getAttributes()[$key] ?? '';
    }


    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $static = new static;
        if (method_exists($name,$static)) {
            return call_user_func_array([$static,$name],$arguments);
        }
    }

}