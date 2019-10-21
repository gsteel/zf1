<?php
interface Zend_Auth_Adapter_Http_Resolver_Interface
{
    /**
     * Resolve username/realm to password/hash/etc.
     *
     * @param  string $username Username
     * @param  string $realm    Authentication Realm
     * @return string|false User's shared secret, if the user is found in the
     *         realm, false otherwise.
     */
    public function resolve($username, $realm);
}
