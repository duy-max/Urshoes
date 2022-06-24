<?php
    
    include_once "../database/database.php";

    if (!empty($_POST['value'])) {
        $value = $_POST['value'];
        if ($value == 'currentweek') {
            $week = (int)date('W');
        }
        else if ($value == 'lastweek')  {
            $week = (int)date('W') - 1;
        }
        else if ($value == 'currentmonth') {
            $month = (int)date('m');
        }

        
        $db = new Database;
        if (!empty($week)) {
            $sql = "select count(*) as count, DATE(date) from cart 
                    where WEEKOFYEAR(cart.date) = '".$week."' 
                    GROUP by DATE(date);";
        }
        else {
            $sql = "select count(*) as count, DATE(date) from cart 
                    where MONTH(cart.date) = '".$month."' 
                    GROUP by DATE(date);";
        }
       // $sql = "select id, total, date from cart where WEEK(cart.date) = '".$week."'";
        $result = $db->select($sql);
        $output = array();
        if (!empty($result) && $result->num_rows > 0) {
            while($row = $result->fetch_array()) {
                $output[] = array(
                    'COUNT' => $row['count'],
                    'DATE' => $row['DATE(date)'],
                );
            }
            echo json_encode($output);
        }
        else echo json_encode($output);
    }
  
?>