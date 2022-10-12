<!-- Task_Board_Start -->


<div class="pr-4 pl-4">
    <div class="container">
        <div class="row pt-1 pb-1">
            <div class="col-lg-6">
                <span class="Page_Title"><?= $task[0]->task_title; ?></span>
            </div>
            <div class="col-lg-6">
                <input type="button" onclick="printDiv('printableArea')" class="btn user_invait_btn btn-sm float-right ml-1" value="Print">
                <a href="<?= base_url('Reports/task_reports'); ?>" class="btn user_invait_btn btn-sm float-right ml-1">Back</a>
            </div>
        </div>
        <!-- Main_Row_Task_Section -->


        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) { ?>
            
            <div id="printableArea">
            <div class="row">



                <div class="col-lg-12 p-4 card" >

                    <div class="box-header" style="margin-top: 2px; height: 40px">
                        

              <h3 style="color:green; text-align: center;">
        <span style=" font-size: 30px;font-style: inherit; text-transform: uppercase;"> <?php echo"Task Report " ?>   </span>
              <br>
                
            </div> 

      
    <div class="row" style="display: block; margin-top: 0px;" id="mainRow">
      <div class="col-md-12" style="">
      <div class="box-body pad table-responsive">
        <table class='table table-bordered text-center' id="Order_EntriesTable">
        <tr style="background-color:#ECF9FF;" id="headingRow">
          <th style="padding:5px;">S.#</th>
          <th style="padding:5px; text-align:left;">Task Title</th>
          <th style="padding:5px; text-align:left;">Task Due Date</th>
          <th style="padding:5px; text-align:left;">Milestone</th>
          <th style="padding:5px; text-align:left;">Priority</th>
          <th style="padding:5px; text-align:left;">Notify Days</th>
          <th style="padding:5px; text-align:left;">Description</th>
          <th style="padding:5px; text-align:left;">Project Name</th>
          <th style="padding:5px; text-align:left;">Project Budget</th>
          <th style="padding:5px; text-align:left;">Project Description</th>
          



         </tr>
        <?php
          $SNo = 0;
         
            $SNo++;

            ?>
          
        <tr class="txtMult">
          <td style="padding:5px; "><?php echo $SNo; ?></td>
          <td style="padding:5px;  text-align:left;">
             <?php echo $TaskDetails[0]["task_title"]?>
          </td>
          <td style="padding:5px;  text-align:left;">
             <?php echo $TaskDetails[0]["task_due_date"]?>
          </td>
          <td style="padding:5px;  text-align:left;">
             <?php echo $TaskDetails[0]["task_milestone"]?>
          </td>

          <td style="padding:5px;  text-align:left;">
            <?php echo $TaskDetails[0]["task_priority"]?>
          </td>

          <td style="padding:5px;  text-align:left;">
            <?php echo $TaskDetails[0]["task_notify_days"]?>
          </td>

           <td style="padding:5px;  text-align:left;">
            <?php echo $TaskDetails[0]["task_description"]?>
          </td>

           <td style="padding:5px;  text-align:left;">
            <?php echo $TaskDetails[0]["project_name"]?>
          </td>

           <td style="padding:5px;  text-align:left;">
            <?php echo $TaskDetails[0]["project_budget"]?>
          </td>

           <td style="padding:5px;  text-align:left;">
            <?php echo $TaskDetails[0]["description"]?>
          </td>
        </tr>
       
        </table>

      </div>
    </div>
        </div>
             
                <br>
                <br>
                    <?php if (is_object($tasks) || is_array($tasks)) {
                        $i = 1;
                        $s = 0;
                        $total_subTasks = 0;
                        $total_milestone = 0;

                        foreach ($tasks as $key => $v) : ?>
                            <!-- Task_Box_1_Row_Start -->
                            <div class="row" style="border-bottom: 2px solid grey;">
                                <div class="col-lg-6 pb-1">
                                    <span><?= $v->task_title ?></span>

                                </div>
                                <div class="col-lg-6 pb-1">
                                    <div class="float-right">
                                        <span>Task Amount : <?= $v->task_milestone  ?></span>
                                        <?php $total_milestone = $total_milestone + $v->task_milestone ?>
                                    </div>
                                </div>
                            </div>
                            <!-- 1st_Row_In_Inner_Row_End -->

                            <!-- 2nd_Row_In_Inner_Row_Start -->
                            <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1 || $this->session->userdata('subtask_p_show') == 1) { ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="collapse show pb-3" id="collapseOne<?= $v->project_task_id ?>" aria-labelledby="headingOne" data-parent="#accordion">
                                            <?php
                                            $t = 1;

                                            
                

                                            $total_sub_milestone = 0;
                                            for ($p = 0; $p < count($subtasks[$s]); $p++) {
                                                $st = $subtasks[$s][$p];
                                                if ($st == null) {
                                                } else {
                                            ?>
                                                    <div class="row pt-3 pl-5 pr-5">
                                                        <div class="col-lg-6" style="border-bottom: 1px solid grey;">


                                                            

                                                             
                                                             <div class="container">
                                                                     
                                                                      <div class="row">
                                                                        <div class="col">
                                                                         <span style="margin-left:-14px; font-size: 12px; text-align:center;" ><?= $st->subtask_title ?></span>
                                                                        </div>

                                                                        <div class="col">
                                                                          <span style="font-size: 12px;"><?php echo"Start Date:". " ". $st->start_at;?></span>
                                                                        </div>

                                                                        <div class="col">
                                                                          <span style="font-size: 12px;"><?php echo"Due Date:". " ". $st->subtask_due_date;?></span>
                                                                        </div>
                                                                        <div class="col">
                                                                          <span style=" font-size: 12px;"><?php echo"Complete At:". $st->complete_at;?></span>
                                                                        </div>

                                                                       

                                                                       
                                                                      </div>
                                                                    </div>
                                                        </div>
                                                        <div class="col-lg-6" style="border-bottom: 1px solid grey;">
                                                            


                                                            <div class="row">

                                                                        <div class="col">
                                                                             <span style=" font-size: 12px;"><?php echo"Assigned By:". $v->name;?></span>
                                                                        </div>

                                                                        <div class="col">
                                                                        </div>



                                                                        <div class="col">
                                                                         <div width="10px" class="float-right">
                                                                            <span style="margin-right:-14px; font-size: 12px;">Sub Task Amount : <?= $st->subtask_milestone  ?></span>
                                                                            <?php $total_sub_milestone = $total_sub_milestone + $st->subtask_milestone ?>
                                                                            <?php $total_subTasks = $total_sub_milestone + $total_subTasks ?>
                                                                        </div>


                                                                        </div>

                                                                
                                                                      </div>
                                                        </div>

                                                    </div>
                                                <?php $t++;
                                                }
                                            }
                                            if ($subtasks[$s] == null) {
                                            } else {
                                                ?>
                                                <div class="float-right mb-4 mr-5 mt-2">
                                                    <span style="margin-right: -14px;">Sub Total Amount : <?= $total_sub_milestone ?></span>
                                                    </div>
                                                <?php
                                            }
                                                ?>
                                                </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php $s++;
                            $i++;
                        endforeach;
                            ?>



                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-right pt-3">
                                        
                                        <span style="font-weight:bolder; box-shadow: none;padding: 0.375rem 0.1rem;">Total Amount : <?php echo $TaskDetails[0]["task_milestone"]?></span>
                                        <!--<span style="font-weight:bolder; box-shadow: none;padding: 0.375rem 0.1rem;">Total Amount : <?= $total_milestone  ?></span>-->
                                    </div>
                                </div>
                            </div>



                        <?php
                    } else { ?>
                            <p class="User_Box_Txt">
                                <span class="light_color Bold">No record found...!</span>
                            </p>
                        <?php } ?>
                        <!-- 2nd_Row_In_Inner_Row_End -->
                        <!-- Task_Box_1st_Row_End -->





                        <!-- Drop_Down_End -->
                                </div>
                </div>
            </div>
            </div>
            <!-- secod_Row_End -->

            <!-- 3rd_Row_Start -->

            <!-- 3rd_Row_End -->

    </div>

</div>

<?php } ?>
<!-- Task_Section_Main_Row_End -->
</div>
</div>
<!--Task_Board_End-->




<!-- taskremove -->
<div class="modal fade" id="exampleModalLong_remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle"> Are You Sure You Want to Remove ?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer float-left">

                <form action="<?= base_url('projects/task_delete') ?>" method="post">
                    <input type="text" name="id" value="<?= $id ?>" hidden>
                    <input type="text" name="del" class="de" hidden>
                    <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
                </form>

                <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- taskremove -->

<!-- subtaskremove -->
<div class="modal fade" id="exampleModalLong_subtaskremove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle"> Are You Sure You Want to Remove ?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer float-left">

                <form action="<?= base_url('projects/subtask_delete') ?>" method="post">
                    <input type="text" name="id" class="redir" hidden>
                    <input type="text" name="del" class="dels" hidden>
                    <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
                </form>

                <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- subtaskremove -->

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