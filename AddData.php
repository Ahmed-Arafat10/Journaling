<?php
include("ConfigDB.php");

//Store Today's Date in $Day_ID Variable
$Day_ID = $_SESSION['Day_ID'];
$User_ID = $_SESSION['UserID'];

// Insert Into `To-Do-List` Table New Task For Today's Date
if (isset($_POST['To-Do-ListBTN'])) {
    $Note = $_POST['NoteIN'];
    $InsertQueryToToDoListT = " INSERT INTO `to-do-list` VALUES (NULL,$Day_ID,'$Note',0,$User_ID)";
    $ExceuteAboveQuery = mysqli_query($DB, $InsertQueryToToDoListT);
    if ($ExceuteAboveQuery) PrintMessage("Done Adding New Task","Normal");
    else echo PrintMessage("Failed Adding New Task","Danger");
}


// Insert Into `Diary` Table New Diary For Today's Date
if (isset($_POST['DiaryBTN'])) {
    $Diary = $_POST['DiaryIN'];
    $InsertQueryDiaryT = " INSERT INTO `diary` VALUES (NULL,$Day_ID,'$Diary',$User_ID)";
    $ExceuteAboveQuery = mysqli_query($DB, $InsertQueryDiaryT);
    if ($ExceuteAboveQuery) PrintMessage("Done Adding Today's Diary","Normal");
    else echo PrintMessage("Failed Adding Today's Diary","Danger");
}


// Insert Into `answer_of_questions` Table New Answer of a specific Question For Today's Date
if (isset($_POST['AnswerBTN'])) {
    $Answer = $_POST['AnswerIN'];
    $QuestionID = $_POST['QuestionID'];
    $InsertQueryAnswerT = " INSERT INTO `answer_of_questions` VALUES (NULL,$Day_ID,'$QuestionID','$Answer',$User_ID)";
    $ExceuteAboveQuery = mysqli_query($DB, $InsertQueryAnswerT);
    if ($ExceuteAboveQuery) PrintMessage("Done Adding Answer Of Specific Question","Normal");
    else echo PrintMessage("Failed Adding Answer Of Specific Question","Danger");
}


//If user hasnt logged in this will force him to go to login page
Authunticate();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Add Data Page </h1>
    <h4>Today's Date : <b><?php echo $TodayDate ?> </b> </h4>

    <!-- To-Do-List Container Start -->
    <div class="To-Do-List Container">
        <h1>To-Do-List</h1>
        <div class="row justify-content-center align-items-center h-100">

            <form action="" method="POST">
                <div class="row">
                    <div class="col">
                        <label for="NoteIN"> Note :</label>
                        <input class="form-control" type="text" name="NoteIN" id="" placeholder="Enter Task Here">
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <button type="submit" name="To-Do-ListBTN" class="btn btn-outline-primary text-center col-md">Add task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
 <!-- To-Do-List Container End -->

  <!-- Diary Container Start -->
  <div class="Diary Container">
        <h1>Today's Diary</h1>
        <div class="row justify-content-center align-items-center h-100">   
            <form action="" method="POST">
                <div class="row">
                    <div class="col">
                        <label for="NoteIN"> Diary :</label>
                        <textarea class="form-control" type="text" name="DiaryIN" id="" placeholder="Enter Diary Here"></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <button type="submit" name="DiaryBTN" class="btn btn-outline-warning text-center col-md">Add Diary</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
 <!-- Diary Container End -->


    
    <table class="table table-dark container Container">
        <tr>
            <th>Question</th>
            <th>Input</th>
            <th>Input</th>
        </tr>
        <?php
        //echo $Day_ID;
        $SelcetQuery = " SELECT ANSWERS_TABLE.Date_ID AS DID , ANSWERS_TABLE.Answer AS ANSWER , QUESTIONS_TABLE.Question AS QUESTION_COL , QUESTIONS_TABLE.ID AS QUESTION_ID 
        FROM `predefined-questions` AS QUESTIONS_TABLE LEFT JOIN `answer_of_questions` AS ANSWERS_TABLE
        ON QUESTIONS_TABLE.ID = ANSWERS_TABLE.QuestionID  AND (ANSWERS_TABLE.Date_ID = $Day_ID AND ANSWERS_TABLE.User_ID = $User_ID)
         ";
        $ExceuteAboveQuery = mysqli_query($DB, $SelcetQuery);
        foreach ($ExceuteAboveQuery as $Question) {
        ?>
            <tr>
                <?php if ($Question['ANSWER'] == NULL) : ?>
                    <form action="" method="POST">
                        <td> <label for="AnswerIN"> <?php echo $Question['QUESTION_COL'] ?> </label> </td>
                        <td> <input placeholder="Enter Answer Here" class="form-control" type="text" name="AnswerIN"> </td>
                        <input hidden type="text" name="QuestionID" value="<?php echo $Question['QUESTION_ID'] ?>">
                        <td><button type="submit" name="AnswerBTN" class="btn btn-primary text-center col-md">Add Diary</button> </td>
                    
                    </form>
                <?php endif ?>
            </tr>
        <?php } ?>
    </table>


</body>

</html>