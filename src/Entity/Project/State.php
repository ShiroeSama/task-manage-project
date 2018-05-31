<?php

    namespace App\Entity\Project;

    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\Project\StateRepository")
     */
    class State
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
        protected $type;


        # -------------------------------------------------------------
        #   Association
        # -------------------------------------------------------------

        /**
         * @var Collection
         * @ORM\OneToMany(targetEntity="App\Entity\Project\Project", mappedBy="state")
         */
        protected $projects;


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
        #   Type
        # -------------------------------------------------------------

        /**
         * @return null|string
         */
        public function getType(): ?string
        {
            return $this->type;
        }

        /**
         * @param string $type
         * @return State
         */
        public function setType(string $type): self
        {
            $this->type = $type;

            return $this;
        }


        # -------------------------------------------------------------
        #   Projects
        # -------------------------------------------------------------

        /**
         * @return Collection
         */
        public function getProjects()
        {
            return $this->projects;
        }

        /**
         * @param Project $project
         * @return self
         */
        public function addProject(Project $project): self
        {
            $this->projects->add($project);

            return $this;
        }

        /**
         * @param Collection $projects
         * @return self
         */
        public function setProjects(Collection $projects): self
        {
            $this->projects = $projects;

            return $this;
        }
    }
?>