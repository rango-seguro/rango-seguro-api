<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Company;
use App\Entity\CompanyBadge;
use App\Entity\Image;
use App\Entity\Link;
use App\Entity\Phone;
use App\Enum\PhoneType;
use App\Enum\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CompanyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @noinspection PhpParamsInspection */
        $company = Company::create()
            ->setName("Churrascaria Brancaleone Ltda")
            ->setTradingName("Churrascaria Los Alpes")
            ->setIdentificationNumber("78270997000197")
            ->setDescription("Rodízio de carnes assadas na brasa, além de saladas e pratos quentes, em salão amplo com decoração rústica.")
            ->setCapacity(20)
            ->setRating(4.5)
            ->setArea(160)
            ->setCustomers(3)
            ->setStatus(Status::ACTIVE())
            ->addCategory($this->getReference(CategoryFixtures::BRAZILIAN_CATEGORY_REFERENCE))
            ->addImage($this->buildImage())
            ->addImage($this->buildImage())
            ->addImage($this->buildImage())
            ->setLogo($this->buildImage())
            ->setAddress($this->buildAddress())
            ->addPhone($this->buildPhone(true))
            ->addPhone($this->buildPhone(false))
            ->addCompanyBadge($this->buildCompanyBadge(0))
            ->addCompanyBadge($this->buildCompanyBadge(1))
            ->addLink($this->buildLink(0))
            ->addLink($this->buildLink(1))
            ->addLink($this->buildLink(2));

        $manager->persist($company);
        $manager->flush();
    }

    private function buildLink(int $id): Link
    {
        switch ($id) {
            case 0:
                /** @noinspection PhpParamsInspection */
                $link = Link::create()
                    ->setPlatform($this->getReference(PlatformFixtures::I_FOOD_PLATFORM_REFERENCE))
                    ->setPath("delivery/sao-paulo-sp/burger-king-cambuci");
                break;
            case 1:
                /** @noinspection PhpParamsInspection */
                $link = Link::create()
                    ->setPlatform($this->getReference(PlatformFixtures::UBER_EATS_PLATFORM_REFERENCE))
                    ->setPath("br/krakow/food-delivery/city-kebab-podgorze/d9WaIK9bTxa8nm4rpOPO2g");
                break;
            default:
                /** @noinspection PhpParamsInspection */
                $link = Link::create()
                    ->setPlatform($this->getReference(PlatformFixtures::WHATS_APP_PLATFORM_REFERENCE))
                    ->setPath("send?phone=5577988010666");
        }

        return $link;
    }

    private function buildCompanyBadge(int $id): CompanyBadge
    {
        switch ($id) {
            case 0:
                /** @noinspection PhpParamsInspection */
                $companyBadge = CompanyBadge::create()
                    ->setBadge($this->getReference(BadgeFixtures::TRANSPARENCY_BADGE_REFERENCE))
                    ->setLevel($this->getReference(BadgeFixtures::TRANSPARENCY_LEVEL_REFERENCE));
                break;
            default:
                /** @noinspection PhpParamsInspection */
                $companyBadge = CompanyBadge::create()
                    ->setBadge($this->getReference(BadgeFixtures::SINK_BADGE_REFERENCE))
                    ->setLevel($this->getReference(BadgeFixtures::SINK_LEVEL_REFERENCE));
        }

        return $companyBadge;
    }

    private function buildPhone(bool $isMobile): Phone
    {
        $phone = Phone::create()
            ->setPhoneType($isMobile ? PhoneType::MOBILE() : PhoneType::LANDLINE())
            ->setNumber($isMobile ? "5577988010666" : "557734010666");

        return $phone;
    }

    private function buildAddress(): Address
    {
        $address = Address::create()
            ->setCountry("Brasil")
            ->setState("BA")
            ->setCity("Vitória da Conquista")
            ->setNeighborhood("Bela Vista")
            ->setStreet("Av. Juracy Magalhães")
            ->setBuildingNumber("2982")
            ->setZipCode("45023490")
            ->setLatitude(-14.885760)
            ->setLongitude(-40.844570);

        return $address;
    }

    private function buildImage(): Image
    {
        $path = sprintf('/tmp/%s', uniqid());
        $filename = 'https://picsum.photos/300/150';
        copy($filename, $path);

        $file = new UploadedFile($path, $filename, null, null, true);
        return Image::create()->setFile($file);
    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
            BadgeFixtures::class,
            PlatformFixtures::class
        );
    }
}
