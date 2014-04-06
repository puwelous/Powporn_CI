<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CAbstractEnum
 *
 * @author PC
 */
abstract class CAbstractEnum {

    private static $constCache = NULL;

    private static function getConstants($class) {
//        if (self::$constCache === NULL) {
            $reflect = new ReflectionClass(
                            $class
            );
            self::$constCache = $reflect->getConstants();
//        }
//
        return self::$constCache;
    }

    public static function isValidName($class, $name, $strict = false) {
        $constants = self::getConstants($class);

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue( $class, $value) {
        $values = array_values(self::getConstants( $class ));
        return in_array($value, $values, $strict = true);
    }

}

?>
