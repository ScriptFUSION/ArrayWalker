<?php
namespace ScriptFUSION\ArrayWalker;

use ScriptFUSION\StaticClass;

/**
 * Walks nested array structures to retrieve values.
 */
class ArrayWalker
{
    use StaticClass;

    /**
     * Walks the specified nested array elements according to the ordered list
     * of keys specified by the path and returns the value of the matching
     * element.
     *
     * @param array $array Nested array elements.
     * @param array $path Path.
     *
     * @return mixed The matching element's value if found, otherwise null.
     */
    public static function walk(array $array, array $path)
    {
        while (count($path)) {
            if (!is_array($array)) {
                return null;
            }

            $array = $array[array_shift($path)];
        }

        return $array;
    }
}
