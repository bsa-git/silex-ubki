<?php
// app/Providers/Security/UserProvider.php

namespace Providers\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Models\AR\Db;

/**
 * Class - ArUserProvider
 * user provider
 * 
 * @category Provider
 * @package  app\Providers
 * @author   Sergei Beskorovainyi <bsa2657@yandex.ru>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     https://github.com/bsa-git/silex-mvc/
 * 
 */
class ArUserProvider implements UserProviderInterface
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->db->find('user', 'first', array('conditions' => "username='{$username}'"));
        if (!$user) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
        return new User($user->username, $user->password, explode(',', $user->roles), true, true, true, true);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }
}
