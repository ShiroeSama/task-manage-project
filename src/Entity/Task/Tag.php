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

        public function getColor(): ?string
        {
            return $this->color;
        }

        public function setColor(string $color): self
        {
            $this->color = $color;

            return $this;
        }
    }
?>