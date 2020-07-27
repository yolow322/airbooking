<?php
/**
 *
 * For info about users
 *
 */

class User
{
    private string $userName;
    private string $userSurname;
    private string $userLastName;
    private string $userLogin;
    private string $userPasswordHash;
    private string $userRole;

    /**
     *
     * @param mixed $userName
     *
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     *
     * @return string
     *
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     *
     * @param mixed $userSurname
     *
     */
    public function setUserSurname($userSurname): void
    {
        $this->userSurname = $userSurname;
    }

    /**
     *
     * @return string
     *
     */
    public function getUserSurname(): string
    {
        return $this->userSurname;
    }

    /**
     *
     * @param mixed $userLastName
     *
     */
    public function setUserLastName($userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    /**
     *
     * @return string
     *
     */
    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    /**
     *
     * @param mixed $userLogin
     *
     */
    public function setUserLogin($userLogin): void
    {
        $this->userLogin = $userLogin;
    }

    /**
     *
     * @return string
     *
     */
    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    /**
     *
     * @param mixed $userPasswordHash
     *
     */
    public function setUserPasswordHash($userPasswordHash): void
    {
        $this->userPasswordHash = $userPasswordHash;
    }

    /**
     *
     * @return string
     *
     */
    public function getUserPasswordHash(): string
    {
        return $this->userPasswordHash;
    }

    /**
     *
     * @param mixed $userRole
     *
     */
    public function setUserRole(string $userRole): void
    {
        $this->userRole = $userRole;
    }

    /**
     *
     * @return string
     *
     */
    public function getUserRole(): string
    {
        return $this->userRole;
    }

    /**
     *
     * class constructor
     * @param $userName
     * @param $userSurname
     * @param $userLastName
     * @param $userLogin
     * @param $userPassword
     * @param $userPasswordHash
     * @param $userRole
     *
     */
    public function __construct($userName, $userSurname, $userLastName, $userLogin, $userPasswordHash, $userRole)
    {
        $this->setUserName($userName);
        $this->setUserSurname($userSurname);
        $this->setUserLastName($userLastName);
        $this->setUserLogin($userLogin);
        $this->setUserPasswordHash($userPasswordHash);
        $this->setUserRole($userRole);
    }
}
