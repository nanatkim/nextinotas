<?php

namespace App\Controller;

use App\Entity\Turma;
use App\Form\TurmaType;
use App\Repository\TurmaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/turma")
 */
class TurmaController extends Controller
{
    /**
     * @Route("/{facul}/", name="turma_index", methods="GET")
     */
    public function index(TurmaRepository $turmaRepository, int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $turmas = $turmaRepository->findByFaculdade($facul);

        return $this->render('turma/index.html.twig', [
            'turmas' => $turmas,
            'faculdade' => $faculdade,
            'qtd' => count($turmas)
        ]);
    }

    /**
     * @Route("/{facul}/new", name="turma_new", methods="GET|POST")
     */
    public function new(Request $request,int $facul): Response
    {
        $turma = new Turma();
        $form = $this->createForm(TurmaType::class, $turma);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $turma->setFaculdade($faculdade);

            $em = $this->getDoctrine()->getManager();
            $em->persist($turma);
            $em->flush();

            return $this->redirectToRoute('turma_index',['facul'=>$facul]);
        }

        return $this->render('turma/form.html.twig', [
            'turma' => $turma,
            'faculdade' =>$faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{facul}/{id}", name="turma_show", methods="GET")
     */
    public function show(Turma $turma,int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);
        return $this->render('turma/show.html.twig', [
            'turma' => $turma,
            'faculdade'=>$faculdade
        ]);
    }

    /**
     * @Route("/{facul}/{id}/edit", name="turma_edit", methods="GET|POST")
     */
    public function edit(Request $request, Turma $turma,int $facul): Response
    {
        $form = $this->createForm(TurmaType::class, $turma);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('turma_index', ['facul'=>$facul]);
        }

        return $this->render('turma/form.html.twig', [
            'turma' => $turma,
            'faculdade'=>$faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{id}", name="turma_delete")
     */
    public function delete(Request $request, Turma $turma,int $facul): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($turma);
        $em->flush();

        return $this->redirectToRoute('turma_index',['facul'=>$facul]);
    }
}
