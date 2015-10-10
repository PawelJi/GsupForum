<?php
 /**
 * Description
 *
 * @package 
 * @subpackage 
 * @author: Pawel J.
 * @version $Id$
 */
 
namespace Gsup\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('tags', 'document', [
                'widget_type' => 'inline-btn',
                'expanded'    => true,
                'class' => 'GsupForumBundle:Tag',
                'choice_label' => 'name',
                'multiple'     => true,
                'label_attr'  => array(
                    'class' => 'btn-default',
                ),
            ])
            ->add('category', 'document', [
                'class' => 'GsupForumBundle:Category',
                'choice_label' => 'name',
            ])
            ->add('save', 'submit');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gsup\ForumBundle\Document\Post',
        ));
    }

    public function getName()
    {
        return 'forum_post';
    }
} 