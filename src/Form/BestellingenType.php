<?php

namespace App\Form;

use App\Entity\Bestellingen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestellingenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Aantal')
            ->add('Gereserveerd')
            ->add('Reservering_Id')
            ->add('Menuitem_Id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bestellingen::class,
        ]);
    }
}
