
<!-- Task_Board_Start -->
<div class="pr-4 pl-4">
    <div class="container">
        <div class="row pt-1 pb-1">
            <div class="col-lg-6">
                <span class="Page_Title"></span>
            </div>
            <div class="col-lg-6">
                <input type="button" onclick="printDiv('printableArea')" class="btn user_invait_btn btn-sm float-right ml-1" value="Print">
                <a href="<?= base_url('Reports/sub_task_reports'); ?>" class="btn user_invait_btn btn-sm float-right ml-1">Back</a>
            </div>
        </div>
        <!-- Main_Row_Task_Section -->
        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) { ?>
        <div id="printableArea">
         

<?php 

if(!empty($sub_t))
{ 


if(!empty($projects))
{    
$sub_task_total_amount=0;
$total_profit=0;
foreach($projects as $project)
{


?>

            <div class="row">
                    <div class="col-lg-12 p-4 card">
                        
<?php


$tasks=$this->mm->fetch_projects_tasks_data($project['project_id']);


if(!empty($tasks))
{    

foreach($tasks as $task)
{



?>

                        <table border="0" class="table">
                            <tbody>
                                <tr>
                                    <td><?php echo $project['project_name'];?></td>
                                     
                                </tr>
                                 <tr>
                                    <td><?php echo $task['task_title'];?></td>
                                                                       
                                    <td align="right">Amount:</td>
                                    <td>
                                        <?php echo $task['task_milestone'];?>
                                            
                                    </td>  
                                </tr>
                                


<?php 



$sub_tasks=$this->mm->fetch_sub_tasks_data($user_id,$task['project_task_id']);


// echo "<pre>";

// print_r($sub_tasks);

if(!empty($sub_tasks))
{    

foreach($sub_tasks as $sub_task)
{





?>


                                <tr>
                                   
                                    <td>Sub Task Name:</td>                                    
                                    <td>
                                        <?php 
                                            echo $sub_task['subtask_title'];
                                        ?>
                                    </td>
                                                                       
                                    <td align="right">Amount:</td>
                                    <td>
                                        <?php 

                                        $sub_task_total_amount+=$sub_task['subtask_milestone'];


                                        echo $sub_task['subtask_milestone'];

                                        ?>
                                            
                                    </td> 
                                </tr>
                                 <tr>
                                    
                                    <td>Period:</td>                                    
                                    <td>



                  <?php

                  $d = date('d-m-Y', strtotime($sub_task['start_at']));

                  // echo $d ."<br>";

                  $td = date('d-m-Y', strtotime($sub_task['subtask_due_date']));
                  // echo $td;
                  if ($d >= $td) {
                    $RemainingDays = '0';
                  } else {
                    $currentDate = strtotime($sub_task['subtask_due_date']);
                    $project_end_date = date('Y-m-d', strtotime($sub_task['start_at']));
                    $project_end_date2 = strtotime($project_end_date);
                    $timeDiff = abs($project_end_date2 - $currentDate);
                    $RemainingDays = $timeDiff / 86400;
                    $RemainingDays = intval($RemainingDays);
                  }
                  ?>
                  <?= $RemainingDays ?>                                        






                                    </td>
                                     
                                </tr>
                                 <tr>
                                    
                                    <td>Complete:</td>                                    
                                    <td>

                  <?php

                  $ddd = date('d-m-Y', strtotime($sub_task['start_at']));

                  // echo $d ."<br>";

                  $tddd = date('d-m-Y', strtotime($sub_task['complete_at']));
                  // echo $td;
                  if ($ddd >= $tddd) {
                    $completeDays = '0';
                  } else {
                    $currentDate1 = strtotime($sub_task['complete_at']);
                    $project_end_datee = date('Y-m-d', strtotime($sub_task['start_at']));
                    $project_end_datee2 = strtotime($project_end_datee);
                    $timeDiff2 = abs($project_end_datee2 - $currentDate1);
                    $completeDays = $timeDiff2 / 86400;
                    $completeDays = intval($completeDays);
                  }
                  ?>
                  <?= $completeDays; ?>                                          
                                   
                           
                                    </td>
                                                            
                                    
                                </tr>
                                 <tr>
                                    
                                    <td>Profit:</td>                                    
                                    <td><?php 
                                    if($RemainingDays!="0")
                                    {    
                                    // $profit=1500/3*2-1500;

                                    $profit=$sub_task['subtask_milestone']/$RemainingDays*$completeDays-$sub_task['subtask_milestone'];
                                    $profit=abs(intval($profit));

                                        if($profit!=0 ||  $profit!="")
                                        {    
                                        $total_profit+=$profit;
                                        }
                                    echo $profit;
                                    }
                                    else
                                    {
                                    $hours=time()+86400;


                                    $profit=$sub_task['subtask_milestone']/$hours*$completeDays-$sub_task['subtask_milestone'];
                                    $profit=abs(intval($profit));

                                        if($profit!=0 ||  $profit!="")
                                        {    
                                        $total_profit+=$profit;
                                        }
                                    echo $profit;


                                    }    

                                    ?>
                                        
                                    </td>
                                    
                                </tr>
                                <tr>
                                    

                                </tr>                                                              

<?php }} ?>


                            </tbody>
                        </table>
<?php }} ?>

                        <!-- Drop_Down_End -->
                    </div>
            </div>
            <br>










<?php }} ?>


<?php 

if(!empty($sub_task))
{

?>

            <div class="row">
                    <div class="col-lg-12 p-4 card">
                        <table border="0"  class="table">
                            <tbody>
                                <tr>
                                    
                                    <td><b>Total sub Task Amount:</b></td>
                                          
                                    <td><b><?php echo $sub_task_total_amount;?></b></td> 
                                </tr>
                                 <tr>
                                   
                                    <td><b>Total profit:</b></td>
                                     
                                    <td><b><?php echo $total_profit;?></b></td>
                                </tr>
                                 <tr>
                                  
                                    
                                </tr>
      
                            </tbody>
                        </table>

                        <!-- Drop_Down_End -->
                    </div>
            </div>
            <br>

<?php } }?>

                        

    </div>

      
</div>
</div>
</div>
<?php } ?>
<!-- Task_Section_Main_Row_End -->
</div>
</div>
<!--Task_Board_End-->



<script type="text/javascript">
    $('.del').click(function() {
        var del = $(this).attr('data');
        $('.de').val(del);
    });
    $('.delsubtask').click(function() {
        var del = $(this).attr('data');
        var redirect = $(this).attr('data-task');
        $('.dels').val(del);
        $('.redir').val(redirect);
    })
    
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>