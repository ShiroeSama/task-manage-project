<?php

    namespace App\Command;

    use App\Entity\User\Role;
    use App\Entity\User\User;
    use App\Service\User\UserService;
    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputArgument;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;
    use Symfony\Component\Console\Question\Question;

    /**
     * Class CreateAdminCommand
     * @package App\Command
     */
    class CreateAdminCommand extends Command
    {
        /** @var UserService */
        private $userService;

        public function __construct(UserService $userService)
        {
            parent::__construct();
            $this->userService = $userService;
        }


        protected function configure()
        {
            $this->setName('app:admin:create')
                ->setDescription('Create new admin')
                ->setDefinition([
                    new InputArgument('username', InputArgument::REQUIRED, 'Username of User'),
                    new InputArgument('password', InputArgument::REQUIRED, 'Password of User'),
                ]);
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $user = [
                'username'  => $input->getArgument('username'),
                'password'  => $input->getArgument('password'),
                'role'      => Role::ADMIN
            ];

            $this->userService->create($user);

            $output->writeln('Admin Created');
        }

        protected function interact(InputInterface $input, OutputInterface $output)
        {
            $output->writeln([
                'Admin Creator',
                '========================',
                '',
            ]);

            $questions = [];
            if (!$input->getArgument('username')) {
                $question = new Question('Username (Login to connect) : ');
                $question->setValidator(function ($username) {
                    if (empty($username)) {
                        throw new \Exception('Username can not be empty');
                    }
                    return $username;
                });
                $questions['username'] = $question;
            }
            if (!$input->getArgument('password')) {
                $question = new Question('Password : ');
                $question->setValidator(function ($password) {
                    if (empty($password)) {
                        throw new \Exception('Password can not be empty');
                    }
                    return $password;
                });
                $question->setHidden(true);
                $questions['password'] = $question;
            }

            foreach ($questions as $name => $question) {
                $answer = $this->getHelper('question')
                    ->ask($input, $output, $question);
                $input->setArgument($name, $answer);
            }
        }
    }
?>