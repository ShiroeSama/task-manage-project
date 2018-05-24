<?php

    namespace App\Entity\Task;

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

        public function getId()
        {
            return $this->id;
        }

        public function getRealizationPeriod(): ?int
        {
            return $this->realizationPeriod;
        }

        public function setRealizationPeriod(int $realizationPeriod): self
        {
            $this->realizationPeriod = $realizationPeriod;

            return $this;
        }

        public function getTitle(): ?string
        {
            return $this->title;
        }

        public function setTitle(string $title): self
        {
            $this->title = $title;

            return $this;
        }

        public function getCode(): ?string
        {
            return $this->code;
        }

        public function setCode(string $code): self
        {
            $this->code = $code;

            return $this;
        }
    }
?>
