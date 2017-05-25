<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();

        $email = $request->request->get("email");
        $password = $request->request->get("password");

        if(empty($email) && empty($password) && !$session->get("login")){

            return $this->redirectToRoute("login");
        }

        $teacher = $this->getDoctrine()->getRepository("AppBundle:Teachers")
                ->findOneByEmailAndPassword($email, $password);

        if(count($teacher) > 0){
            $session->set("login", $teacher[0]["fullName"]);
            
            $id = $teacher[0]["id"];

            $session->set("id", $id);

            return $this->redirectToRoute('teachers', ["id" => $id]);

        }else{
            $user = $this->getDoctrine()->getRepository("AppBundle:Pupils")
                ->findOneByEmailAndPassword($email, $password);

            $session->set("login", $user[0]["fullName"]);

            $id = $user[0]["id"];

            $session->set("id", $id);
        }

        return $this->redirectToRoute('pupils',['id' => $id]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(){
        return $this->render('@App/login/login.html.twig');
    }

    /**
     * @Route("/reset", name="reset")
     */
    public function resetAction(Request $request){
        $session = $request->getSession();
        $session->clear();

        return $this->render('@App/login/login.html.twig');
    }

    /**
     * @Route("/home", name="home")
     */
    public function homeAction(){
        return $this->render('@App/Home/index.html.twig');
    }

    /**
     * @Route("/gallery", name="gallery")
     */
    public function galleryAction(){
        return $this->render('@App/Home/gallery.html.twig');
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contactsAction(){
        return $this->render('@App/Home/contacts.html.twig');
    }
}
