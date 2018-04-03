<?php

namespace App\Controller;

use App\Entity\Avaluno;
use App\Entity\AvBase;
use App\Entity\Faculdade;
use App\Entity\Turma;
use App\Entity\TurmAluno;
use App\Form\AvAlunoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/avaluno")
 */
class AvAlunoController extends Controller
{
    /**
     * @Route("/{turma}", name="avaluno_index")
     */
    public function viewAvAlunoAction(Request $request, int $turma)
    {
        $avbase = $request->query->get('avbase');

        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($turma);

        $relacoes = $this->getDoctrine()
            ->getRepository('App:AvAluno')
            ->findByIdAvbase($avbase);

        return $this->render('/avaluno/index.html.twig',[
            'relacoes' => $relacoes,
            'turma' => $turma,
            'qtd' => count($relacoes)
        ]);
    }

    /**
     * @Route("/{avbase}/{aluno}/{facul}/{turma}/new", name="avaluno_new", methods="GET|POST")
     */
    public function new(Request $request, int $turma, Faculdade $facul, AvBase $avbase, int $aluno): Response
    {
        $avaluno = new AvAluno();
        $form = $this->createForm(AvAlunoType::class, $avaluno);
        $form->handleRequest($request);

        $aluno = $this->getDoctrine()
            ->getRepository('App:TurmAluno')
            ->find($aluno);

        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($turma);

        if ($form->isSubmitted() && $form->isValid()) {
            $avaluno->setIdAluno($aluno);
            $avaluno->setIdAvbase($avbase);

            $em = $this->getDoctrine()->getManager();
            $em->persist($avaluno);
            $em->flush();

            return $this->redirectToRoute('avbase_show',array('facul'=>$facul, 'tur'=>$turma->getId(),'id'=>$avbase->getId()));
        }

        return $this->render('avaluno/form.html.twig', [
            'avaluno'=>$avaluno,
            'faculdade'=>$facul,
            'turma'=>$turma,
            'avbase'=>$avbase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{facul}/{turma}", name="avaluno_show", methods="GET|POST")
     */
    public function show($facul,$turma){

        $faculdade = $this->getDoctrine()
        ->getRepository('App:Faculdade')
        ->find($facul);

        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($turma);

        $avaluno = $this->getDoctrine()
            ->getRepository('App:AvAluno')
            ->findByIdAluno($turma);

        return $this->render('avaluno/show.html.twig', [
            'avaluno'=>$avaluno,
            'faculdade'=>$facul,
            'turma'=>$turma
        ]);
    }
}