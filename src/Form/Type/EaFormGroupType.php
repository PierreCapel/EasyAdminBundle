<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Benjamin Georgeault <git@wedgesama.fr>
 */
class EaFormGroupType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'inherit_data' => true,
            'mapped' => false,
            'label' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'ea_form_group';
    }

    public function getParent(): string
    {
        return CrudFormType::class;
    }
}
