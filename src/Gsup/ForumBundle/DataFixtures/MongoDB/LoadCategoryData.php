<?php
 
namespace Gsup\ForumBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gsup\ForumBundle\Document\Category;
use Symfony\Component\Yaml\Yaml;

/**
 * Class LoadCategoryData
 * @package Gsup\ForumBundle\DataFixtures\MongoDB
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'Resources/data/category.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $data) {
            $category = new Category();
            $category->setName($data);
            $manager->persist($category);
        }

        if ($category) {
            $this->addReference('random-category', $category);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}