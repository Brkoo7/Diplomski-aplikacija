<?php
namespace AppBundle\Form\Type\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Administration\CashRegister;

class CashRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $offices = $options['offices'];

        $builder
            ->add('number', IntegerType::class, [
                'label' => 'Broj blagajne'
            ])
            ->add('office', ChoiceType::class, [
                'choices' => $offices,
                'choice_label' => function($office, $key, $index) {
                    return strtoupper($office->getLabel());
                },
                'expanded' => false,
                'multiple' => false,
                'label' => 'Poslovni prostor',
                'disabled' => $options['offices_choice_disabled']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'method' => 'post',
            'data_class' => CashRegister::class,
            'offices' => null,
            'offices_choice_disabled' => false
        ));
    }
}