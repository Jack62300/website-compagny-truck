<?php

namespace App\Controller\Admin;

use App\Entity\ProductImage;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductImage::class;
    }


    public function configureFields(string $pageName): iterable
    {
            yield ImageField::new('imageName', 'Image procédure')
            ->onlyOnIndex()
            ->setBasePath('/file/procedure');
           yield TextField::new('imageName', 'Name');

           yield NumberField::new('imageSize', 'Size');

           yield DateTimeField::new('updatedAt')
               ->setDisabled();

           yield AssociationField::new('product');
    }

}
