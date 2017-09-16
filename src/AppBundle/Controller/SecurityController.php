<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\User\UserType;
use IssueInvoices\Domain\Model\User\User;
use IssueInvoices\Domain\Model\Administration\Administration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="AppBundle_Security_login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

         // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * Redirect users after login based on the granted ROLE
     * @Route("/login/redirect", name="AppBundle_Security_redirect")
     */
    public function loginRedirectAction(Request $request)
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('AppBundle_Administration_home');
        }
        elseif ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('AppBundle_Administration_home');
        }
        else {
            return $this->redirectToRoute('AppBundle_Security_login');
        }
    }

    /**
     * @Route("/register", name="AppBundle_Security_registration")
     */
    public function registrationAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $administration = new Administration();
        $user->setAdministration($administration);

        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            
            // 4) save the User!
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();    
            } catch(\Exception $e) {
                $this->addFlash(
                    'notice',
                    'Korisnik već postoji'
                );

            }
            
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->authenticateUser($user);

            $url = $this->generateUrl('AppBundle_Administration_home');

            return $this->redirect($url);
        }

        return $this->render('AppBundle:Security:registration.html.twig',[
            'form' => $form->createView()
        ]);
    }

    private function authenticateUser(User $user)
    {
        $providerKey = 'main'; // your firewall name
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $this->container->get('security.token_storage')->setToken($token);
    }
}