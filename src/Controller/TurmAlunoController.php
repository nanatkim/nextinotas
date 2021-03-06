<?php

namespace App\Controller;

use App\Entity\TurmAluno;
use App\Form\TurmAlunoType;
use App\Repository\TurmAlunoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/turmaluno")
 */
class TurmAlunoController extends Controller
{
    /**
     * @Route("/{facul}/{tur}/", name="turmaluno_index", methods="GET")
     */
    public function index(TurmAlunoRepository $turmAlunoRepository, int $tur, int $facul): Response
    {
        $faculdade = $this->getDoctrine()
            ->getRepository('App:Faculdade')
            ->find($facul);

        $turmalunos = $turmAlunoRepository->findByIdTurma($tur);

        uasort($turmalunos, function($a, $b) { return strcmp($a->getIdAluno()->getNome(), $b->getIdAluno()->getNome()); } );

        return $this->render('turmaluno/index.html.twig', [
            'turmalunos' => $turmalunos,
            'tur'=>$tur,
            'faculdade'=>$faculdade,
            'qtd'=>count($turmalunos)
        ]);
    }

    /**
     * @Route("/{facul}/{tur}/new", name="turmaluno_new", methods="GET|POST")
     */
    public function new(Request $request, int $tur, int $facul): Response
    {
        $turmAluno = new TurmAluno();
        $form = $this->createForm(TurmAlunoType::class, $turmAluno);
        $form->handleRequest($request);

        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($tur);

        if ($form->isSubmitted() && $form->isValid()) {
            $mat = $form['id_aluno']->getData();
            $aluno = $this->getDoctrine()
                ->getRepository('App:Aluno')
                ->findOneByMatricula($mat);

            if($aluno == null){
                $this->addFlash(
                    'error',
                    'Não existe aluno com essa matrícula.'
                );
                return $this->redirectToRoute('turmaluno_new',array('facul'=>$facul, 'tur'=>$tur));
            }
            $turmAluno->setIdTurma($turma);
            $turmAluno->setIdAluno($aluno);

            $em = $this->getDoctrine()->getManager();
            $em->persist($turmAluno);
            $em->flush();


            return $this->redirectToRoute('turma_show',array('facul'=>$facul, 'id'=>$tur));
        }

        return $this->render('turmaluno/form.html.twig', [
            'turmaluno' => $turmAluno,
            'turma' => $turma,
            'facul'=>$facul,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{tur}/{id}", name="turmaluno_show", methods="GET")
     */
    public function show(TurmAluno $turmAluno, int $tur): Response
    {
        return $this->render('turmaluno/show.html.twig', ['turmaluno' => $turmAluno]);
    }

    /**
     * @Route("/{tur}/{id}/edit", name="turmaluno_edit", methods="GET|POST")
     */
    public function edit(Request $request, TurmAluno $turmAluno, int $tur): Response
    {
        $form = $this->createForm(TurmAlunoType::class, $turmAluno);
        $form->handleRequest($request);


        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->find($tur);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('turma_show',array('facul'=>$turma->getIdFacul()->getId(), 'id'=>$tur));
        }

        return $this->render('turmaluno/form.html.twig', [
            'turmaluno' => $turmAluno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{facul}/{tur}/{id}", name="turmaluno_delete")
     */
    public function delete(Request $request, TurmAluno $turmAluno, int $tur, int $facul): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($turmAluno);
        $em->flush();

        return $this->redirectToRoute('turma_show',array('facul'=>$facul, 'id'=>$tur));

    }
}
