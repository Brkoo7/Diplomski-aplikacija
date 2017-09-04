<?php
namespace AppBundle\Form\Type\Invoice;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Invoice\Article;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('article', EntityType::class, [
                'class' => 'IssueInvoices\Domain\Model\Administration\Article',
                'choice_label' => function ($article) {
                    return $article->getName();
                },
                'expanded' => false,
                'multiple' => false,
                'label' => 'Artikl: '
            ])
            ->add('totalPrice', MoneyType::class, [
                'currency' => 'HRK',
                'label' => 'Cijena'
            ])
            ->add('taxRate', PercentType::class, [
                'label' => 'PDV',
                'type' => 'integer',
                'disabled' => true
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Količina',
                'attr' => ['min' => '1', 'value' => '1']
            ])
            ->add('discount', PercentType::class, [
                'label' => 'Popust',
                'type' => 'integer'
            ])
        ; 
    }

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	    	'method' => 'post',
	        'data_class' => Article::class
	    ));
	}
}