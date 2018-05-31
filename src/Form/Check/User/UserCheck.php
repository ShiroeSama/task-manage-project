<?php

    namespace App\Form\Check\User;

    use App\Form\Check\AbstractCheck;

    class UserCheck extends AbstractCheck
    {
        public const PARAM_USERNAME = 'username';
        public const PARAM_PASSWORD = 'password';
        public const PARAM_OLD_PASSWORD = 'old_password';
        public const PARAM_ROLE = 'role';

        /**
         * @param array $datas
         */
        public function create(array $datas)
        {
            $this->errors = [];

            if (empty($datas)) {
                array_push($this->errors, "Des champs sont manquants");
            }

            // USERNAME
            if (!array_key_exists(self::PARAM_USERNAME, $datas)) {
                array_push($this->errors, "Le champ 'Username' ne peut pas être vide");
            } else {
                if (is_null($datas[self::PARAM_USERNAME])) {
                    array_push($this->errors, "Le champ 'Username' ne peut pas être vide");
                }
            }

            // PASSWORD
            if (!array_key_exists(self::PARAM_PASSWORD, $datas)) {
                array_push($this->errors, "Le champ 'Mot de passe' ne peut pas être vide");
            } else {
                if (is_null($datas[self::PARAM_PASSWORD])) {
                    array_push($this->errors, "Le champ 'Mot de passe' ne peut pas être vide");
                }
            }

            // ROLE
            if (!array_key_exists(self::PARAM_ROLE, $datas)) {
                array_push($this->errors, "Le champ 'Rôle' doit être renseigné");
            } else {
                if (empty($datas[self::PARAM_ROLE])) {
                    array_push($this->errors, "Le champ 'Rôle' ne peut pas être vide");
                }
            }
        }
    }
?>