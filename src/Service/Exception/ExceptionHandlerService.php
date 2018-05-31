<?php

    namespace App\Service\Exception;

    use Doctrine\DBAL\DBALException;
    use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
    use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
    use Doctrine\ORM\ORMInvalidArgumentException;
    use Psr\Log\LoggerInterface;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
    use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


    /**
     * Class ExceptionHandlerService
     * @package App\Service\Exception
     */
    class ExceptionHandlerService {

        /** @var LoggerInterface */
        protected $logger;

        /** @var Throwable */
        protected $throwable;


        /**
         * ExceptionHandlerService constructor.
         * @param LoggerInterface $logger
         */
        public function __construct(LoggerInterface $logger)
        {
            $this->logger = $logger;
        }

        /**
         * @param \Throwable $throwable
         */
        public function log(\Throwable $throwable)
        {
            $this->logger->error('-------------------------------------');
            $this->logger->error(get_class($throwable));
            $this->logger->error($throwable->getMessage());
            $this->logger->error($throwable->getTraceAsString());
            $this->logger->error('-------------------------------------');
        }


        /**
         * Permet de gerer le block d'exception des services
         * @param \Throwable $throwable
         */
        public function treatment(\Throwable $throwable)
        {
            $this->log($throwable);

            switch (get_class($throwable)) {
                case UniqueConstraintViolationException::class:
                    $this->treatmentConflict($throwable);
                    break;

                case DBALException::class:
                    $this->treatmentDBAL($throwable);
                    break;

                case NotNullConstraintViolationException::class:
                case ORMInvalidArgumentException::class:
                case \UnexpectedValueException::class:
                    $this->treatmentORM($throwable);
                    break;

                default:
                    $this->treatmentDefault($throwable);
                    break;
            }
        }

        /**
         * @param \Throwable $throwable
         * @throws \Throwable
         */
        protected function treatmentDefault(\Throwable $throwable)
        {
            throw $throwable;
        }

        /**
         * @param \Throwable $throwable
         * @throws BadRequestHttpException
         */
        protected function treatmentORM(\Throwable $throwable)
        {
            throw new BadRequestHttpException("Entity's treatment error", $throwable);
        }

        /**
         * @param UniqueConstraintViolationException $exception
         * @throws ConflictHttpException
         */
        protected function treatmentConflict(UniqueConstraintViolationException $exception, $message = null)
        {
            $this->logger->error($exception->getPrevious()->getCode());
            throw new ConflictHttpException($message ?? "Conflict error");
        }

        /**
         * @throws BadRequestHttpException
         * @throws ConflictHttpException
         */
        protected function treatmentDBAL(DBALException $throwable)
        {
            switch ($throwable->getPrevious()->getCode()) {
                case '23000' :
                    $this->treatmentConflict($throwable);
                    break;
                case '42000' :
                    throw new BadRequestHttpException("Database error");
                case '21000' :
                    throw new BadRequestHttpException("Database request error");
                case '21S01' :
                    throw new BadRequestHttpException("Database schema error (Missing property)");
                case '42S02' :
                    throw new BadRequestHttpException("Missing database table");
            }
            $this->treatmentORM($throwable);
        }
    }
?>