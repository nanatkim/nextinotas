<?php

namespace App\Controller;

use App\Entity\Disciplina;
use App\Form\DisciplinaType;
use App\Repository\DisciplinaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/disciplina")
 */
class DisciplinaController extends Controller
{
    /**
     * @Route("/{facul}/", name="disciplina_index", methods="GET")
     */
    public function index(DisciplinaRepository $disciplinaRepository, int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $disciplina = $disciplinaRepository->findByFaculdade($facul);
        uasort($disciplina, function($a, $b) { return strcmp($a->getNome(), $b->getNome()); } );

        return $this->render('disciplina/index.html.twig', [
            'disciplinas' => $disciplina,
            'faculdade' => $faculdade,
            'qtd' => count($disciplina)

        ]);
    }

    /**
     * @Route("/{facul}/new", name="disciplina_new", methods="GET|POST")
     */
    public function new(Request $request,int $facul): Response
    {
        $disciplina = new Disciplina();
        $form = $this->createForm(DisciplinaType::class, $disciplina);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $disciplina->setFaculdade($faculdade);

            $em = $this->getDoctrine()->getManager();
            $em->persist($disciplina);
            $em->flush();

            return $this->redirectToRoute('disciplina_index',['facul'=>$facul]);
        }

        return $this->render('disciplina/form.html.twig', [
            'disciplina' => $disciplina,
            'faculdade' =>$faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{facul}/{id}", name="disciplina_show", methods="GET")
     */
    public function show(Disciplina $disciplina,int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        return $this->render('disciplina/show.html.twig', [
            'disciplina' => $disciplina,
            'faculdade'=>$faculdade
        ]);
    }

    /**
     * @Route("/{facul}/{id}/edit", name="disciplina_edit", methods="GET|POST")
     */
    public function edit(Request $request, Disciplina $disciplina,int $facul): Response
    {
        $form = $this->createForm(DisciplinaType::class, $disciplina);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disciplina_index', ['facul'=>$facul]);
        }

        return $this->render('disciplina/form.html.twig', [
            'disciplina' => $disciplina,
            'faculdade' => $faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{id}", name="disciplina_delete")
     */
    public function delete(Request $request, Disciplina $disciplina,int $facul): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($disciplina);
        $em->flush();

        return $this->redirectToRoute('disciplina_index',['facul'=>$facul]);
    }
}
