<?php
header("Content-type: application/json; charset=UTF-8");
//echo "hello

$message=$_POST["message"];

if ($message=="Login"){

   $data=array(
       "message"=> $message,
       "ucid" => $_POST["ucid"],
       "pass" => $_POST["pass"]
   );
}

elseif ($message=="CreateQuestion"){
   $data=array(
       "message"=> $message,
       "testCases" => $_POST["testCases"],
       "testCaseResult" => $_POST["testCaseResult"],
       "parameters"=>$_POST["parameters"],
       "funcName" => $_POST["funcName"],
       "description" => $_POST["description"],
       "difficulty" => $_POST["difficulty"],
       "type" => $_POST["type"]
   );
}
elseif ($message=="CreateExam"){
   $data=array(
       "message" => $message,
       "examName" => $_POST["examName"],
       "questionID" => $_POST["questionID"],
       "points" => $_POST["points"]
   );
}
elseif ($message=="ReleaseExam"){
   $data=array(
       "message" => $message,
       "examId" => $_POST["examId"],
       "questionID" => $_POST["questionID"],
       "comments" => $_POST["comments"],
       "grade" => $_POST["grade"],
       "if" => $_POST["if"],
       "loop" => $_POST["loop"],
       "while" => $_POST["while"],
       "print"=>$_POST["print"],
       "return" => $_POST["return"],
       "funcName" => $_POST["funcName"],
       "extra" => $_POST["extra"]);
}

elseif ($message=="TakeExam"){
   $data=array(
       "message" => $message,
       "examId" => $_POST["examId"],
       "questionID" => $_POST["questionID"],
       "code"=> $_POST["code"],
       "points" =>$_POST["points"]
   );
}
elseif ($message=="GetExam"){
   $data=array(
       "message" => $message,
       "examId" => $_POST["examId"]
   );
}
elseif ($message=="GetQuestions"){
   $data=array(
       "message" => $message,
       "id" => $_POST["id"]
   );
}
elseif ($message=="StudentViewExam"){
   $data=array(
       "message" => $message,
       "examId" => $_POST["examId"]
   );
}
elseif ($message=="InstructorViewExam"){
   $data=array(
       "message" =>$message,
       "examId" =>$_POST["examId"]
   );
}

$link = "https://web.njit.edu/~aoa52/cs490/info.php";
$myCurl = curl_init();

curl_setopt($myCurl, CURLOPT_POSTFIELDS, $data);
curl_setopt($myCurl, CURLOPT_URL, $link);
curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, TRUE);

$responseVar = curl_exec($myCurl);
curl_close($myCurl);
echo $responseVar;
?>
