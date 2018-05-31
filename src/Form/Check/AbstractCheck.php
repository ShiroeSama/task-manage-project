<?php

    namespace App\Form\Check;

    abstract class AbstractCheck
    {
        /** @var array */
        protected $errors;

        /**
         * TeamCheck constructor.
         */
        public function __construct()
        {
            $this->errors = [];
        }

        /**
         * @param array $array
         * @param string $element
         * @return bool
         */
        protected function arrayContains(array $array, string $element)
        {
            foreach ($array as $key => $value) {
                if (strstr($key, $element) || $key == $element) {
                    return true;
                    break;
                }
            }
            return false;
        }

        /**
         * @return bool
         */
        public function isValid(): bool
        {
            return empty($this->errors);
        }

        /**
         * @return array
         */
        public function getErrors(): array
        {
            return $this->errors;
        }
    }
?>