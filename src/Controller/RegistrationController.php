<?php
namespace App\Controller;

use App\Entity\Professor;
use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        // Create a new blank user and process the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Set their role
            $user->setRole('ROLE_USER');
            //$user->setRole('ROLE_ADM');

            // Set Professor
            $professor = $this->getDoctrine()
                ->getRepository('App:Professor')
                ->findByFaculdade($form->get('faculdade')->getData());

            foreach ($professor as $prof ){
                if($prof->getEmail() == $form->get('email')->getData()){
                    $user->setProfessor($prof);
                    break;
                }
            }

            if($user->getProfessor()!=null){
                // Save
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            } else {
                $this->addFlash(
                    'error',
                    'Você não tem permissão para se cadastrar nesse sistema!'
                );
            }

            return $this->redirectToRoute('index');
        }

        return $this->render('user/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}