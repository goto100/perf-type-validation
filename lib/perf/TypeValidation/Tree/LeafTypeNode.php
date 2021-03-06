<?php

namespace perf\TypeValidation\Tree;

/**
 *
 *
 */
class LeafTypeNode implements TypeNode
{

    /**
     *
     *
     * @var string
     */
    private $type;

    /**
     * Constructor.
     *
     * @param string $type
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Tells wether provided value is valid according to current type node.
     *
     * @param mixed $value Value to validate.
     * @return bool
     */
    public function isValid($value)
    {
        if ('mixed' === $this->type) {
            return true;
        }

        static $functionMap = array(
            'array'    => 'is_array',
            'bool'     => 'is_bool',
            'boolean'  => 'is_bool',
            'double'   => 'is_float',
            'float'    => 'is_float',
            'int'      => 'is_int',
            'integer'  => 'is_int',
            'null'     => 'is_null',
            'numeric'  => 'is_numeric',
            'object'   => 'is_object',
            'resource' => 'is_resource',
            'scalar'   => 'is_scalar',
            'string'   => 'is_string',
        );

        if (array_key_exists($this->type, $functionMap)) {
            $function = $functionMap[$this->type];

            return $function($value);
        }

        if (is_object($value)) {
            return ($value instanceof $this->type);
        }

        return false;
    }

    /**
     * Returns a textual representation of the current type node.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->type;
    }
}
