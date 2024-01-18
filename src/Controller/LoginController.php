<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
// use Symfony\Component\Security\Core\Security;

class LoginController extends AbstractController
{
    // private $security;

    // public function __construct(Security $security){
    //     $this->security=$security;
    // }
  
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, SessionInterface $session): Response
    {
        // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
          // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

        //  getUser() methode qui vient de l'abstractController, retourne un objet
        
         // last username entered by the user
         return $this->render('login/index.html.twig', [
                     'last_username' => $lastUsername,
                    'error'         => $error,
             ]);
    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(){
        

    }
}
