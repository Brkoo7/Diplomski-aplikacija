<?php
namespace AppBundle\Form\Type\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Administration\Office;

class OfficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, [
                'label' => 'Oznaka'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresa'
            ])
            ->add('city', TextType::class, [
                'label' => 'Mjesto'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'method' => 'post',
            'data_class' => Office::class,
        ));
    }
}