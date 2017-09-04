<?php
namespace AppBundle\Form\Type\Invoice;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use AppBundle\Form\Model\Invoice\Invoice;
use IssueInvoices\Domain\Model\Invoice\PaymentType;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $buyers = $options['buyers'];
        $operators = $options['operators'];
        $offices = $options['offices'];
        $paymentTypes = [
            new PaymentType('CASH'),
            new PaymentType('CREDIT_CARD'),
            new PaymentType('TRANSACTION_ACCOUNT'),
            new PaymentType('OTHER')
            ];

        $builder
            ->add('buyer', ChoiceType::class, [
                'choices' => $buyers,
                'choice_label' => function($buyer, $key, $index) {
                    return strtoupper($buyer->getName());
                },
                'expanded' => false,
                'multiple' => false,
                'label' => 'Kupac: '
            ])
            ->add('office', ChoiceType::class, [
                'choices' => $offices,
                'choice_label' => function($office, $key, $index) {
                    return strtoupper($office->getLabel());
                },
                'expanded' => false,
                'multiple' => false,
                'label' => 'Poslovni prostor: '
            ])
            ->add('cashRegister', EntityType::class, [
                'class' => 'IssueInvoices\Domain\Model\Administration\CashRegister',
                'choice_label' => function ($cashRegister) {
                    return $cashRegister->getLabel();
                },
                'expanded' => false,
                'multiple' => false,
                'label' => 'Blagajna: '
            ])
            ->add('operator', ChoiceType::class, [
                'choices' => $operators,
                'choice_label' => function($operator, $key, $index) {
                    return strtoupper(
                        $operator->getName()
                    );
                },
                'expanded' => false,
                'multiple' => false,
                'label' => 'Operater: '
            ])
            ->add('paymentType', ChoiceType::class, [
                'choices' => $paymentTypes,
                'choice_label' => function($paymentType, $key, $index) {
                    return $paymentType->titleName();
                },
                'expanded' => false,
                'multiple' => false,
                'label' => 'Način plaćanja: '
            ])
            ->add('articles', CollectionType::class, [
                'entry_type' => ArticleType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
        ;
    }

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	    	'method' => 'post',
	        'data_class' => Invoice::class,
            'buyers' => null,
            'operators' => null,
            'offices' => null
	    ));
	}
}