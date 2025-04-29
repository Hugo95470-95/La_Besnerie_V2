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

// use App\Entity\Produit;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
// use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


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
            // ImageField::new('Image_supp')
            //     ->setBasePath('uploads/images')
            //     ->setUploadDir('public/uploads/images')
            //     ->setUploadedFileNamePattern('[randomhash].[extension]')
            //     ->setRequired(false),
        ];

        // return [
        //     // configuration champs nom, description, prix, image et categorie
        //     TextField::new('nom', 'Nom du produit'),
        //     TextField::new('description', 'Description du produit'),
        //     TextField::new('prix', 'Prix du produit'),
        //     // Upload d'une image
        //     ImageField::new('image', 'Image')
        //         ->setUploadDir('public/images/produits')
        //         ->setBasePath('uploads/images')
        //         ->setRequired(false),
        //         // Ajout champs pour la clé étrangère categorie_id
        //     AssociationField::new('categorie', 'Catégorie du produit')
        //         // ->setCrudController(CategorieCrudController::class),
        //     IntegerField::new('stock', 'Stock du produit'),
        // ];
    }
}