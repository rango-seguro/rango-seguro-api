<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class CategoryFixtures extends Fixture
{
    public const BRAZILIAN_CATEGORY_REFERENCE = 'brazilian-category';
    public const ITALIAN_CATEGORY_REFERENCE = 'italian-category';
    public const PIZZA_CATEGORY_REFERENCE = 'pizza-category';

    public function load(ObjectManager $manager)
    {
        $brazilian = Category::create()
            ->setName("Brasileira")
            ->setImage($this->buildImage());
        $manager->persist($brazilian);

        $japanese = Category::create()
            ->setName("Japonesa")
            ->setImage($this->buildImage());
        $manager->persist($japanese);

        $italian = Category::create()
            ->setName("Italiana")
            ->setImage($this->buildImage());
        $manager->persist($italian);

        $pizza = Category::create()
            ->setName("Pizza")
            ->setImage($this->buildImage());
        $manager->persist($pizza);

        $manager->flush();

        $this->addReference(self::BRAZILIAN_CATEGORY_REFERENCE, $brazilian);
        $this->addReference(self::ITALIAN_CATEGORY_REFERENCE, $italian);
        $this->addReference(self::PIZZA_CATEGORY_REFERENCE, $pizza);
    }

    private function buildImage(): Image
    {
        $path = sprintf('/tmp/%s', uniqid());
        $filename = 'https://picsum.photos/300/150';
        copy($filename, $path);

        $file = new UploadedFile($path, $filename, null, null, true);
        $image = Image::create()->setFile($file);

        return $image;
    }
}