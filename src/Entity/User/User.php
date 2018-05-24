<?php

    namespace App\Entity\User;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
     */
    class User
    {
        /**
         * @ORM\Id()
         * @ORM\GeneratedValue()
         * @ORM\Column(type="integer")
         */
        protected $id;

        /**
         * @ORM\Column(type="string", length=255)
         */
        protected $username;

        /** @var string */
        protected $plainPassword;

        /**
         * @ORM\Column(type="string", length=255)
         */
        protected $password;

        public function getId()
        {
            return $this->id;
        }

        public function getUsername(): ?string
        {
            return $this->username;
        }

        public function setUsername(string $username): self
        {
            $this->username = $username;

            return $this;
        }

        public function getPlainPassword(): ?string
        {
            return $this->plainPassword;
        }

        public function setPlainPassword(string $plainPassword): self
        {
            $this->plainPassword = $plainPassword;

            return $this;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function setPassword(string $password): self
        {
            $this->password = $password;

            return $this;
        }
    }
?>