<?php

namespace App\Form;

use App\Entity\Reserveringen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserveringenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Tafel')
            ->add('Datum')
            ->add('Tijd')
            ->add('Aantal')
            ->add('Status')
            ->add('Allergien')
            ->add('Opmerkingen')
            ->add('DatumToegevoegd')
            ->add('Klant_Id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserveringen::class,
        ]);
    }
}
