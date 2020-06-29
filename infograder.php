<?php

//Post fields from the frontend login to backend
    header('Content-Type: application/json;charset=utf-8');
    $request = file_get_contents("php://input");
    $message=$_POST['message'];
//$message="StudentViewExam";
    $username =$_POST["ucid"];
    $password =$_POST["pass"];
    $testCaseResult=$_POST["testCaseResult"];
    $login = ["ucid" => $username, "pass" => $password];
    //create question
    $question_description=$_POST['description'];
    $funcName=$_POST['funcName'];
    $question_test_cases=$_POST['testCases'];
    $question_type=$_POST['type'];
    $question_difficulty=$_POST['difficulty'];
    $parameters=$_POST["parameters"];
    //create exam
    $examName =$_POST['examName'];
    $questionID=$_POST['questionID'];
    $points =$_POST['points'];
    $return=$_POST['return'];
    $if=$_POST['if'];
    $while=$_POST['while'];
    $print=$_POST['print'];//none
    $loop=$_POST['loop'];
    $extra=$_POST['extra'];
    $grade=$_POST['grade'];
    $comments=$_POST['comments'];

    //take exam
    $examId =$_POST['examId'];
    $code=$_POST['code'];

    $release_data=["examId"=>$examId,
        "questionID"=>$questionID,
        "comments"=>$comments,
        "grade"=>$grade,
        "loop"=>$loop,
        "print"=>$print,
        "if"=>$if,
        "while"=>$while,
        "return"=>$return,
        "funcName"=>$funcName,
        "extra"=>$extra
    ];

    $exam_data=["examName"=>$examName,
    "questionID"=>$questionID,
    "points"=>$points];

    $take_exam=["examId"=>$examId,
    "questionID"=>$questionID,
    "code"=>$code,
    "points"=>$points];

    $question_data=["description"=>$question_description,
        "funcName"=>$funcName,
        "testCases"=>$question_test_cases,
        "testCaseResult"=>$testCaseResult,
        "parameters"=>$parameters,
        'type'=>$question_type,
        'difficulty'=>$question_difficulty];
    function getBetween($string, $start = "", $end = ""){
        if (strpos($string, $start)) { // required if $start not exist in $string
            $startCharCount = strpos($string, $start) + strlen($start);
            $firstSubStr = substr($string, $startCharCount, strlen($string));
            $endCharCount = strpos($firstSubStr, $end);
            if ($endCharCount == 0) {
                $endCharCount = strlen($firstSubStr);
            }
            return substr($firstSubStr, 0, $endCharCount);
        } else {
            return '';
        }
    }
function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $initial = strpos($string, $start)+4;
    if ($initial == 0) return '';
    $initial += strlen($start);
    $len = strpos($string, $end, $initial) - $initial;
    return substr($string, $initial, $len);
}
function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}
    //login function
    function login($login){
        $backend_url = 'https://web.njit.edu/~rss76/490/alpha.php';
        $ch = curl_init();
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($login));
        $exec = curl_exec($ch);
        $backend_response= json_decode($exec, true);
        $response = json_encode($backend_response);
        return $response;
    }

    //create question
    function create_question($data){
        $backend_url = 'https://web.njit.edu/~rss76/490/add_question.php';
        $ch = curl_init();
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $exec = curl_exec($ch);
        $backend_response = json_decode($exec, true);
        $response = json_encode($backend_response);
        return $response;
    }
    function view_questions($data){
        $backend_url='https://web.njit.edu/~rss76/490/viewquestions.php';
        $ch = curl_init();
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $exec = curl_exec($ch);
        $backend_response = json_decode($exec, true);
        $response = json_encode($backend_response);
        //return $backend_url;
        return $response;
    }
    function create_exam($examdata){
        //Login through backend
        $backend_url = 'https://web.njit.edu/~rss76/490/addexam.php';
        $ch = curl_init();
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($examdata));
        $exec = curl_exec($ch);
        $backend_response= json_decode($exec, true);
        $response = json_encode($backend_response);
        return $response;
    }
    function show_exam($takedata){
        $backend_url = 'https://web.njit.edu/~rss76/490/getexam.php';
        $ch = curl_init();
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($takedata));
        $exec = curl_exec($ch);
        $backend_response= json_decode($exec, true);
        $response = json_encode($backend_response);
        return $response;
    }
    function view_question_exam($data){
        $backend_url = 'https://web.njit.edu/~rss76/490/viewquestionexam.php';
        $ch = curl_init();
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $exec = curl_exec($ch);
        $backend_response= json_decode($exec, true);
        $response = json_encode($backend_response);
        return $response;
    }
    function take_exam($exam){
        $backend_url = 'https://web.njit.edu/~rss76/490/takeexam.php';
        $ch = curl_init();
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($exam));
        $exec = curl_exec($ch);
        $backend_response= json_decode($exec, true);
        $response = json_encode($backend_response);
        return $response;
    }
    function ins_exam($examId){
        $backend_url = 'https://web.njit.edu/~rss76/490/getstudentexam.php';
        $ch = curl_init();
        $examId=["examId"=>$examId];
        //Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($examId));
        $exec = curl_exec($ch);
        $backend_response= json_decode($exec, true);
        $response = json_encode($backend_response);
        return $response;
    }
    function exam_release($examId){
        //$backend_response = 0;
        $examId=["examId"=>$examId];
        $return=array(); //none
        $loop=array();
        $funcName=array();
        $if=array();
        $print=array();
        $while=array();
        $extra=array();//only zero when no extra deduc
        $badName=array();
        $pointsArray=array();
        $i=0;
        $numTC = 0;
        $stuOut = array();
        $pointsArray[$i]=0;
        $backend_url = 'https://web.njit.edu/~rss76/490/examgrade.php';
        //$backend_url = 'https://web.njit.edu/~rss76/490/fakeBack.php';
        $ch = curl_init();
//Login through backend
        curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($examId));
        $exec = curl_exec($ch);
        $execErr = curl_error($ch);

        if($execErr){
            echo "Error".$execErr;
        }
        /*else{
            echo $exec."here";
        }*/
        curl_close($ch);

        $backend_response= json_decode($exec, true);
