<?php

    namespace App\Entity\Task;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\Task\TagRepository")
     */
    class Tag
    {
        /**
         * @ORM\Id()
         * @ORM\GeneratedValue()
         * @ORM\Column(type="integer")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $type;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $color;


        # -------------------------------------------------------------
        #   Association
        # -------------------------------------------------------------

        /**
         * @var Collection
         * @ORM\OneToMany(targetEntity="App\Entity\Task\Task", mappedBy="tag")
         */
        protected $tasks;


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
         * @return Tag
         */
        public function setType(string $type): self
        {
            $this->type = $type;

            return $this;
        }


        # -------------------------------------------------------------
        #   Color
        # -------------------------------------------------------------

        /**
         * @return null|string
         */
        public function getColor(): ?string
        {
            return $this->color;
        }

        /**
         * @param string $color
         * @return Tag
         */
        public function setColor(string $color): self
        {
            $this->color = $color;

            return $this;
        }



        # -------------------------------------------------------------
        #   Tasks
        # -------------------------------------------------------------

        /**
         * @return Collection
         */
        public function getTasks()
        {
            return $this->tasks;
        }

        /**
         * @param Task $task
         * @return self
         */
        public function addTask(Task $task): self
        {
            $this->tasks->add($task);

            return $this;
        }

        /**
         * @param Collection $tasks
         */
        public function setTasks(Collection $tasks)
        {
            $this->tasks = $tasks;
        }
    }
?>