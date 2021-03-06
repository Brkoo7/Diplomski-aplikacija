<?php
namespace AppBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Administration\Operator as FormOperator;
use AppBundle\Form\Type\Administration\OperatorType;
use IssueInvoices\Domain\Model\Administration\Operator;

class OperatorController extends Controller
{
    /**
     * @Route("/administration/operators", name="AppBundle_Administration_operators")
     */
    public function operatorsAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();
        $operators = $userAdministration->getOperators();

        return $this->render('AppBundle:Administration:operators.html.twig', [
            'operators' => $operators
        ]);
    }

    /**
     * @Route("/administration/operator/add", name="AppBundle_Administration_addOperator")
     */
    public function addOperatorAction(Request $request)
    {
        $formOperator = new FormOperator();
        $form = $this->createForm(OperatorType::class, $formOperator);

        $form->handleRequest($request);

        // Dohvatiti administraciju prijavljenog korisnika
        $userAdministration = $this->getUser()->getAdministration();

        if ($form->isSubmitted() && $form->isValid()) {
            $formOperator = $form->getData();

            $operator = new Operator(
                $formOperator->name,
                $formOperator->oib,
                $formOperator->label
            );

            $userAdministration->addOperator($operator);
            $this->get('app.administration_repository')->store($userAdministration);

            return $this->redirectToRoute('AppBundle_Administration_operators');
        }

        return $this->render('AppBundle:Administration:addOperator.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/operator/edit/{operatorId}", name="AppBundle_Administration_editOperator")
     */
    public function editOperatorAction(Request $request, int $operatorId)
    {
        $formOperator = new FormOperator();
        $operator = $this->get('app.operator_repository')->find($operatorId);

        $formOperator->name = $operator->getName();
        $formOperator->oib = $operator->getOib();
        $formOperator->label = $operator->getLabel();

        $form = $this->createForm(OperatorType::class, $formOperator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formOperator = $form->getData();
            
            $operator->setName($formOperator->name);
            $operator->setOib($formOperator->oib);
            $operator->setLabel($formOperator->label);

            $this->get('app.operator_repository')->store($operator);

            return $this->redirectToRoute('AppBundle_Administration_operators'); 
        }

        return $this->render('AppBundle:Administration:addOperator.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/administration/operator/delete/{operatorId}", name="AppBundle_Administration_deleteOperator")
     */
    public function deleteOperatorAction(int $operatorId)
    {
        $operator = $this->get('app.operator_repository')->find($operatorId);
        $this->get('app.operator_repository')->remove($operator);

        return $this->redirectToRoute('AppBundle_Administration_operators');
    }
}
