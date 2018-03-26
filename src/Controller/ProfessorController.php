<?php

namespace App\Controller;

use App\Entity\Professor;
use App\Form\ProfessorType;
use App\Repository\ProfessorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/professor")
 */
class ProfessorController extends Controller
{
    /**
     * @Route("/{facul}/", name="professor_index", methods="GET")
     */
    public function index(ProfessorRepository $professorRepository,int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $professors = $professorRepository->findByFaculdade($facul);

        return $this->render('professor/index.html.twig', [
            'professors' => $professors,
            'faculdade' => $faculdade,
            'qtd' => count($professors)
        ]);
    }

    /**
     * @Route("/{facul}/new", name="professor_new", methods="GET|POST")
     */
    public function new(Request $request,int $facul): Response
    {
        $professor = new Professor();
        $form = $this->createForm(ProfessorType::class, $professor);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $professor->setFaculdade($faculdade);

            $em = $this->getDoctrine()->getManager();
            $em->persist($professor);
            $em->flush();

            return $this->redirectToRoute('professor_index',['facul'=>$facul]);
        }

        return $this->render('professor/form.html.twig', [
            'professor' => $professor,
            'faculdade' => $faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{facul}/{id}", name="professor_show", methods="GET")
     */
    public function show(Professor $professor,int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        return $this->render('professor/show.html.twig', [
            'professor' => $professor,
            'faculdade' => $faculdade
        ]);
    }

    /**
     * @Route("/{facul}/{id}/edit", name="professor_edit", methods="GET|POST")
     */
    public function edit(Request $request, Professor $professor,int $facul): Response
    {
        $form = $this->createForm(ProfessorType::class, $professor);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('professor_index', ['facul'=>$facul]);
        }

        return $this->render('professor/form.html.twig', [
            'professor' => $professor,
            'faculdade'=> $faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{id}", name="professor_delete")
     */
    public function delete(Request $request, Professor $professor,int $facul): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($professor);
        $em->flush();

        return $this->redirectToRoute('professor_index', ['facul'=>$facul]);
    }
}
