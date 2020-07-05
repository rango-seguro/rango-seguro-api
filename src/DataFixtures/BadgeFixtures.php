<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class BadgeFixtures extends Fixture
{
    public const PPE_BADGE_REFERENCE = 'ppe-badge';
    public const TRANSPARENCY_BADGE_REFERENCE = 'transparency-badge';
    public const SINK_BADGE_REFERENCE = 'sink-badge';

    public const PPE_LEVEL_REFERENCE = 'ppe-level';
    public const TRANSPARENCY_LEVEL_REFERENCE = 'transparency-level';
    public const SINK_LEVEL_REFERENCE = 'sink-level';

    public function load(ObjectManager $manager)
    {
        $ppe = Badge::create()
            ->setName("Uso de EPIs")
            ->setIcon("fa fa-mask")
            ->setQuestion("Os funcionários dessa empresa utilizam equipamentos de proteção individual?")
            ->addLevel($this->buildLevel(0))
            ->addLevel($this->buildLevel(1))
            ->setScore(15); //TODO: Avoid to set score manually
        $manager->persist($ppe);

        $distancing = Badge::create()
            ->setName("Distanciamento entre mesas")
            ->setIcon("fa fa-table")
            ->setQuestion("Qual a distância entre as mesas?")
            ->addLevel($this->buildLevel(2))
            ->addLevel($this->buildLevel(3))
            ->setScore(15); //TODO: Avoid to set score manually
        $manager->persist($distancing);

        $transparency = Badge::create()
            ->setName("Transparência na preparação de alimentos")
            ->setIcon("fa fa-transparency")
            ->setQuestion("O estabelecimento disponibiliza meios de transparência na preparação de alimentos?")
            ->addLevel($this->buildLevel(4))
            ->addLevel($this->buildLevel(5))
            ->addLevel($this->buildLevel(6))
            ->setScore(15); //TODO: Avoid to set score manually
        $manager->persist($transparency);

        $sink = Badge::create()
            ->setName("Pia para higienização na entrada do estabelecimento")
            ->setIcon("fa fa-sink")
            ->setQuestion("O estabelecimento disponibiliza pia para higienização logo na entrada?")
            ->addLevel($this->buildLevel(7))
            ->addLevel($this->buildLevel(8))
            ->setScore(15); //TODO: Avoid to set score manually
        $manager->persist($sink);

        $manager->flush();

        $this->addReference(self::PPE_BADGE_REFERENCE, $ppe);
        $this->addReference(self::TRANSPARENCY_BADGE_REFERENCE, $transparency);
        $this->addReference(self::SINK_BADGE_REFERENCE, $sink);

        $this->addReference(self::PPE_LEVEL_REFERENCE, $ppe->getLevels()->first());
        $this->addReference(self::TRANSPARENCY_LEVEL_REFERENCE, $transparency->getLevels()->first());
        $this->addReference(self::SINK_LEVEL_REFERENCE, $sink->getLevels()->last());
    }

    private function buildLevel(int $id): Level
    {
        switch ($id) {
            case 0:
                $level = Level::create()
                    ->setScore(10)
                    ->setDescription("Utilizam parcialmente")
                    ->setColor("silver");
                break;
            case 1:
                $level = Level::create()
                    ->setScore(15)
                    ->setDescription("Utilizam equipamento completo (máscara, luvas e protetor facial)")
                    ->setColor("gold");
                break;
            case 2:
                $level = Level::create()
                    ->setScore(10)
                    ->setDescription("Distância mínima de 1 metro")
                    ->setColor("silver");
                break;
            case 3:
                $level = Level::create()
                    ->setScore(15)
                    ->setDescription("Distância mínima de 2 metros")
                    ->setColor("gold");
                break;
            case 4:
                $level = Level::create()
                    ->setScore(10)
                    ->setDescription("Disponibiliza de forma virtual")
                    ->setColor("silver");
                break;
            case 5:
                $level = Level::create()
                    ->setScore(10)
                    ->setDescription("Disponibiliza de forma presencial")
                    ->setColor("silver");
                break;
            case 6:
                $level = Level::create()
                    ->setScore(15)
                    ->setDescription("Disponibiliza de ambas as formas")
                    ->setColor("gold");
                break;
            case 7:
                $level = Level::create()
                    ->setScore(10)
                    ->setDescription("Pia comum, acionada com as mãos")
                    ->setColor("silver");
                break;
            default:
                $level = Level::create()
                    ->setScore(15)
                    ->setDescription("Pia acionada com os pés")
                    ->setColor("gold");
        }

        return $level;
    }
}