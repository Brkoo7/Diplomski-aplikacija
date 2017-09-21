<?php
namespace AppBundle\Form\Type\Invoice;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Invoice\Article;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $allArticles = $options['allArticles'];

        $builder
             ->add('article', ChoiceType::class, [
                'choices' => $allArticles,
                'choice_label' => function($article, $key, $index) {
                    return $article->getName();
                },
                'choice_value' => 'id',
                'expanded' => false,
                'multiple' => false,
                'label' => 'Artikl: ',
                'attr' => ['class' => 'article-choice']
            ])
            ->add('totalPrice', MoneyType::class, [
                'currency' => 'HRK',
                'label' => 'Cijena',
                'data' => count($allArticles) ? $allArticles[0]->getTotalPrice() : null,
                'attr' => ['class' => 'price']
            ])
            ->add('taxRate', PercentType::class, [
                'label' => 'PDV',
                'type' => 'integer',
                'data' => count($allArticles) ? $allArticles[0]->getTaxRate() : null,
                'attr' => ['class' => 'tax']
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Količina',
                'attr' => ['min' => '1', 'value' => '1']
            ])
            ->add('discount', PercentType::class, [
                'label' => 'Popust',
                'type' => 'integer',
                'required' => false
            ])
        ; 
    }

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	    	'method' => 'post',
	        'data_class' => Article::class,
            'allArticles' => null
	    ));
	}
}