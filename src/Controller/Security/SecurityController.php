<?php

    namespace App\Controller\Security;

    use App\Controller\AbstractController;
    use App\Entity\User\Role;
    use App\Entity\User\User;
    use App\Service\User\RoleService;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    /**
     * Class SecurityController
     * @package App\Controller\Security
     *
     * @Route("/")
     */
    class SecurityController extends AbstractController
    {
        /** @var UserService */
        protected $userService;

        /**
         * SecurityController constructor.
         * @param RoleService $roleService
         */
        public function __construct(RoleService $roleService)
        {
            $this->roleService = $roleService;
        }

        /**
         * @return RedirectResponse
         */
        protected function redirectIfIsLogged(): RedirectResponse
        {
            /** @var User $user */
            $user = $this->getUser();

            if ($this->isAuthorized(Role::ADMIN, $user)) {
                return $this->redirectToRoute('bo_index');
            } else {
                return $this->redirectToRoute('app_index');
            }
        }


        /**
         * @Route("/login", name="login")
         *
         * @param Request $request
         * @param AuthenticationUtils $authUtils
         * @param SessionInterface $session
         *
         * @return Response
         */
        public function login(Request $request, AuthenticationUtils $authUtils, SessionInterface $session): Response
        {
            if ($this->isLogged()) {
                return $this->redirectIfIsLogged();
            }

            $error = $authUtils->getLastAuthenticationError();
            $lastLogin = $authUtils->getLastUsername();

            $var = compact('error', 'lastLogin');
            return $this->render('Security/login.html.twig', $var);
        }
    }
?>