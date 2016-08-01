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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class);

        if ('test' == $options['env']) {
            $builder->add('tags', ChoiceType::class, [
                'choice_label' => 'name',
                'multiple'     => true,
            ])
            ->add('category', ChoiceType::class, [
                'choice_label' => 'name',
            ]);
        } else {
            $builder->add('tags', 'document', [
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
            ]);
        }
        $builder->add('save', 'submit', array('label' => 'Create Post'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gsup\ForumBundle\Document\Post',
            'env' => 'prod'
        ));
    }

    public function getName()
    {
        return 'forum_post';
    }
} 