<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Tests\Controller;

use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Test\AbstractCrudTestCase;
use EasyCorp\Bundle\EasyAdminBundle\Tests\TestApplication\Controller\DashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Tests\TestApplication\Controller\FormGroupCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Tests\TestApplication\Entity\BlogPost;

class FormGroupCrudControllerTest extends AbstractCrudTestCase
{
    protected EntityRepository $blogPosts;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client->followRedirects();

        $this->blogPosts = $this->entityManager->getRepository(BlogPost::class);
    }

    protected function getControllerFqcn(): string
    {
        return FormGroupCrudController::class;
    }

    protected function getDashboardFqcn(): string
    {
        return DashboardController::class;
    }


    public function testFieldsInsideGroupsInForms()
    {
        $crawler = $this->client->request('GET', $this->generateNewFormUrl());

        $fieldsGroupElements = $crawler->filter('label[for*="fields_group"]')->each(function ($node) {
            return $node->text();
        });

        $fieldsetGroupElements = $crawler->filter('label[for*="fieldsets_group"]')->each(function ($node) {
            return $node->text();
        });



        static::assertCount(2, $fieldsGroupElements);
        static::assertContains("Title", $fieldsGroupElements);
        static::assertContains("Slug", $fieldsGroupElements);

        static::assertCount(2, $fieldsetGroupElements);
        static::assertContains("Slug", $fieldsetGroupElements);
        static::assertContains("Content", $fieldsetGroupElements);
    }
}
