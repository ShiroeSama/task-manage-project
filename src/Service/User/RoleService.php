<?php

    namespace App\Service\User;

    use App\Entity\User\User;
    use Symfony\Component\Security\Core\Role\Role;
    use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;

    class RoleService
    {
        protected $roleHierarchy;

        /**
         * Constructor
         *
         * @param RoleHierarchyInterface $roleHierarchy
         */
        public function __construct(RoleHierarchyInterface $roleHierarchy)
        {
            $this->roleHierarchy = $roleHierarchy;
        }


        /**
         * isLogged
         *
         * @param $user
         *
         * @return bool
         */
        public function isLogged(?User $user)
        {
            if (!is_null($user)) {
                if($this->isGranted(\App\Entity\User\Role::ADMIN, $user) or $this->isGranted(\App\Entity\User\Role::TEAM, $user)) {
                    return true;
                }
            }

            return false;
        }

        /**
         * isGranted
         *
         * @param string $role
         * @param User $user
         *
         * @return bool
         */
        public function isGranted(string $role, User $user)
        {
            $role = new Role($role);

            foreach($user->getRoles() as $userRole) {
                if (in_array($role, $this->roleHierarchy->getReachableRoles(array(new Role($userRole)))))
                    return true;
            }

            return false;
        }
    }
?>