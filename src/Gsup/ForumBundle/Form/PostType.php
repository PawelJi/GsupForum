<?php
 
namespace Gsup\ForumBundle\Form;

use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * PostType class.
 * @package Gsup\ForumBundle\Form
 * @author: Pawel Jablonski <dev.pawel@gmail.com>
 */
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
            $builder->add('tags', DocumentType::class, [
                'widget_type' => 'inline-btn',
                'expanded'    => true,
                'class' => 'GsupForumBundle:Tag',
                'choice_label' => 'name',
                'multiple'     => true,
                'label_attr'  => array(
                    'class' => 'btn-default',
                ),
            ])
            ->add('category', DocumentType::class, [
                'class' => 'GsupForumBundle:Category',
                'choice_label' => 'name',
            ]);
        }
        $builder->add('save', SubmitType::class, array('label' => 'Create Post'));
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