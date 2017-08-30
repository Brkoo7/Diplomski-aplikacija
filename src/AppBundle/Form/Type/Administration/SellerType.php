<?php
namespace AppBundle\Form\Type\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Administration\Seller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SellerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class, [
                'label' => 'Naziv tvrtke'
            ])
            ->add('personName', TextType::class, [
                'label' => 'Ime i prezime osobe'
            ])
            ->add('oib', TextType::class, [
                'label' => 'OIB'
            ])
            ->add('pdvID', TextType::class, [
                'label' => 'PDV ID broj',
                'required' => false
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'kontakt broj',
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'required' => false
            ])
            ->add('street', TextType::class, [
                'label' => 'Ulica'
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Poštanski broj'
            ])
            ->add('city', TextType::class, [
                'label' => 'Mjesto'
            ])
            ->add('country', TextType::class, [
                'label' => 'Država'
            ])
            ->add('inVATSystem', ChoiceType::class, [
                'label' => 'U sustavu PDV-a',
                'choices'  => [
                'DA' => true,
                'NE' => false
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'method' => 'post',
            'data_class' => Seller::class,
        ));
    }
}