<?php
    
    include_once "../database/database.php";
    
    if (!empty($_POST['value1']) && !empty($_POST['value2'])) {
        $value1 = $_POST['value1'];
        $value2 = $_POST['value2'];
        $week = false;
        $output = array();

        if (($value1 == 'currentweek' && $value2 == 'lastweek')) {
            $current = (int)date('W');
            $last = (int)date('W') - 1;
            $week = true;
        }
        else if (($value1 == 'currentmonth' && $value2 == 'lastmonth')){
            $current = (int)date('m');
            $last = (int)date('m') - 1;
        }
        else {
            echo json_encode($output);
            die();
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        $db = new Database;
        // So sanh tuan
        if ($week) {
            $sql1 = "select count(*) as count, DATE(date) from cart 
                    where WEEKOFYEAR(cart.date) = '".$current."' 
                    GROUP by DATE(date)";
            $sql2 = "select count(*) as count, DATE(date) from cart 
                    where WEEKOFYEAR(cart.date) = '".$last."' 
                    GROUP by DATE(date)";

            $lastmonday = strtotime('monday last week');
            $monday = strtotime('monday this week');

            for ($i = 0; $i < 7; $i++){
                $output['current'][] = array( $i => date('Y-m-d', $monday),);
                $monday = strtotime('tomorrow', $monday);

                $output['last'][] = array($i => date('Y-m-d', $lastmonday),);
                $lastmonday = strtotime('tomorrow', $lastmonday);
                
            }
        }
        // So sanh thang
        else {
           
            $sql1 = "select count(*) as count, DATE(date) from cart 
                    where MONTH(cart.date) = '".$current."' 
                    GROUP by DATE(date)";
            $sql2 = "select count(*) as count, DATE(date) from cart 
                    where MONTH(cart.date) = '".$last."' 
                    GROUP by DATE(date)";

            $first_day_this_month = strtotime('first day of this month');
            $first_day_last_month = strtotime('first day of last month');


            $max_this_month = date('t', $first_day_this_month);
            $max_last_month = date('t', $first_day_last_month);
            
            for ($i = 0; $i <= 30; $i++){
                if ($i <= $max_this_month - 1) {
                    $output['current'][] = array( $i => date('Y-m-d', $first_day_this_month),);
                    $first_day_this_month = strtotime('tomorrow', $first_day_this_month);
                }

                if ($i <= $max_last_month - 1) {

                    $output['last'][] = array( $i => date('Y-m-d', $first_day_last_month),);
                    $first_day_last_month = strtotime('tomorrow', $first_day_last_month);

                }
                
            }

        }
       
       // $sql = "select id, total, date from cart where WEEK(cart.date) = '".$current."'";
        $result1 = $db->select($sql1);
        $result2 = $db->select($sql2);

     
        if (!empty($result1) && $result1->num_rows > 0) {
            while($row = $result1->fetch_array()) {
                $output['arr1'][] = array(
                    'COUNT' => $row['count'],
                    'DATE' => $row['DATE(date)'],
                );
                
            }
        }
            
        if (!empty($result2) && $result2->num_rows > 0 ) {
            while($row = $result2->fetch_array()) {
                $output['arr2'][] = array(
                    'COUNT' => $row['count'],
                    'DATE' => $row['DATE(date)'],
                );
            }
        }
           
        echo json_encode($output);
    }
  
?>