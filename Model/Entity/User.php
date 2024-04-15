<?php

namespace Model\Entity;

class User extends BaseEntity
{
    private $nom;
    private $prenom;
    private $mot_de_passe;
    private $email;
    private $birthday;
    private $telephone;
    private $roles;

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->mot_de_passe;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->mot_de_passe = $password;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->telephone = $phone;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->roles;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->roles = $role !== null ? $role : ROLE_USER;

        return $this;
    }
}