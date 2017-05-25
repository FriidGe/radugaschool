<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;

class PupilsController extends Controller
{
    /**
     * @Route("/pupils/{id}", name="pupils")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($id, Request $request)
    {
        $monday = [];
        $tuesday = [];
        $wednesday = [];
        $thursday = [];
        $friday = [];
        $date = (empty($request->request->get("date"))) ? date("U") : $request->request->get("date");
        $user_class = $this->getDoctrine()->getRepository("AppBundle:Pupils")->findByNewClass($id);

        if (strftime("%A", $date) != "Monday") {
            $firstDay = strtotime("last Monday", $date);
            $lastDay = date("U", strtotime("+5 day", $firstDay));
            $nextWeek = strtotime("next Monday", $firstDay);
            $prevWeek = strtotime("last Monday", $firstDay);
        }else{
            $firstDay = $date;
            $lastDay = strtotime("+5 day", $date);
            $nextWeek = strtotime("next Monday",$date);
            $prevWeek = strtotime("last Monday", $date);
        }

        $weekdays = $this->getDoctrine()->getRepository("AppBundle:Schedule")
            ->findBySchedule($id,date("Y-m-d", $firstDay), date("Y-m-d", $lastDay));

        $progress = $this->getDoctrine()->getRepository("AppBundle:Pupils")
            ->findByProgress($id, date("Y-m-d", $firstDay), date("Y-m-d", $lastDay));

        $userclass = $this->getDoctrine()->getRepository("AppBundle:Pupils")
            ->findByNewClass($id);

        $homework = $this->getDoctrine()->getRepository("AppBundle:Homework")
            ->findByHomework($userclass[0]["id"], date("Y-m-d", $firstDay), date("Y-m-d", $lastDay));

        for($i = 0; $i < count($weekdays); $i++){
            $weekdays[$i]["homework"] = "";
            $weekdays[$i]["mark"] = "";
        }

        for ($i = 0; $i < count($progress); $i++) {
            for ($j = 0; $j < count($weekdays); $j++) {
                $dat = $progress[$i]["date"]->format("l");
                if ($dat == $weekdays[$j]["weekday"]  && $weekdays[$j]["name"] == $progress[$i]["name"]) {
                    $weekdays[$j]["mark"] = $progress[$i]["mark"];
                }
            }
        }

        for ($i = 0; $i < count($homework); $i++) {
            for ($j = 0; $j < count($weekdays); $j++) {
                $dat = $homework[$i]["date"]->format("l");
                if ($dat == $weekdays[$j]["weekday"]  && $weekdays[$j]["name"] == $homework[$i]["subject"]) {
                    $weekdays[$j]["homework"] = $homework[$i]["name"];
                }
            }
        }

        for ($j = 0, $k = 0, $t = 0, $w = 0,$l = 0, $f = 0; $j < count($weekdays); $j++, $k++, $t++, $w++, $l++, $f++) {
            if ($weekdays[$j]["weekday"] == "Monday"){
                $monday[$k]["name"] = $weekdays[$j]["name"];
                $monday[$k]["mark"] = $weekdays[$j]["mark"];
                $monday[$k]["homework"] = $weekdays[$j]["homework"];
                $monday[$k]["priority"] = $weekdays[$j]["priority"];
            }elseif ($weekdays[$j]["weekday"] == "Tuesday"){
                $tuesday[$t]["name"] = $weekdays[$j]["name"];
                $tuesday[$t]["mark"] = $weekdays[$j]["mark"];
                $tuesday[$t]["homework"] = $weekdays[$j]["homework"];
                $tuesday[$t]["priority"] = $weekdays[$j]["priority"];
            }
            elseif ($weekdays[$j]["weekday"] == "Wednesday"){
                $wednesday[$t]["name"] = $weekdays[$j]["name"];
                $wednesday[$t]["mark"] = $weekdays[$j]["mark"];
                $wednesday[$t]["homework"] = $weekdays[$j]["homework"];
                $wednesday[$t]["priority"] = $weekdays[$j]["priority"];
            }
            elseif ($weekdays[$j]["weekday"] == "Thursday"){
                $thursday[$l]["name"] = $weekdays[$j]["name"];
                $thursday[$l]["mark"] = $weekdays[$j]["mark"];
                $thursday[$l]["homework"] = $weekdays[$j]["homework"];
                $thursday[$l]["priority"] = $weekdays[$j]["priority"];
            }
            elseif ($weekdays[$j]["weekday"] == "Friday"){
                $friday[$f]["name"] = $weekdays[$j]["name"];
                $friday[$f]["mark"] = $weekdays[$j]["mark"];
                $friday[$f]["homework"] = $weekdays[$j]["homework"];
                $friday[$f]["priority"] = $weekdays[$j]["priority"];
            }
        }
        $notes = [];
        for ($i = 0; $i < count($progress); $i++){
            if($progress[$i]["note"] != ""){
                $notes[$i]["note"] = $progress[$i]["note"];
                $notes[$i]["date"] = $progress[$i]["date"];
                $notes[$i]["name"] = $progress[$i]["name"];
            }
        }


        usort($monday,  function($a, $b){
            return strnatcmp($a["priority"], $b["priority"]);
        });

        usort($tuesday,  function($a, $b){
            return strnatcmp($a["priority"], $b["priority"]);
        });

        usort($wednesday,  function($a, $b){
            return strnatcmp($a["priority"], $b["priority"]);
        });

        usort($thursday,  function($a, $b){
            return strnatcmp($a["priority"], $b["priority"]);
        });

        usort($friday,  function($a, $b){
            return strnatcmp($a["priority"], $b["priority"]);
        });

        /*usort($notes,  function($a, $b){
            return strnatcmp($a["date"], $b["date"]);
        });*/

