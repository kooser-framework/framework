<?php declare(strict_types=1);
/**
 * @see       <https://github.com/kooser-framework/framework> for the canonical source repository
 * @copyright <https://github.com/kooser-framework/framework/blob/master/copyright> Framework Copyright
 * @license   <https://github.com/kooser-framework/framework/blob/master/license> MIT License
 */

namespace Kooser\Hashing;

/**
 * Defines any extra hasher methods in an abstract scope.
 */
abstract class AbstractHasher
{
    /**
     * Get informtion on a hash.
     *
     * @param string $hash The hash to get info on.
     *
     * @return array Returns the hash info.
     */
    public function getInfo(string $hash): array
    {
        return password_get_info($hash);
    }
}
