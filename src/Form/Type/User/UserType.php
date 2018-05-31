<?php

    namespace App\Form\Type\User;

    use App\Entity\Team\Team;
    use App\Entity\User\Role;
    use App\Form\Check\User\UserCheck;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class UserType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $edit = $options['edit'];
            $buttonId = 'edit';
            $buttonName = 'Valider';

            if (!$edit) {
                $buttonId = 'create';
                $buttonName = 'Créer';

                $builder
                    ->add(UserCheck::PARAM_LASTNAME,
                        TextType::class,
                        [
                            'label'      => 'Nom :',
                            'label_attr' => ['class' => 'mt-5'],
                            'required'   => true
                        ])
                    ->add(UserCheck::PARAM_FIRSTNAME,
                        TextType::class,
                        [
                            'label'      => 'Prénom :',
                            'label_attr' => ['class' => 'mt-5'],
                            'required'   => true
                        ])
                    ->add(UserCheck::PARAM_EMAIL,
                        EmailType::class,
                        [
                            'label'      => 'Email :',
                            'label_attr' => ['class' => 'mt-5'],
                            'required'   => true
                        ])
                    ->add(UserCheck::PARAM_PASSWORD,
                        RepeatedType::class,
                        [
                            'type'            => PasswordType::class,
                            'first_options'   => [
                                'label'      => 'Mot de Passe :',
                                'label_attr' => ['class' => 'mt-5'],
                                'required'   => true
                            ],
                            'second_options'  => [
                                'label'      => 'Confirmation du Mot de Passe :',
                                'label_attr' => ['class' => 'mt-5'],
                                'required'   => true
                            ],
                            'invalid_message' => 'Les mots de passe doivent correspondre.'
                        ])
                ;
            }

            $builder
                ->add(UserCheck::PARAM_ROLE,
                    ChoiceType::class,
                    [
                        'choices'    => array_flip(Role::ROLES),
                        'label'      => 'Rôle :',
                        'label_attr' => ['class' => 'mt-5'],
                        'attr'       => ['class' => 'w-100'],
                        'multiple'   => false,
                        'expanded'   => false,
                        'required'   => false,
                    ])
                ->add(UserCheck::PARAM_TEAM,
                    EntityType::class,
                    [
                        'label'        => 'Team :',
                        'label_attr'   => ['class' => 'mt-5'],
                        'attr'         => ['class' => 'w-100'],
                        'class'        => Team::class,
                        'choice_label' => 'name',
                        'multiple'     => false,
                        'expanded'     => false,
                        'required'     => false,
                    ])
            ;

            $builder->add($buttonId,
                SubmitType::class,
                [
                    'label'      => $buttonName,
                    'attr'       => ['class' => 'btn btn-primary d-block mt-2 mx-auto']
                ]);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => NULL,
                'edit'       => false
            ]);
        }
    }
?>