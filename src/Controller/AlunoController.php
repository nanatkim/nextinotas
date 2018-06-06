<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Form\AlunoType;
use App\Repository\AlunoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aluno")
 */
class AlunoController extends Controller
{
    /**
     * @Route("/{facul}/", name="aluno_index", methods="GET")
     */
    public function index(AlunoRepository $alunoRepository, int $facul): Response
    {
        //$algo = $request->query->get('algo','default');

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $alunos = $alunoRepository->findByFaculdade($facul);

        uasort($alunos, function($a, $b) { return strcmp($a->getNome(), $b->getNome()); } );

        return $this->render('aluno/index.html.twig', [
            'alunos' => $alunos,
            'faculdade' => $faculdade,
            'qtd' => count($alunos)
        ]);
    }

    /**
     * @Route("/{facul}/new", name="aluno_new", methods="GET|POST")
     */
    public function new(Request $request, int $facul): Response
    {
        $aluno = new Aluno();
        $form = $this->createForm(AlunoType::class, $aluno);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {

            $aluno->setFaculdade($faculdade);

            $em = $this->getDoctrine()->getManager();
            $em->persist($aluno);
            $em->flush();

            return $this->redirectToRoute('aluno_index', ['facul'=>$facul]);
        }

        return $this->render('aluno/form.html.twig', [
            'aluno' => $aluno,
            'faculdade' => $faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{facul}/{id}", name="aluno_show", methods="GET")
     */
    public function show(Aluno $aluno, int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        return $this->render('aluno/show.html.twig', [
            'aluno' => $aluno,
            'faculdade' => $faculdade
        ]);
    }

    /**
     * @Route("/{facul}/{id}/edit", name="aluno_edit", methods="GET|POST")
     */
    public function edit(Request $request, Aluno $aluno, int $facul): Response
    {
        $form = $this->createForm(AlunoType::class, $aluno);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aluno_index', array(
                'facul' => $facul
            ));
        }

        return $this->render('aluno/form.html.twig', [
            'aluno' => $aluno,
            'faculdade'=>$faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{id}", name="aluno_delete")
     */
    public function delete(Request $request, int $facul, Aluno $aluno): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($aluno);
        $em->flush();

        return $this->redirectToRoute('aluno_index',[
            'facul' => $facul
        ]);
    }
}
