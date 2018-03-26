<?php

namespace App\Controller;
use AppB\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user_index")
     */
    public function viewUserAction()
    {
        $user = $this->getDoctrine()
            ->getRepository('App:User')
            ->findAll();

            $facul = $_GET['facul'];
            $faculdade = $this->getDoctrine()
                ->getRepository('App:Faculdade')
                ->find($facul);

        return $this->render('/user/view.html.twig',[
            'user' => $user,
            'faculdade' => $faculdade,
            'qtd' => count($user)
        ]);
    }
}