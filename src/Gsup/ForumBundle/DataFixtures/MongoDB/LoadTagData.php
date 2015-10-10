<?php
 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
 
namespace Gsup\ForumBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gsup\ForumBundle\Document\Tag;
use Symfony\Component\Yaml\Yaml;

class LoadTagData implements FixtureInterface
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
            DIRECTORY_SEPARATOR . 'Resources/data/tag.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $data) {
            $tag = new Tag();
            $tag->setName($data);
            $tag->setStatsTotal(0);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}