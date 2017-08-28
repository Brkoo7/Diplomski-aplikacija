<?php
namespace AppBundle\Form\Type\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Administration\Buyer;

class BuyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Ime i prezime kupca'
            ])
            ->add('oib', TextType::class, [
                'label' => 'OIB'
            ])
            ->add('pdvID', TextType::class, [
                'label' => 'PDV ID'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresa'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'method' => 'post',
            'data_class' => Buyer::class,
        ));
    }
}