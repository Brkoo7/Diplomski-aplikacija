<?php
namespace AppBundle\Form\Type\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Model\Administration\Article;

class ArticleType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Naziv artikla'
            ])
            ->add('totalPrice', NumberType::class, [
                'label' => 'Cijena artikla'
            ])
            ->add('taxRate', NumberType::class, [
                'label' => 'Iznos PDV-a'
            ])
        ;
    }

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	    	'method' => 'post',
	        'data_class' => Article::class,
	    ));
	}
}