<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Tests\TestApplication\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Tests\TestApplication\Entity\BlogPost;

class FormGroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogPost::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // this field is out of any group on purpose
            IdField::new('id'),
            FormField::addGroup('fields_group')->setIcon('fa fa-cog')->addCssClass('bg-info')
                ->addChildren([
                    TextField::new('title'),
                    TextField::new('slug'),
                ]),
            FormField::addGroup('fieldsets_group')->setIcon('fa fa-user')->addCssClass('bg-warning')
                ->addChildren([
                    FormField::addFieldset('Fieldset 1'),
                    TextField::new('slug'),
                    FormField::addFieldset('Fieldset 2'),
                    TextField::new('content'),
                ]),
            /** TODO: Implement nested grouping */
//            FormField::addGroup('nested_groups_group')->setIcon('fa fa-clock')->addCssClass('bg-warning')
//                ->addChildren([
//                    DateTimeField::new('createdAt'),
//                    FormField::addGroup('inner_group')->setIcon('fa fa-cog')->addCssClass('bg-info')
//                        ->addChildren([
//                            TextField::new('title'),
//                            TextField::new('slug'),
//                        ]),
//                ]),
        ];
    }
}
