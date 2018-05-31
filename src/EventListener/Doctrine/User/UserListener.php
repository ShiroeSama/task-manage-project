<?php

    namespace App\EventListener\Doctrine\User;

    use App\Entity\User\User;
    use Doctrine\ORM\Event\LifecycleEventArgs;
    use Doctrine\ORM\Event\PreUpdateEventArgs;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

    class UserListener
    {
        /** @var UserPasswordEncoderInterface */
        private $encoder;

        public function __construct(UserPasswordEncoderInterface $encoder)
        {
            $this->encoder = $encoder;
        }

        /**
         * Set user id
         * @param User $user
         * @param LifecycleEventArgs $args
         */
        public function prePersist(User $user, LifecycleEventArgs $args)
        {
            $user->setCreatedAt(time());
            if ($user->getPlainPassword()) {
                $encodedPass = $this->encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($encodedPass);
            }
        }

        /**
         * @param User $user
         * @param PreUpdateEventArgs $args
         */
        public function preUpdate(User $user, PreUpdateEventArgs $args)
        {
            if ($user->getPlainPassword()) {
                $encodedPass = $this->encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($encodedPass);
            }
        }
    }
?>