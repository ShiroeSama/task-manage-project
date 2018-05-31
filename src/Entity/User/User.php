<?php

    namespace App\Entity\User;

    use App\Entity\Project\Project;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\EquatableInterface;
    use Symfony\Component\Security\Core\User\UserInterface;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
     */
    class User implements UserInterface , EquatableInterface
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

        /**
         * @var array
         *
         * @ORM\Column(name="roles", type="simple_array")
         */
        protected $roles;

        /**
         * @var int
         *
         * @ORM\Column(name="created_at", type="integer")
         */
        protected $createdAt;

        /**
         * @var int|null
         *
         * @ORM\Column(name="updated_at", type="integer", nullable=true)
         */
        protected $updatedAt;


        # -------------------------------------------------------------
        #   User Interface
        # -------------------------------------------------------------

        /**
         * @var string
         *
         * @ORM\Column(name="salt", type="string", length=255)
         *
         * @JMS\Exclude()
         */
        protected $salt;


        # -------------------------------------------------------------
        #   Association
        # -------------------------------------------------------------

        /**
         * @var Project
         * @ORM\ManyToOne(targetEntity="App\Entity\Project\Project", inversedBy="users")
         */
        protected $project;

        /**
         * User constructor.
         */
        public function __construct()
        {
            $this->salt = md5(uniqid('', true));
            $this->setCreatedAt(time());
            $this->setUpdatedAt(time());
        }


        # -------------------------------------------------------------
        #   Id
        # -------------------------------------------------------------

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }


        # -------------------------------------------------------------
        #   Username
        # -------------------------------------------------------------

        /**
         * @return null|string
         */
        public function getUsername(): ?string
        {
            return $this->username;
        }

        /**
         * @param string $username
         * @return User
         */
        public function setUsername(string $username): self
        {
            $this->username = $username;

            return $this;
        }


        # -------------------------------------------------------------
        #   Plain Password
        # -------------------------------------------------------------

        /**
         * @return null|string
         */
        public function getPlainPassword(): ?string
        {
            return $this->plainPassword;
        }

        /**
         * @param string $plainPassword
         * @return User
         */
        public function setPlainPassword(string $plainPassword): self
        {
            $this->plainPassword = $plainPassword;

            return $this;
        }


        # -------------------------------------------------------------
        #   Password
        # -------------------------------------------------------------

        /**
         * @return null|string
         */
        public function getPassword(): ?string
        {
            return $this->password;
        }

        /**
         * @param string $password
         * @return User
         */
        public function setPassword(string $password): self
        {
            $this->password = $password;

            return $this;
        }


        # -------------------------------------------------------------
        #   Project
        # -------------------------------------------------------------

        /**
         * @return Project
         */
        public function getProject()
        {
            return $this->project;
        }

        /**
         * @param Project $project
         */
        public function setProject(Project $project)
        {
            $this->project = $project;
        }


        # -------------------------------------------------------------
        #   Role
        # -------------------------------------------------------------

        /**
         * @return array
         */
        public function getRoles(): array
        {
            return $this->roles;
        }

        /**
         * @return string
         */
        public function getRole(): string
        {
            return reset($this->roles);
        }

        /**
         * @param string $role
         *
         * @return self
         */
        public function setRole(string $role): self
        {
            $this->roles = [$role];

            return $this;
        }



        # -------------------------------------------------------------
        #   Created At
        # -------------------------------------------------------------

        /**
         * @return int
         */
        public function getCreatedAt(): int
        {
            return $this->createdAt;
        }

        /**
         * @param int $createdAt
         *
         * @return self
         */
        public function setCreatedAt(int $createdAt): self
        {
            $this->createdAt = $createdAt;

            return $this;
        }



        # -------------------------------------------------------------
        #   Uploaded At
        # -------------------------------------------------------------

        /**
         * @return int|null
         */
        public function getUpdatedAt()
        {
            return $this->updatedAt;
        }

        /**
         * @param int $updatedAt
         *
         * @return self
         */
        public function setUpdatedAt(int $updatedAt): self
        {
            $this->updatedAt = $updatedAt;

            return $this;
        }

        /** ------------------------------------------------------------------------ */
        /** Implements Interface : UserInterface */


        # -------------------------------------------------------------
        #   Salt & Erase Credentials
        # -------------------------------------------------------------

        public function getSalt()
        {
            return $this->salt;
        }

        public function eraseCredentials() { }



        /** ------------------------------------------------------------------------ */
        /** Implements Interface : EquatableInterface */

        /**
         * @param UserInterface $user
         * @return bool
         */
        public function isEqualTo(UserInterface $user)
        {
            if (!$user instanceof UserInterface) {
                return false;
            }

            if ($this->password !== $user->getPassword()) {
                return false;
            }

            if ($this->salt !== $user->getSalt()) {
                return false;
            }

            if ($this->email !== $user->getUsername()) {
                return false;
            }

            return true;
        }
    }
?>