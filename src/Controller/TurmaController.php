<?php

namespace App\Controller;

use App\Entity\Faculdade;
use App\Entity\Professor;
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
     * @Route("/{facul}/{prof}/", name="turma_index", methods="GET")
     */
    public function index(TurmaRepository $turmaRepository, Faculdade $facul, Professor $prof): Response
    {

        $turmas = $turmaRepository
            ->findBy(array('faculdade' => $facul, 'professor' => $prof));

        return $this->render('turma/index.html.twig', [
            'turmas' => $turmas,
            'faculdade' => $facul,
            'qtd' => count($turmas)
        ]);
    }

    /**
     * @Route("/{facul}/{prof}/new", name="turma_new", methods="GET|POST")
     */
    public function new(Request $request,Faculdade $facul, Professor $prof): Response
    {
        $turma = new Turma();
        $form = $this->createForm(TurmaType::class, $turma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $turma->setFaculdade($facul);

            $em = $this->getDoctrine()->getManager();
            $em->persist($turma);
            $em->flush();

            return $this->redirectToRoute('turma_index',['facul'=>$facul->getId(), 'prof'=> $prof->getId()]);
        }

        return $this->render('turma/form.html.twig', [
            'turma' => $turma,
            'faculdade' =>$facul,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{facul}/{id}", name="turma_show", methods="GET")
     */
    public function show(Faculdade $facul, Turma $turma): Response
    {
        return $this->render('turma/show.html.twig', [
            'turma' => $turma,
            'faculdade'=>$facul
        ]);
    }

    /**
     * @Route("/{facul}/{prof}/{id}/edit", name="turma_edit", methods="GET|POST")
     */
    public function edit(Request $request, Faculdade $facul, Professor $prof, Turma $turma): Response
    {
        $form = $this->createForm(TurmaType::class, $turma);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('turma_index', ['facul'=>$facul->getId(), 'prof'=> $prof->getId()]);
        }

        return $this->render('turma/form.html.twig', [
            'turma' => $turma,
            'faculdade'=>$facul,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{prof}/{id}", name="turma_delete")
     */
    public function delete(Request $request,Faculdade $facul, Professor $prof, Turma $turma): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($turma);
        $em->flush();

        return $this->redirectToRoute('turma_index',['facul'=>$facul->getId(), 'prof'=>$prof->getId()]);
    }
}
