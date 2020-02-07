<?php declare(strict_types=1);
/**
 * @see       <https://github.com/kooser-framework/framework> for the canonical source repository
 * @copyright <https://github.com/kooser-framework/framework/blob/master/copyright> Framework Copyright
 * @license   <https://github.com/kooser-framework/framework/blob/master/license> MIT License
 */

namespace Kooser\Hashing;

/**
 * The hasher interface.
 */
interface Hasher
{
    /**
     * Construct a new argon2id hasher.
     *
     * @param array $options The argon2id hasher options.
     *
     * @return void Returns nothing.
     */
    public function __construct(array $options = []);

    /**
     * Set the hasher options.
     *
     * @param array $options The hasher options.
     *
     * @return \Kooser\Hashing\Hasher Returns the hasher.
     */
    public function setOptions(array $options = []): Hasher;

    /**
     * Verify the password matches the given hash.
     *
     * @param string $password The password to check.
     * @param string $hash     The hash the password must match.
     *
     * @return bool Returns true if the password matches and false if not.
     */
    public function verify(string $password, string $hash): bool;

    /**
     * Comput a new hash.
     *
     * @param string $password The password to hash.
     *
     * @return string Returns the hashed password.
     */
    public function compute(string $password): ?string;

    /**
     * Determine if the hash needs a rehash.
     *
     * @param string $hash The hash to check.
     *
     * @return bool Returns true if the hash needs a rehash and false if not.
     */
    public function needsRehash(string $hash): bool;
}
