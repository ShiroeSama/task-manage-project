<?php

    namespace App\Service\User;

    use App\Entity\User\User;
    use App\Entity\User\Role;
    use App\Form\Check\User\UserCheck;
    use App\Repository\User\UserRepository;
    use App\Service\Utils\Exception\ExceptionHandlerService;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

    /**
     * Class UserService
     * @package App\Service\User
     */
    class UserService
    {
        /** @var EntityManagerInterface */
        protected $em;

        /** @var UserRepository */
        protected $repository;

        /** @var UserPasswordEncoderInterface */
        protected $encoder;

        /** @var UserCheck */
        protected $check;

        /** @var ExceptionHandlerService */
        protected $exceptionHandlerService;

        /**
         * UserService constructor.
         * @param EntityManagerInterface $em
         * @param UserPasswordEncoderInterface $encoder
         * @param UserCheck $check
         * @param ExceptionHandlerService $exceptionHandlerService
         */
        public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, UserCheck $check, ExceptionHandlerService $exceptionHandlerService)
        {
            $this->em = $em;
            $this->repository = $em->getRepository(User::class);

            $this->encoder = $encoder;
            $this->check = $check;
            $this->exceptionHandlerService = $exceptionHandlerService;
        }

        /**
         * @param User $user
         * @return User
         */
        protected function persist(User $user)
        {
            try {
                $this->em->persist($user);
                $this->em->flush();
            } catch (\Throwable $throwable) {
                $this->exceptionHandlerService->treatment($throwable);
            }

            return $user;
        }

        /**
         * @return array
         */
        public function getFormErrors(): array
        {
            return $this->check->getErrors();
        }

        /**
         * @param Team $team
         * @param array $datas
         *
         * @return User
         */
        public function create(array $datas): User
        {
            $this->check->create($datas);

            if (!$this->check->isValid()) {
                throw new BadRequestHttpException('Some parameters are missing');
            }

            $username = $datas[UserCheck::PARAM_USERNAME];
            $user = $this->repository->findBy([UserCheck::PARAM_USERNAME => $username]);

            if ($user) {
                throw new HttpException(Response::HTTP_CONFLICT, 'This account exit');
            }

            $user = new User();
            $user
                ->setUsername($datas[UserCheck::PARAM_USERNAME])
                ->setPlainPassword($datas[UserCheck::PARAM_PASSWORD])
                ->setRole($datas[UserCheck::PARAM_ROLE])
            ;

            return $this->persist($user);
        }

        /**
         * @param User $user
         * @param array $datas
         *
         * @return User
         */
        public function edit(User $user, array $datas): User
        {
            if (array_key_exists(UserCheck::PARAM_ROLE, $datas)) {
                if (!is_null($datas[UserCheck::PARAM_ROLE])) {
                    $user
                        ->setRole($datas[UserCheck::PARAM_ROLE])
                        ->setUpdatedAt(time())
                    ;
                }
            }

            if (array_key_exists(UserCheck::PARAM_PASSWORD, $datas)
                && array_key_exists(UserCheck::PARAM_OLD_PASSWORD, $datas)
            ) {
                if (!is_null($datas[UserCheck::PARAM_PASSWORD])
                    && !is_null($datas[UserCheck::PARAM_OLD_PASSWORD])
                ) {
                    $oldPassword = $datas[UserCheck::PARAM_OLD_PASSWORD];
                    $password = $datas[UserCheck::PARAM_PASSWORD];

                    if ($this->encoder->isPasswordValid($user, $oldPassword)) {
                        $user
                            ->setPlainPassword($password)
                            ->setUpdatedAt(time())
                        ;
                    } else {
                        throw new BadRequestHttpException('Bad parameters');
                    }
                }
            }

            try {
                $this->em->flush();
            } catch (\Throwable $throwable) {
                $this->exceptionHandlerService->treatment($throwable);
            }

            return $user;
        }


        /**
         * @param User $user
         */
        public function delete(User $user)
        {
            try {
                $this->em->remove($user);
                $this->em->flush();
            } catch (\Throwable $throwable) {
                $this->exceptionHandlerService->treatment($throwable);
            }
        }
    }

?>