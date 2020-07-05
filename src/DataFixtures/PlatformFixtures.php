<?php

namespace App\DataFixtures;

use App\Entity\Platform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class PlatformFixtures extends Fixture
{
    public const WHATS_APP_PLATFORM_REFERENCE = 'what-sapp-platform';
    public const I_FOOD_PLATFORM_REFERENCE = 'i-food-platform';
    public const UBER_EATS_PLATFORM_REFERENCE = 'uber-eats-platform';

    public function load(ObjectManager $manager)
    {
        $whatsApp = Platform::create()
            ->setIcon("fa fa-whatsapp")
            ->setName("WhatsApp")
            ->setDomain("https://api.whatsapp.com/");
        $manager->persist($whatsApp);

        $iFood = Platform::create()
            ->setIcon("fa fa-ifood")
            ->setName("iFood")
            ->setDomain("https://www.ifood.com.br/");
        $manager->persist($iFood);

        $uberEats = Platform::create()
            ->setIcon("fa fa-uber")
            ->setName("Uber Eats")
            ->setDomain("https://www.ubereats.com/");
        $manager->persist($uberEats);

        $manager->flush();

        $this->addReference(self::WHATS_APP_PLATFORM_REFERENCE, $whatsApp);
        $this->addReference(self::I_FOOD_PLATFORM_REFERENCE, $iFood);
        $this->addReference(self::UBER_EATS_PLATFORM_REFERENCE, $uberEats);
    }
}