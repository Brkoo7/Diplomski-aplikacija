<?php
namespace AppBundle\Form\Type\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Administration\Operator;

class OperatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oib', TextType::class, [
                'label' => 'Oib'
            ])
            ->add('label', TextType::class, [
                'label' => 'Oznaka'
            ])
            ->add('name', TextType::class, [
                'label' => 'Ime'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'method' => 'post',
            'data_class' => Operator::class,
        ));
    }
}