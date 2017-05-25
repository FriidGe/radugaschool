<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Homework;
use AppBundle\Entity\Progress;
use AppBundle\Entity\Subjects;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeachersController extends Controller
{
    /**
     * @Route("/teachers/{id}", name="teachers")
     */
    public function teachersAction($id)
    {
        $teacher = $this->getDoctrine()->getRepository("AppBundle:Teachers")->findOneById($id);

        $schoolId = $teacher[0]["school"];
        $classNumber = $this->getDoctrine()->getRepository("AppBundle:Userclass")
            ->findAllBySchool( $schoolId);

        return $this->render('AppBundle:Teachers:index.html.twig', [
           "classNumber" => $classNumber,
            "idSchool" =>  $schoolId,
            "teacher" => $teacher[0]["post"],
        ]);
    }

    /**
     * @Route("/userUpdate", name="userUpdate")
     * @param Request $request
     */
    public function userUpdateAction(Request $request)
    {
        $schoolId = $request->request->get("school");
        $number = $request->request->get("number");
        $letter = $request->request->get("letter");
        
        $pupils = $this->getDoctrine()->getRepository("AppBundle:Pupils")
            ->findByClass($schoolId, $number, $letter);
        
        return $this->render("@App/Teachers/userUpdate.html.twig",[
            "school" => $schoolId,
            "pupils" => $pupils 
        ]);
    }

    /**
     * @Route("/tableUpdate", name="tableUpdate")
     * @param Request $request
     */
    public function tableUpdateAction(Request $request)
    {
        $schoolId = $request->request->get("school");
        $pupil = $request->request->get("pupil");
        $subject = $request->request->get("subject");
        $mark = $request->request->get("mark");
        $id = $request->request->get("id");

        if(!empty($mark) && !empty($id)){
            $progress = $this->getDoctrine()->getRepository("AppBundle:Progress")->find($id);
            $progress->setMark($mark);

            $em = $this->getDoctrine()->getManager();
            $em->persist($progress);
            $em->flush();
        }

        $progress = $this->getDoctrine()->getRepository("AppBundle:Progress")
            ->findByProgress($schoolId, $pupil, $subject);

        return $this->render("@App/Teachers/tableUpdate.html.twig",[
            "progress" => $progress
        ]);
    }

    /**
     * @Route("/findRasp", name="findRasp")
     * @param Request $request
     * @return Response
     */
    public function findRaspAction(Request $request)
    {
        $pupil = $request->request->get("pupil");
        $date = $request->request->get("date1");
        $date1 = DateTime::createFromFormat("Y-m-d", $date . "-01");
        $count = date("t", strtotime($date1->format("Y-m-d")));
        $date2= DateTime::createFromFormat("Y-m-d", $date . "-" . $count);

        $class = $this->getDoctrine()->getRepository("AppBundle:Pupils")->findByNewClass($pupil);

        $progress = $this->getDoctrine()->getRepository("AppBundle:Progress")
            ->findByTeacherSchedule($pupil, null, $date1->format("Y-m-d"), $date2->format("Y-m-d"));
        $subjects = $this->getDoctrine()->getRepository("AppBundle:Schedule")->findBySubjects($class);

        $html = "";
        for($m = 0; $m < count($subjects); $m++){
            $html .= "<tr><td>". $subjects[$m]["name"] . "</td>";
            for($j = 1; $j < $count + 1; $j++){
                $k = 0;
                for($i = 0; $i < count($progress); $i++){
                    if($subjects[$m]["name"] == $progress[$i]["name"] && $progress[$i]["date"]->format("j") == $j){
                        $html .= "<td>" . $progress[$i]["mark"] . "</td>";
                        $k = 1;
                        break;
                    }
                }
                if($k == 0){
                    $html .= "<td></td>";
                }
            }
            $html .= "</tr>";
        }

        $month_r = array(
            "01" => "Январь",
            "02" => "Февраль",
            "03" => "Март",
            "04" => "Апрель",
            "05" => "Май",
            "06" => "Июнь",
            "07" => "Июль",
            "08" => "Август",
            "09" => "Сентябрь",
            "10" => "Октябрь",
            "11" => "Ноябрь",
            "12" => "Декабрь");

        $now_month = date("m", strtotime($date1->format("Y-m-d")));
        $month = $month_r[$now_month];

        return $this->render("@App/Teachers/updateRasp.html.twig",[
            "progress" => $html,
            "month" => $month,
            "count" => $count
        ]);
    }

    /**
     * @Route("/addHome", name="addHome")
     * @param Request $request
     * @return Response
     */
    public function addHomeAction(Request $request)
    {
        $session = $request->getSession();

        $name = $request->request->get("name");
        $userclass = $request->request->get("userclass");
        $date = $request->request->get("date");
        $date = DateTime::createFromFormat("Y-m-d", $date);

        $id = $session->get("id");

        $class = $this->getDoctrine()->getRepository("AppBundle:Userclass")->find($userclass);
        $teacher = $this->getDoctrine()->getRepository("AppBundle:Teachers")->findOneById($id);
        $myteacher = $this->getDoctrine()->getRepository("AppBundle:Teachers")->find($id);
        $subject =  $this->getDoctrine()->getRepository("AppBundle:Subjects")->find($teacher[0]["post"]);


        $homework = new Homework();
        $homework->setUserclass($class);
        $homework->setTeacher($myteacher);
        $homework->setName($name);
        $homework->setDate($date);
        $homework->setSubject($subject);

        $em = $this->getDoctrine()->getManager();
        $em->persist($homework);
        $em->flush();

        return new Response("Item success adding");
    }

    /**
     * @Route("/tableAdd", name="tableAdd")
     * @param Request $request
     * @return Response
     */
    public function tableAddAction(Request $request)
    {
        $pupil = $request->request->get("pupil");
        $subject = $request->request->get("subject");
        $mark = $request->request->get("mark");
        $date = $request->request->get("date");
        $date = DateTime::createFromFormat("Y-m-d",$date);
        $note = $request->request->get("note");
        $res = "ok";
        

        $user = $this->getDoctrine()->getRepository("AppBundle:Pupils")->find($pupil);
        $sub = $this->getDoctrine()->getRepository("AppBundle:Subjects")->find($subject);
        $parent = $this->getDoctrine()->getRepository("AppBundle:Pupils")->findByPhone($pupil);

        $progress = new Progress();
        $progress->setPupil($user);
        $progress->setSubject($sub);
        $progress->setDate($date);
        $progress->setMark($mark);
        $progress->setNote($note);

        $em = $this->getDoctrine()->getManager();
        $em->persist($progress);
        $em->flush();

        $m = (integer)$mark;

        if($m <= 3){
            $message = \Swift_Message::newInstance()
                ->setSubject('Неудовлетворительная успеваемость')
                ->setFrom('school@gmail.com')
                ->setTo($parent[0]["email"])
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        '@App/Emails/sendMail.html.twig',
                        array('name' => $user->getFullName(),
                              'sub' => $sub->getName(),
                              'mark' => $mark)
                    ),
                    'text/html'
                );

            $this->get('mailer')->send($message);
            $res = "bad";
        }
        
        return new Response($res, Response::HTTP_OK);
    }

}
