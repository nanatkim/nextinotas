<?php

namespace App\Controller;

use App\Entity\AvTipo;
use App\Form\AvTipoType;
use App\Repository\AvTipoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/avtipo")
 */
class AvTipoController extends Controller
{
    /**
     * @Route("/{facul}/", name="avtipo_index", methods="GET")
     */
    public function index(AvTipoRepository $avTipoRepository, int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $avtipos = $avTipoRepository->findByFaculdade($facul);

        return $this->render('avtipo/index.html.twig', [
            'avtipos' => $avtipos,
            'faculdade'=> $faculdade,
            'qtd' => count($avtipos)
        ]);
    }

    /**
     * @Route("/{facul}/new", name="avtipo_new", methods="GET|POST")
     */
    public function new(Request $request, int $facul): Response
    {
        $avTipo = new AvTipo();
        $form = $this->createForm(AvTipoType::class, $avTipo);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $avTipo->setFaculdade($faculdade);

            $em = $this->getDoctrine()->getManager();
            $em->persist($avTipo);
            $em->flush();

            return $this->redirectToRoute('avtipo_index',['facul'=>$facul]);
        }

        return $this->render('avtipo/form.html.twig', [
            'avtipo' => $avTipo,
            'faculdade' =>$faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{facul}/{id}", name="avtipo_show", methods="GET")
     */
    public function show(AvTipo $avTipo, int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        return $this->render('avtipo/show.html.twig', [
            'avtipo' => $avTipo,
            'faculdade'=>$faculdade
        ]);
    }

    /**
     * @Route("/{facul}/{id}/edit", name="avtipo_edit", methods="GET|POST")
     */
    public function edit(Request $request, AvTipo $avTipo, int $facul): Response
    {
        $form = $this->createForm(AvTipoType::class, $avTipo);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avtipo_index',['facul'=>$facul]);
        }

        return $this->render('avtipo/form.html.twig', [
            'avtipo' => $avTipo,
            'faculdade'=>$faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{id}", name="avtipo_delete")
     */
    public function delete(Request $request,int $facul, AvTipo $avTipo): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($avTipo);
        $em->flush();

        return $this->redirectToRoute('avtipo_index',['facul'=>$facul]);
    }
}
