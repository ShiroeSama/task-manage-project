<?php
    
    namespace App\Entity\Feature;
    
    use App\Entity\Project\Project;
    use App\Entity\Task\Task;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    
    /**
     * @ORM\Entity(repositoryClass="App\Repository\Feature\FeatureRepository")
     */
    class Feature
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
        protected $title;
    
        /**
         * @ORM\Column(type="float")
         */
        protected $price;


        # -------------------------------------------------------------
        #   Association
        # -------------------------------------------------------------

        /**
         * @var Project
         * @ORM\ManyToOne(targetEntity="App\Entity\Project\Project", inversedBy="features")
         */
        protected $project;

        /**
         * @var Collection
         * @ORM\OneToMany(targetEntity="App\Entity\Task\Task", mappedBy="feature")
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
        #   Title
        # -------------------------------------------------------------

        /**
         * @return null|string
         */
        public function getTitle(): ?string
        {
            return $this->title;
        }

        /**
         * @param string $title
         * @return Feature
         */
        public function setTitle(string $title): self
        {
            $this->title = $title;
    
            return $this;
        }


        # -------------------------------------------------------------
        #   Price
        # -------------------------------------------------------------

        /**
         * @return float|null
         */
        public function getPrice(): ?float
        {
            return $this->price;
        }

        /**
         * @param float $price
         * @return Feature
         */
        public function setPrice(float $price): self
        {
            $this->price = $price;
    
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
         * @return self
         */
        public function setProject(Project $project): self
        {
            $this->project = $project;

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