<?php

namespace App\Controller;
use App\Entity\Usuario;
use App\Entity\Faculdade;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/user/{facul}", name="user_index")
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

    /**
     * @Route("/delete/{facul}/{id}", name="user_delete")
     */
    public function deleteUserAction(Faculdade $facul, Usuario$user)
    {

        $turmas = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->findByProfessor($user->getProfessor());

        foreach ($turmas as $turma){
            $em = $this->getDoctrine()->getManager();
            $em->remove($turma);
            $em->flush();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('user_index',[
            'facul' => $facul->getId()
        ]);
    }
}