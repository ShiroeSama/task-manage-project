<?php

    namespace App\Entity\Project;

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

        public function getId()
        {
            return $this->id;
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

        public function getRealizationPeriod(): ?int
        {
            return $this->realizationPeriod;
        }

        public function setRealizationPeriod(int $realizationPeriod): self
        {
            $this->realizationPeriod = $realizationPeriod;

            return $this;
        }
    }
?>