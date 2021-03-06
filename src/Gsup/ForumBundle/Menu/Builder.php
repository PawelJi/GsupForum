<?php

namespace Gsup\ForumBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Bundle\MenuBundle\Tests\Stubs\Menu\ContainerAwareBuilder;

/**
 * Description
 *
 * @package
 * @subpackage
 * @author: Pawel J.
 * @version $Id$
 */
class Builder extends ContainerAwareBuilder
{
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', [
            'route' => 'gsup_forum_homepage'
        ]);

        $menu->addChild('Create post +', [
            'route' => 'gsup_post_new'
        ]);

        $menu->addChild('Sign In', [
            'route' => 'fos_user_security_login'
        ]);

        $menu->addChild('Register', [
            'route' => 'fos_user_registration_register'
        ]);

        return $menu;
    }
}