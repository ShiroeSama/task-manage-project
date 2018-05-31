<?php

    namespace App\Controller;

    use App\Entity\User\User;
    use App\Service\User\RoleService;
    use SensioLabs\Security\Exception\HttpException;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Form\FormInterface;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * Class AbstractController
     * @package App\Controller
     */
    abstract class AbstractController extends Controller
    {
        /** @var RoleService */
        protected $roleService;


        /**
         * @param string $role
         * @param User $user
         * @return bool
         */
        public function isAuthorized(string $role, User $user): bool
        {
            if (is_null($this->roleService)) {
                throw new HttpException(__METHOD__ . ' : Role Service is not defined for ' . static::class, Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->roleService->isGranted($role, $user);
        }

        /**
         * @return bool
         */
        public function isLogged(): bool
        {
            if (is_null($this->roleService)) {
                throw new HttpException(__METHOD__ . ' : Role Service is not defined for ' . static::class, Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->roleService->isLogged($this->getUser());
        }

        /**
         * @param FormInterface $form
         * @return array
         */
        public function getFormErrors(FormInterface $form): array
        {
            $errors = [];

            if ($form->getErrors(true)->valid()) {
                for ($i = 0; $i < $form->getErrors(true)->count(); $i++) {
                    array_push($errors, $form->getErrors(true)[$i]->getMessage());
                }
            }

            return $errors;
        }

        /**
         * @param Request $request
         * @param FormInterface $form
         * @return bool
         */
        public function isPostRequest(Request $request, FormInterface $form): bool
        {
            return $request->isMethod('POST') && $form->isSubmitted() && $form->isValid();
        }
    }
?>