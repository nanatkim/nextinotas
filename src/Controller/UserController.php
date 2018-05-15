<?php

namespace App\Controller;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/{facul}/user", name="user_index")
     */
    public function viewUserAction(int $facul)
    {
        $user = $this->getDoctrine()
            ->getRepository('App:Usuario')
            ->findAll();

            $faculdade = $this->getDoctrine()
                ->getRepository('App:Faculdade')
                ->find($facul);

        return $this->render('/user/index.html.twig',[
            'users' => $user,
            'faculdade' => $faculdade,
            'qtd' => count($user)
        ]);
    }
}