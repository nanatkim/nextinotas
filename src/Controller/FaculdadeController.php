<?php

namespace App\Controller;

use App\Entity\Faculdade;
use App\Entity\User;
use App\Form\FaculdadeType;
use App\Repository\FaculdadeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/faculdade")
 */
class FaculdadeController extends Controller
{
    /**
     * @Route("/", name="faculdade_index", methods="GET")
     */
    public function index(FaculdadeRepository $faculdadeRepository): Response
    {
        $faculdades = $faculdadeRepository->findAll();

        return $this->render('faculdade/index.html.twig', [
            'faculdades' => $faculdades,
            'qtd' => count($faculdades)
        ]);
    }

    /**
     * @Route("/new", name="faculdade_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $faculdade = new Faculdade();
        $form = $this->createForm(FaculdadeType::class, $faculdade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faculdade);
            $em->flush();

            return $this->redirectToRoute('faculdade_index');
        }

        return $this->render('faculdade/form.html.twig', [
            'faculdade' => $faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/{user}/", name="faculdade_show", methods="GET")
     */
    public function show(Faculdade $faculdade, User $user): Response
    {
        $professor = $this->getDoctrine()
            ->getRepository('App:Professor')
            ->findByFaculdade($faculdade);

        foreach ($professor as $prof ){
            if($prof->getEmail() == $user->getEmail()){
                $p = $prof;
                break;
            }
        }

        $aluno = $this->getDoctrine()
            ->getRepository('App:Aluno')
            ->findByFaculdade($faculdade->getId());
        $turma = $this->getDoctrine()
            ->getRepository('App:Turma')
            ->findBy(array('faculdade' => $faculdade->getId(), 'professor' => $p));
        $professor = $this->getDoctrine()
            ->getRepository('App:Professor')
            ->findByFaculdade($faculdade->getId());
        $avtipo = $this->getDoctrine()
            ->getRepository('App:AvTipo')
            ->findByFaculdade($faculdade->getId());
        $disciplina = $this->getDoctrine()
            ->getRepository('App:Disciplina')
            ->findByFaculdade($faculdade->getId());
        $user = $this->getDoctrine()
            ->getRepository('App:User')
            ->findAll();

        return $this->render('/faculdade/show.html.twig',[
            'faculdade' => $faculdade,
            'aluno' => count($aluno),
            'turma' => count($turma),
            'prof' => count($professor),
            'avtipo' => count($avtipo),
            'disc' => count($disciplina),
            'user' => count($user)
        ]);
    }

    /**
     * @Route("/{id}/edit", name="faculdade_edit", methods="GET|POST")
     */
    public function edit(Request $request, Faculdade $faculdade): Response
    {
        $form = $this->createForm(FaculdadeType::class, $faculdade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('faculdade_edit', ['id' => $faculdade->getId()]);
        }

        return $this->render('faculdade/form.html.twig', [
            'faculdade' => $faculdade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="faculdade_delete")
     */
    public function delete(Request $request, Faculdade $faculdade): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($faculdade);
        $em->flush();

        return $this->redirectToRoute('index');
    }
}
