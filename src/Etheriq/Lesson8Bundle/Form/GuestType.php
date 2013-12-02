<?php
/**
 * Created by PhpStorm.
 * File: GuestType.php
 * User: Yuriy Tarnavskiy
 * Date: 02.12.13
 * Time: 16:46
 * To change this template use File | Settings | File Templates.
 */

namespace Etheriq\Lesson8Bundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;

class GuestType extends AbstractType
{
    public function getName()
    {
        return 'guest';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('body');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Etheriq\Lesson8Bundle\Entity\Guest'
            )
        );
    }
} 