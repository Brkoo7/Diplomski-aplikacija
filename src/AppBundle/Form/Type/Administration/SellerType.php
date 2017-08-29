<?php
namespace AppBundle\Form\Type\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('oib', NumberType::class, [
                'label' => 'OIB'
            ])
            ->add('pdvID', NumberType::class, [
                'label' => 'PDV ID broj'
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'kontakt broj'
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail'
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
            ->add('countryCode', TextType::class, [
                'label' => 'Država'
            ])
            ->add('inVATSystem', ChoiceType::class, [
                'choices' => [
                    'Yes' => "1",
                    'No' => "0"
                ],
                'label' => 'U sustavu PDV-a',
                'required' => true,
                'choices_as_values' => true
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