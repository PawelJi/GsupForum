<?php
 
namespace Gsup\ForumBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gsup\ForumBundle\Document\Category;
use Symfony\Component\Yaml\Yaml;

/**
 * Class LoadCategoryData
 * @package Gsup\ForumBundle\DataFixtures\MongoDB
 */
class LoadCategoryData implements FixtureInterface
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
            $tag = new Category();
            $tag->setName($data);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}