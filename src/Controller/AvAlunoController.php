<?php

namespace App\Controller;

use App\Entity\Avaluno;
//use App\Form\AvAlunoType;
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
}