        return $this->render('AppBundle:Pupils:index.html.twig', [
            "monday"    => $monday,
            "tuesday"   => $tuesday,
            "wednesday" => $wednesday,
            "thursday"  => $thursday,
            "friday"    => $friday,
            "nextWeek"  => $nextWeek,
            "prevWeek"  => $prevWeek,
            "id"        => $id,
            "firstDay"  => $firstDay,
            "lastDay"   => $lastDay,
            "number" => $userclass[0]["number"],
            "letter" => $userclass[0]["letter"],
            "notes" => $notes
        ]);
    }

    /**
     * @Route("/pupilRasp/{id}", name="pupilRasp")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function pupilRaspAction($id, Request $request)
    {
        return $this->render("@App/Pupils/findProgress.html.twig",[
            "id" => $id
        ]);
    }


    /**
     * @Route("/pupilRaspGraph", name="pupilRaspGraph")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function pupilRaspGraphAction(Request $request)
    {
        $pupil = $request->request->get("pupil");
        $date = $request->request->get("date");
        $date1 = DateTime::createFromFormat("Y-m-d", $date . "-01");
        $count_date = date("t", strtotime($date1->format("Y-m-d")));
        $date2= DateTime::createFromFormat("Y-m-d", $date . "-" . $count_date);

        $progress1 = $this->getDoctrine()->getRepository("AppBundle:Pupils")
            ->findByProgress($pupil, $date1->format("Y-m-d"), $date2->format("Y-m-d"));

        $string_average_mark_for_month = "[";
        $count_mark = 0;
        $avg_mark = 0;

        for ($j = 1; $j <= $count_date; $j++) {
            $mark = 0;
            $count = 0;
            $average_mark_for_month = 0;

            for ($i = 0; $i < count($progress1); $i++) {
                if ($progress1[$i]["date"]->format("j") == $j) {
                    if ($progress1[$i]["mark"] != 0) {
                        $mark += $progress1[$i]["mark"];
                        $count++;
                        $average_mark_for_month = $mark / $count;
                    }
                }
            }
            $avg_mark += $average_mark_for_month;
            if ($j != $count_date) {
                if ($average_mark_for_month != 0) {
                    $string_average_mark_for_month .= $average_mark_for_month . ',';
                    $count_mark++;
                } else {
                    $string_average_mark_for_month .= "null,";
                }
            } else {
                if ($average_mark_for_month != 0) {
                    $string_average_mark_for_month .= $average_mark_for_month . "]";
                    $count_mark++;
                } else {
                    $string_average_mark_for_month .= "null]";
                }
            }
        }

        $hooky = 0;
        $marks_count_for_month = 0;

        for ($i = 0; $i < count($progress1); $i++) {
            if ($progress1[$i]["mark"] == "н") {
                $hooky++;
            }
            if($progress1[$i]["mark"] != null && $progress1[$i]["mark"] != "н"){
                $marks_count_for_month++;
            }
        }

        if($count_mark != 0){
            $res_mark = $avg_mark / $count_mark;
        } else {
            $res_mark = $count_mark;
        }

        $res = $string_average_mark_for_month . ":" . $res_mark . ":" . $hooky . ":" . $marks_count_for_month;

        return new Response($res);

    }

}
