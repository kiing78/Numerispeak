<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class LoginController extends AbstractController
{
    /**
     * login's form
     */
  
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
          // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

        //  getUser() methode qui vient de l'abstractController, retourne un objet User si
        // il y a UserInterface qui est implémenter dans Entity\User
         return $this->render('login/index.html.twig', [
                     'last_username' => $lastUsername,
                    'error'         => $error,
             ]);
    }
    /**
     * logout
     */
    #[Route('/logout', name: 'app_logout')]
    public function logout(){
        

    }
}
