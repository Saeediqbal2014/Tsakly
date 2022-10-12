<?php
   $projects=$this->bm->getAll('projects');
                    $m=0; $arr= array();
                    foreach ($projects as $key => $v)
                    {
                      $d=date('d-m-Y',strtotime($v->end_date));
                      $nd = strtotime($d.'-'.$v->notify_days.' days');
                      $nd2 = date("d-m-Y", $nd);
                      if($nd2 == date('d-m-Y'))
                      {
                        $notifications[$m]=$this->bm->getRowsWithMultipleConditions('projects',array('project_id' => $v->project_id));
                        // $mynotify = array(
                        // 	'pro_id' => $notifications[$m][0]->project_id
                        // );
                        $arr[$m]=array(
                    		'project_id' => $notifications[$m][0]->project_id,
                    		'project_name' => $notifications[$m][0]->project_name,
                    		'end_date' => $notifications[$m][0]->end_date
                    	);
                      }
                      else
                      {
                        echo "no";
                      }
                      $m++;
                    }
                    
                    echo"<pre>";print_r($arr);
                    $this->session->set_userdata('abc',$arr);

                    print_r($this->session->userdata('abc'));
                    exit();




                    // clearInterval()
// window.setInterval(function(){
//   /// call your function here
// }, 5000)
//duplicate ids
// $ids = Array(1, 1, 2, 3);
// $quants = Array(10, 20, 30, 40);

// $a = array_unique($ids);
// $a = array_combine($a, array_fill(0, count($a), 0));

// foreach($ids as $k=>$v) {
//   $a[$v] += $quants[$k];
// }

// print_r($a);


//1
// $arr = array("PHP", "HTML", "CSS", "", "JavaScript", null, 0);
// print_r(array_filter($arr)); // removing blank, null, false, 0 (zero) values
// Array
// (
//     [0] => PHP
//     [1] => HTML
//     [2] => CSS
//     [4] => JavaScript
// )
//1

//2
//$arr = array("PHP", "HTML", "CSS", "", "JavaScript", null, 0);
//print_r(array_values(array_filter($arr)));
// Array
// (
//     [0] => PHP
//     [1] => HTML
//     [2] => CSS
//     [3] => JavaScript
// )
//2
//remove null indexes
// $user_reports = array_map('array_filter', $user_reports);
// $user_reports = array_values($user_reports['reports']);