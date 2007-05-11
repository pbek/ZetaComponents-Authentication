<?php
/**
 * File containing the ezcAuthenticationBignumLibrary class.
 *
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 * @filesource
 * @package Authentication
 * @version //autogen//
 */

/**
 * Abstract class for large number support.
 *
 * Classes which extend this class must implement all the abstract methods.
 *
 * @package Authentication
 * @version //autogen//
 * @access private
 */
abstract class ezcAuthenticationBignumLibrary
{
    /**
     * Creates a new big number from $number in the base $base.
     *
     * The number $number can be integer or string.
     *
     * @param mixed $number The number from which to create the result
     * @param int $base The base in which the result will be
     * @return mixed
     */
    abstract public function init( $number, $base = 10 );

    /**
     * Adds two numbers.
     *
     * @param mixed $a The first number
     * @param mixed $b The second number
     * @return mixed
     */
    abstract public function add( $a, $b );

    /**
     * Substracts two numbers.
     *
     * @param mixed $a The first  number
     * @param mixed $b The second  number
     * @return mixed
     */
    abstract public function sub( $a, $b );

    /**
     * Multiplies two numbers.
     *
     * @param mixed $a The first number
     * @param mixed $b The second number
     * @return mixed
     */
    abstract public function mul( $a, $b );

    /**
     * Divides two numbers.
     *
     * @param mixed $a The first number
     * @param mixed $b The second number
     * @return mixed
     */
    abstract public function div( $a, $b );

    /**
     * Computes $base modulo $modulus.
     *
     * @param mixed $base The number to apply modulo to
     * @param mixed $modulus The modulo value to be applied to $base
     * @return mixed
     */
    abstract public function mod( $base, $modulus );

    /**
     * Computes $base to the power of $exponent.
     *
     * @param mixed $base The number to be exponentiated
     * @param mixed $exponent The exponent to apply to $base
     * @return mixed
     */
    abstract public function pow( $base, $exponent );

    /**
     * Computes $base to the power of $exponent and then applies modulo $modulus.
     *
     * @param mixed $base The number to be exponentiated
     * @param mixed $exponent The exponent to apply to $base
     * @param mixed $modulus The modulo value to be applied to the result
     * @return mixed
     */
    abstract public function powmod( $base, $exponent, $modulus );

    /**
     * Computes the inverse of $number in modulo $modulus.
     *
     * @param mixed $number The number for which to calculate the inverse
     * @param mixed $modulus The modulo value in which the inverse is calculated
     * @return mixed
     */
    abstract public function invert( $number, $modulus );

    /**
     * Finds the greatest common denominator of two numbers using the extended
     * Euclidean algorithm.
     *
     * The returned array is ( a0, b0, gcd( a, b ) ), where
     *     a0 * a + b0 * b = gcd( a, b )
     *
     * @param mixed $a The first number
     * @param mixed $b The second number
     * @return array(mixed)
     */
    abstract public function gcd( $a, $b );

    /**
     * Compares two  numbers.
     *
     * Returns an integer:
     *  - a positive value if $a > $b
     *  - zero if $a == $b
     *  - a negative value if $a < $b
     *
     * @param mixed $a The first number
     * @param mixed $b The second number
     * @return int
     */
    abstract public function cmp( $a, $b );

    /**
     * Returns the string representation of number $a.
     *
     * @param mixed $a The number to be represented as a string
     * @return string
     */
    abstract public function __toString( $a );

    /**
     * Converts a binary value to a decimal value.
     *
     * @param mixed $bin Binary value
     * @return string
     */
    public function binToDec( $bin )
    {
        $dec = $this->init( 0 );
        while ( strlen( $bin ) )
        {
            $i = ord( substr( $bin, 0, 1 ) );
            $dec = $this->add( $this->mul( $dec, 256 ), $i );
            $bin = substr( $bin, 1 );
        }
        return $this->__toString( $dec );
    }

    /**
     * Converts an hexadecimal value to a decimal value.
     *
     * @param mixed $hex Hexadecimal value
     * @return string
     */
    public function hexToDec( $hex )
    {
        $dec = $this->init( 0 );
        while ( strlen( $hex ) )
        {
            $i = hexdec( substr( $hex, 0, 4 ) );
            $dec = $this->add( $this->mul( $dec, 65536 ), $i );
            $hex = substr( $hex, 4 );
        }
        return $this->__toString( $dec );
    }
}
?>