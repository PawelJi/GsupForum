<?php
 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
 
namespace Gsup\ForumBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SassPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('assetic.filter.sass')) {
            $container->getDefinition('assetic.filter.sass')->addMethodCall('addLoadPath',
                array("%kernel.root_dir%/../vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/public/sass/")
            );
        }
        if ($container->hasDefinition('assetic.filter.scss')) {
            $container->getDefinition('assetic.filter.scss')->addMethodCall('addLoadPath',
                array("%kernel.root_dir%/../vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/public/sass/")
            );
        }
    }
}