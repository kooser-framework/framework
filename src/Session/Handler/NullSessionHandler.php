<?php declare(strict_types=1);
/**
 * @see       <https://github.com/kooser-framework/framework> for the canonical source repository
 * @copyright <https://github.com/kooser-framework/framework/blob/master/copyright> Framework Copyright
 * @license   <https://github.com/kooser-framework/framework/blob/master/license> New BSD License
 */

namespace Kooser\Session\Handler;

use SessionHandlerInterface;

/**
 * The blackhole session handler.
 */
class NullSessionHandler implements SessionHandlerInterface
{
    /**
     * Initialize session.
     *
     * @param string $savePath    The save location.
     * @param string $sessionName The session namespace.
     *
     * @returns bool Returns true if the session was initialized and false if not.
     */
    public function open(string $savePath, string $sessionName): bool
    {
        return true;
    }

    /**
     * Close the session.
     *
     * @return bool Returns true if closed and false if not.
     */
    public function close(): bool
    {
        return true;
    }

    /**
     * Read session data.
     *
     * @param string $sessionId The session id to access.
     *
     * @returns string Returns the session data or an empty string.
     */
    public function read(string $sessionId): string
    {
        return '';
    }

    /**
     * Write session data.
     *
     * @param string $sessionId The session id to access.
     * @param string $data      The session data to write.
     *
     * @return bool Returns true if the data was written and false if not.
     */
    public function write(string $sessionId, string $data): bool
    {
        return true;
    }

    /**
     * Destroy a session.
     *
     * @param string $sessionId The session id to access.
     *
     * @return bool Returns true if the session was destroyed and false if not.
     */
    public function destroy(string $sessionId): bool
    {
        return true;
    }

    /**
     * Cleanup old sessions.
     *
     * @param int $lifetime The max lifetime for a session to be stored.
     *
     * @return bool Returns true if the old sessions was destroyed.
     */
    public function gc(int $lifetime): bool
    {
        return true;
    }
}
