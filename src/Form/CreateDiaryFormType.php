<?php

namespace App\Form;

use App\Entity\Diary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateDiaryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Tipocontacto', ChoiceType::class, [
                'choices' => array_combine(
                    ['Personal', 'Professional'],
                    Diary::ALLOWED_CONTACT_TYPE
                )
            ])
            ->add('name', TextType::class)
            ->add('lastName', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary text-bold']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Diary::class,
        ]);
    }
}
