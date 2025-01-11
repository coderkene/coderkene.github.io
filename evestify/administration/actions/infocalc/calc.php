<?php
        //select total number of users here
        $stmt = $actionParam->runQuery("SELECT COUNT(*) FROM tbl_user");
        $stmt->execute(array(":email"));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $totalusers = $row['COUNT(*)'];

       //select total amount deposited
        $stmt = $actionParam->runQuery("SELECT SUM(amount) FROM tbl_deposite");
        $stmt->execute(array(":email"));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $totaldeposited = $row['SUM(amount)'];

        //select total amount withdrawn
        $stats = 1;
        $stmt = $actionParam->runQuery("SELECT SUM(amount) FROM tbl_withdrawal WHERE status=:stats");
        $stmt->execute(array(":stats"=>$stats));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $totalwithdrawn = $row['SUM(amount)'];

        //select number of pending withdrawals
        $stats = 0;
        $stmt = $actionParam->runQuery("SELECT COUNT(*) FROM tbl_withdrawal WHERE status=:stats");
        $stmt->execute(array(":stats"=>$stats));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        $pendingwithdrawals = $row['COUNT(*)'];
        
?>