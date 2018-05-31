<?php

    namespace App\Entity\Project;

    use App\Entity\Feature\Feature;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectRepository")
     */
    class Project
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
        protected $code;

        /**
         * @ORM\Column(type="integer")
         */
        protected $realizationPeriod;


        # -------------------------------------------------------------
        #   Association
        # -------------------------------------------------------------

        /**
         * @var Collection
         * @ORM\OneToMany(targetEntity="App\Entity\Feature\Feature", mappedBy="project")
         */
        protected $features;

        /**
         * @var Collection
         * @ORM\OneToMany(targetEntity="App\Entity\User\User", mappedBy="project")
         */
        protected $users;

        /**
         * @var Tag
         * @ORM\ManyToOne(targetEntity="App\Entity\Project\State", inversedBy="projects")
         */
        protected $state;


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
        #   Code
        # -------------------------------------------------------------

        /**
         * @return null|string
         */
        public function getCode(): ?string
        {
            return $this->code;
        }

        /**
         * @param string $code
         * @return Project
         */
        public function setCode(string $code): self
        {
            $this->code = $code;

            return $this;
        }


        # -------------------------------------------------------------
        #   RealizationPeriod
        # -------------------------------------------------------------

        /**
         * @return int|null
         */
        public function getRealizationPeriod(): ?int
        {
            return $this->realizationPeriod;
        }

        /**
         * @param int $realizationPeriod
         * @return Project
         */
        public function setRealizationPeriod(int $realizationPeriod): self
        {
            $this->realizationPeriod = $realizationPeriod;

            return $this;
        }


        # -------------------------------------------------------------
        #   Features
        # -------------------------------------------------------------

        /**
         * @return Collection
         */
        public function getFeatures()
        {
            return $this->features;
        }

        /**
         * @param Feature $feature
         * @return self
         */
        public function addFeature(Feature $feature): self
        {
            $this->features->add($feature);

            return $this;
        }

        /**
         * @param Collection $features
         * @return self
         */
        public function setFeatures($features): self
        {
            $this->features = $features;

            return $this;
        }


        # -------------------------------------------------------------
        #   Users
        # -------------------------------------------------------------

        /**
         * @return Collection
         */
        public function getUsers()
        {
            return $this->users;
        }

        /**
         * @param User $user
         * @return self
         */
        public function addUser(User $user): self
        {
            $this->users->add($user);

            return $this;
        }

        /**
         * @param Collection $users
         * @return self
         */
        public function setUsers($users): self
        {
            $this->users = $users;

            return $this;
        }
    }
?>