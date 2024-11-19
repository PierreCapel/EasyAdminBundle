<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Dto;

use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;

/**
 * @author Benjamin Georgeault <git@wedgesama.fr>
 */
interface GroupableDtoInterface
{
    public function getChildren(): ?FieldCollection;

    public function getFqcn(): string;

    public function getParent(): ?GroupableDtoInterface;

    public function setParent(GroupableDtoInterface $parent): void;
}
