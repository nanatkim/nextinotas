<?php

namespace App\Controller;

use App\Entity\AvBase;

use App\Entity\Faculdade;
use App\Entity\Turma;
use App\Form\AvBaseType;
use App\Repository\AvBaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/avbase")
 */
class AvBaseController extends Controller
{
    /**
     * @Route("/{facul}/{tur}/", name="avbase_index", methods="GET|POST")
     */
    public function index(AvBaseRepository $avBaseRepository, int $facul, int $tur): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($tur);

        $avbases = $avBaseRepository->findByIdTurma($turma);

        return $this->render('avbase/index.html.twig', [
            'avbases' => $avbases,
            'faculdade' => $faculdade,
            'turma' => $turma,
            'qtd' => count($avbases)
        ]);
    }

    /**
     * @Route("/{facul}/{tur}/new", name="avbase_new", methods="GET|POST")
     */
    public function new(Request $request, int $facul, int $tur): Response
    {
        $avBase = new AvBase();
        $form = $this->createForm(AvBaseType::class, $avBase);
        $form->handleRequest($request);

        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($tur);

        if ($form->isSubmitted() && $form->isValid()) {
            $avBase->setIdTurma($turma);

            $em = $this->getDoctrine()->getManager();
            $em->persist($avBase);
            $em->flush();

            return $this->redirectToRoute('avaluno_new',array('avbase'=>$avBase->getId(),'facul'=>$facul, 'turma'=>$tur));

        }

        return $this->render('avbase/form.html.twig', [
            'avbase' => $avBase,
            'faculdade'=>$faculdade,
            'turma' => $turma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{facul}/{tur}/{id}", name="avbase_show", methods="GET|POST")
     */
    public function show(AvBase $avBase, Faculdade $facul, Turma  $tur): Response
    {

        $turmaluno = $this->getDoctrine()
            ->getRepository('App:TurmAluno')
            ->findByIdTurma($tur);

        $avaliacao = $this->getDoctrine()
            ->getRepository('App:AvAluno')
            ->findByIdAvbase($avBase);

        return $this->render('avbase/show.html.twig', [
            'avbase' => $avBase,
            'avaliacao' =>$avaliacao,
            'faculdade' => $facul,
            'relacoes' => $turmaluno,
            'turma' => $tur
        ]);
    }

    /**
     * @Route("/{facul}/{tur}/{id}/edit", name="avbase_edit", methods="GET|POST")
     */
    public function edit(Request $request, AvBase $avBase, int $facul, int $tur): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($tur);

        $form = $this->createForm(AvBaseType::class, $avBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('avbase_index',array('facul'=>$facul, 'tur'=>$tur));

        }

        return $this->render('avbase/form.html.twig', [
            'avbase' => $avBase,
            'faculdade'=>$faculdade,
            'turma' => $turma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{tur}/{id}", name="avbase_delete")
     */
    public function delete(Request $request, int $facul, int $tur, AvBase $avBase): Response
    {
         $em = $this->getDoctrine()->getManager();
         $em->remove($avBase);
         $em->flush();

        return $this->redirectToRoute('avbase_index',array('facul'=>$facul, 'tur'=>$tur));
    }
}
