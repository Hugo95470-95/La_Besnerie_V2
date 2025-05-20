<?php

// namespace App\Controller\Admin;

// use App\Entity\Product;
// use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
// use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

// class ProductCrudController extends AbstractCrudController
// {
//     public static function getEntityFqcn(): string
//     {
//         return Product::class;
//     }

//     /*
//     public function configureFields(string $pageName): iterable
//     {
//         return [
//             IdField::new('id'),
//             TextField::new('title'),
//             TextEditorField::new('description'),
//         ];
//     }
//     */
// }




namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;


class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name'),
            TextareaField::new('Description'),
            TextField::new('Price'),
            TextField::new('Category'),
            ImageField::new('Image_main')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}