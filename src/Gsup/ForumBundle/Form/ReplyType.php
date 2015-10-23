<?php

namespace Gsup\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
class ReplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', 'textarea')
            ->add('save', 'submit', array('label' => 'Reply'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gsup\ForumBundle\Document\Post',
            'validation_groups' => array('reply'),
        ));
    }

    public function getName()
    {
        return 'forum_reply';
    }
} 