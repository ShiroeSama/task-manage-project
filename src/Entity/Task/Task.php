<?php

    namespace App\Entity\Task;

    use App\Entity\Feature\Feature;
use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\Task\TaskRepository")
     */
    class Task
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
         * @ORM\Column(type="integer")
         */
        protected $realizationPeriod;

        /**
         * @ORM\Column(type="string", length=255)
         */
        protected $code;


        # -------------------------------------------------------------
        #   Association
        # -------------------------------------------------------------

        /**
         * @var Feature
         * @ORM\ManyToOne(targetEntity="App\Entity\Feature\Feature", inversedBy="tasks")
         */
        protected $feature;

        /**
         * @var Tag
         * @ORM\ManyToOne(targetEntity="App\Entity\Task\Tag", inversedBy="tasks")
         */
        protected $tag;


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
        #   Realization Period
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
         * @return Task
         */
        public function setRealizationPeriod(int $realizationPeriod): self
        {
            $this->realizationPeriod = $realizationPeriod;

            return $this;
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
         * @return Task
         */
        public function setTitle(string $title): self
        {
            $this->title = $title;

            return $this;
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
         * @return Task
         */
        public function setCode(string $code): self
        {
            $this->code = $code;

            return $this;
        }


        # -------------------------------------------------------------
        #   Feature
        # -------------------------------------------------------------

        /**
         * @return Feature
         */
        public function getFeature()
        {
            return $this->feature;
        }

        /**
         * @param Feature $feature
         * @return self
         */
        public function setFeature($feature): self
        {
            $this->feature = $feature;

            return $this;
        }


        # -------------------------------------------------------------
        #   Tag
        # -------------------------------------------------------------

        /**
         * @return Tag
         */
        public function getTag()
        {
            return $this->tag;
        }

        /**
         * @param Tag $tag
         */
        public function setTag($tag)
        {
            $this->tag = $tag;
        }
    }
?>
