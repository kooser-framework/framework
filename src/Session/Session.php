<?php declare(strict_types=1);
/**
 * @see       <https://github.com/kooser-framework/framework> for the canonical source repository
 * @copyright <https://github.com/kooser-framework/framework/blob/master/copyright> Framework Copyright
 * @license   <https://github.com/kooser-framework/framework/blob/master/license> MIT License
 */

namespace Kooser\Session;

use SessionHandlerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Securely manage and preserve session data.
 */
final class Session implements Manager
{
    /** @var array $options The session manager options. */
    private array $options = [];
    
    /**
     * Constructs a new session manager.
     * 
     * @param array $options The session manager options.
     *
     * @return void Returns nothing.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Set the session manager options.
     *
     * @param array $options The session manager options.
     *
     * @return \Kooser\Session\Manager Returns the session manager.
     */
    public function setOptions(array $options = []): Manager
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);
        $this->setSaveHandler(new NativeSessionHandler());
        return $this;
    }

    /**
     * Sets user-level session storage functions.
     *
     * @param \SessionHandlerInterface $sessionHandler   The user-level session storage.
     * @param bool                     $registerShutdown Should we resiter the shutdown function.
     *
     * @return void Returns nothing.
     */
    public function setSaveHandler(SessionHandlerInterface $sessionHandler, bool $registerShutdown = true): void
    {
        session_set_save_handler($registerShutdown, true);
    }

    /**
     * Check to see if a session already exists.
     *
     * @return bool Returns true if one exists and false if not.
     */
    public static function exists(): bool
    {
        if (php_sapi_name() !== 'cli') {
            return session_status() === PHP_SESSION_ACTIVE ? true : false;
        }
        return false;
    }

    /**
     * Regenerates the session.
     *
     * @param bool $deleteOldSession Whether to delete the old session or not.
     *
     * @return bool Returns true on success or false on failure.
     */
    public function regenerate(bool $deleteOldSession = true): bool
    {
        return session_regenerate_id($deleteOldSession);
    }

    /**
     * Check to see if a session variable exists.
     *
     * @param string $key The session variable key.
     *
     * @return bool Returns true if the session variable exists and false if not.
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Get a session variable.
     *
     * @param string $key          The session variable key.
     * @param string $defaultValue The defualt session data.
     *
     * @return string Returns the session dat or nullable.
     */
    public function get(string $key, ?string $defaultValue = null): ?string
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return $defaultValue;
    }

    /**
     * Flash a session variable.
     *
     * @param string $key          The session variable key.
     * @param string $defaultValue The defualt session data.
     *
     * @return string Returns the session dat or nullable.
     */
    public function flash(string $key, ?string $defaultValue = null): ?string
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }
        return $defaultValue;
    }

    /**
     * Set a session variable.
     *
     * @param string $key   The session variable key.
     * @param string $value The session data.
     *
     * @return void Returns nothing.
     */
    public function put(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Delete a session variable.
     *
     * @param string $key The session variable key.
     *
     * @return void Returns nothing.
     */
    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Configure the session manager options.
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver The symfony options resolver.
     *
     * @return void Returns nothing.
     */
    private function configureOptions(OptionsResolver $resolver): void
    {
    }
}
