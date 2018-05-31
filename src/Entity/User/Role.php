<?php

    namespace App\Entity\User;

    class Role
    {
        public const ROLES = [
            self::ADMIN => 'Administrateur',
            self::USER => 'Utilisateur'
        ];

        public const ADMIN = 'ROLE_ADMIN';
        public const USER = 'ROLE_USER';
    }
?>
