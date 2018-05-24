<?php
    
    namespace App\Entity\Feature;
    
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
    
        public function getId()
        {
            return $this->id;
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
    
        public function getPrice(): ?float
        {
            return $this->price;
        }
    
        public function setPrice(float $price): self
        {
            $this->price = $price;
    
            return $this;
        }
    }
?>