//$points=$backend_response['points'];
        $functionName=$backend_response["functionName"];
        $questionID=$backend_response["questionID"];
        $type=$backend_response["type"];
        $description=$backend_response["description"];
        $grade=$backend_response["grade"];
        $points=$backend_response["points"];
        $comments=$backend_response["comments"];
        $answers=$backend_response["code"];
        $testCase=$backend_response["testCase"];
        $testOutputs=$backend_response["testCaseResult"];
        $numTestCase=$backend_response["numTestCase"];
        $parameters=$backend_response["parameters"];
        $numParameter=$backend_response["numParameter"];

//$testCase=array();
//foreach($backend_response as $data) {
//        array_push($functionName,$data["functionName"]);
//        array_push($answers,$data["answers"]);
//        array_push($testCase,$data["testCase"]);
//}

        for($x=0;$x<count($functionName);$x++){
            //echo $functionName[$x];
            $temp=$answers[$x];
            //echo $type[$x];
            //echo $temp;
            $name=get_string_between($temp," ","(");
            if($name!==$functionName[$x]){
                $badName[$x]=true;
                $funcName[$x]=5;
            }
            else{
                $badName[$x]=false;
            }
            if($badName[$x]){
                $pointsArray[$x]=5;
            }
            if($type[$x]==="if"&&strpos($temp,$type[$x])===false){ //&& strpos($temp,"if")>0
                //echo "hiya";
                $if[$x]=3;
                $pointsArray[$x]+=3;
            }
            if($type[$x]=="loop" &&strpos($temp,"for")===false){
                $loop[$x]=3;
                $pointsArray[$x]+=3;
            }
            if($type[$x]=="while" &&strpos($temp,$type[$x])===false){
                $while[$x]=3;
                $pointsArray[$x]+=3;
            }
            if($type[$x]=="print"  &&strpos($temp,$type[$x])===false){
                $print[$x]=3;
                $pointsArray[$x]+=3;
            }
            if($type[$x]=="return"  &&strpos($temp,$type[$x])===false){
                $return[$x]=3;
                $pointsArray[$x]+=3;
            }
            $mytemp=$answers[$x];
            $mytemp= preg_replace('/\p{C}+/u', "", $mytemp);
            $temp=getBetween($answers[$x],")"," ");
            if(strpos($temp,":")===false){
                $extra[$x]=3;
                $pointsArray[$x]+=3;
            }
        }

        for($x=0;$x<count($functionName);$x++){
            $temp=$answers[$x];
            $thistemp=getBetween($answers[$x],")"," ");
            //echo $thistemp;
            //echo strpos($thistemp,":");
            if(strpos($thistemp,":")===false){
                $extra[$x]=3;
                //$pointsArray[$x]+=3;
            }
            if($badName[$x]===true || strpos($thistemp,":")===false){
                $str=get_string_between($answers[$x]," ","(");
                $search= array($str,$thistemp);
                $reparr=array($functionName[$x],":");
                //echo $str;
                //$replace=str_replace($str,$functionName[$x],$answers[$x]);
                $replace=str_replace_first($str,$functionName[$x],$answers[$x]);
                $replace=str_replace_first($thistemp,":\n",$replace);
                //print_r($replace." hi");

                $stuCase=$replace;
                //echo $stuCase;
                //echo $replace;
            }
            else {
                $stuCase = $answers[$x];
                //echo $stuCase;
            }
            ////for each question
            //echo $numTestCase[$x];
            for($y=0;$y<$numTestCase[$x];$y++) {
                $handle = fopen("/afs/cad/u/a/o/aoa52/public_html/cs490/grade.py", 'w+') or die("didn't work, sad");
                fwrite($handle, $stuCase . "\n");
                //echo $stuCase;
                fclose($handle);
                $testcase = str_replace(";",",",$testCase[$numTC]);

                //echo "this is the test case ".$testCase[$numTC]."\n";
                if(strpos($answers[$x],"return")!==false){
                    $tester="print". "(" . $functionName[$x]."(".$testcase .")"." )";
                }
                else{
                    $tester = $functionName[$x] . "(" . $testcase . ")";
                }
                $handler = fopen("/afs/cad/u/a/o/aoa52/public_html/cs490/grade.py", 'a');
                fwrite($handler, $tester);
                fclose($handler);
                exec("/usr/bin/python /afs/cad/u/a/o/aoa52/public_html/cs490/grade.py ?2>&1", $stuOut);
                //print_r($stuOut)
                $numTC++;
            }
        }
        for($w=0;$w<count($functionName);$w++) {
            //echo "first".$w."\n";
            for ($j = 0; $j < $numTestCase[$w]; $j++) {
                //echo "second".$j."\n";
                if ($testOutputs[$j] !== $stuOut[$j]) {
                    $pointsArray[$w]+=5;
                }
            }
        }
        //print_r($pointsArray);
        /*echo("this output ");
        print_r($stuOut);
        echo("test output ");
        print_r($testOutputs);*/
        for($z=0;$z<count($points);$z++){
            $grade[$z]=$points[$z]-$pointsArray[$z];
        }
        //print_r($points);
        $data=array("functionName"=>$functionName,
            "questionID"=>$questionID,
            "type"=>$type,
            "description"=>$description,
            "output"=>$stuOut,
            "test output"=>$testOutputs,
            "pointsss"=>$pointsArray,
            "grade"=>$grade,
            "temp"=>$thistemp,
            "name"=>$name,
            "str"=>$str,
            "bad names"=>$badName,
            "points"=>$points,
            "comments"=>$comments,
            "code"=>$answers,
            "if"=>$if,
            "print"=>$print,
            "while"=>$while,
            "return"=>$return,
            "loop"=>$loop,
            "funcName"=>$funcName,
            "extra"=>$extra
        );
        $thisdata=json_encode($data);
        return $thisdata;
    }
    function release($examrelease){
    $backend_url = 'https://web.njit.edu/~rss76/490/releaseexam.php';
    $ch = curl_init();
    //Login through backend
    curl_setopt($ch, CURLOPT_URL, $backend_url);//URL For backend
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($examrelease));
    $exec = curl_exec($ch);
    $backend_response= json_decode($exec, true);
    $response = json_encode($backend_response);
    return $response;
}
    if($message =="Login"){
        echo login($login);
    }
    elseif($message=="CreateQuestion"){
        echo create_question($question_data);
    }
    elseif($message=="CreateExam"){
        echo create_exam($exam_data);
    }
    elseif($message=="GetQuestions"){
        echo view_questions($question_data);
    }
    elseif($message=="GetExam"){
        echo show_exam($examId);
        //echo view_question_exam($examId);
    }
    elseif ($message=="InstructorViewExam"){
        echo ins_exam($examId);
    }
    elseif ($message=="TakeExam"){
        echo take_exam($take_exam);
    }
    elseif ($message=="StudentViewExam"){
        echo exam_release($examId);
    }
    elseif ($message=="ReleaseExam"){
        echo release($release_data);
    }

?>
