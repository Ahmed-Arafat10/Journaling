<?php

namespace App;

class Date
{
    public function storeTodaysDateIfNeeded()
    {
        $myDb = new DB();
        $myDb->connect();
        // Store Value Of Today's Date With This Format (2022-1-9) In This Variable
        $curDate = date("Y-m-d");
        //Check if today's date already exist in `Date` Table
        $selectQuery = "SELECT * FROM `date` WHERE `Date` = ? ";
        $stmt = $myDb->Con->prepare($selectQuery);
        $stmt->bind_param('s', $curDate);
        $stmt->execute();
        $result = $stmt->get_result();
        //If today's date does not exist in `Date` Table, THEN insert it in Table
        if ($result->num_rows == 0) {
            $insertQuery = "INSERT INTO `Date` VALUES(NULL,?)";
            $insertStmt = $myDb->Con->prepare($insertQuery);
            $insertStmt->bind_param('s', $curDate);
            $insertStmt->execute();

            // SELECT Today's Date row to be able to store it's ID in $day_id variable after fetching row
            $selectQuery = "SELECT * FROM `date` WHERE Date = ? ";
            $stmt = $myDb->Con->prepare($selectQuery);
            $stmt->bind_param('s', $curDate);
            $stmt->execute();
            $day_id = $stmt->get_result()->fetch_assoc()['ID'];

            $_SESSION['date_id'] = $day_id; # VIP: To Make Today's Date ID Global among ALL Pages
            $_SESSION['date'] = $curDate;
        } else {
            $day_id = $result->fetch_assoc()['ID'];
            $_SESSION['date_id'] = $day_id; # VIP: To Make Today's Date ID Global among ALL Pages
            $_SESSION['date'] = $curDate;
        }

    }
}