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

        //内置转换
        $cover = ['getStaticTransform'=>'getTransform','getStaticAttributes'=>'getAttributes'];
        if (isset($cover[$name])) {
            return call_user_func_array([$static,$cover[$name]],$arguments);
        }

        //static调用
        $suffix = substr($name,-6);
        $name = substr($name,0,-6);
        if (strtolower($suffix) === 'static' && method_exists($static,$name)) {
            return call_user_func_array([$static,$name],$arguments);
        }
    }

}