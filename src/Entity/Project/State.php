<?php

    namespace App\Entity\Project;

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
        private $id;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $type;

        public function getId()
        {
            return $this->id;
        }

        public function getType(): ?string
        {
            return $this->type;
        }

        public function setType(string $type): self
        {
            $this->type = $type;

            return $this;
        }
    }
?>