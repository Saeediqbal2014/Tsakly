  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
  <div class="pr-4 pl-4">
    <div class="container">
      <div class="row pt-1 pb-1">
        <div class="col-lg-6">
          <a class="" style=""></a>
          <span class="Page_Title">Manage Task Budget</span>
        </div>
        <div class="col-lg-6">
          <a href="<?= base_url('projects/tasks/' . $id) ?>" class="btn user_invait_btn btn-sm float-right">+ Bact To Tasks</a>
        </div>
      </div>

      <form action="<?= base_url('projects/update_subtask_budget') ?>" method="post" id="validate_form">
        <!-- secod_Row_Start -->
        <div class="row pt-5">
          <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
            <div class="row">
              <div class="col-lg-12">
                <p><strong>Note:</strong> The sum of all subtask milestone must be <= <?= $task_budget->task_milestone ?> beacause the project budget is <?= $task_budget->task_milestone ?>.</p>
                    <p class="text-danger p">The sum of all subtask milestone must be <= <?= $task_budget->task_milestone ?>.</p>
                        <input type="hidden" name="task_id" value="<?= $id ?>">
                        <input type="hidden" name="project_id" value="<?= $project_id ?>">
                        <table class="table">
                          <tr>
                            <th>SNO</th>
                            <th>SubTask Title</th>
                            <th>SubTask Milestone</th>
                          </tr>
                          <?php $i = 1;
                          foreach ($subtasks as $key => $v) : ?>
                            <tr>
                              <td><?= $i ?></td>
                              <td><?= $v->subtask_title ?></td>
                              <td>
                                <input type="hidden" name="subtask_id[]" value="<?= $v->project_subtask_id ?>">
                                <input type="number" name="subtask_milestone[]" id="manage_milestone" step="any" class="form-control my_milestone" required data-parsley-trigger="keyup" data-parsley-type="number" value="<?= $v->subtask_milestone ?>">
                                <span><?= form_error('subtask_milestone[]') ?></span>
                              </td>
                            </tr>
                          <?php $i++;
                          endforeach; ?>
                        </table>
                        <table class="table">
                          <tr>
                            <td width="38%"></td>
                            <td width="5%"><strong>Total=</strong></td>
                            <td><input type="number" class="obtt" style="background:none;border:none;" readonly></td>
                          </tr>
                        </table>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <input type="submit" name="submit" value="Submit" class="btn user_invait_btn subt" style="font-size: 13px">
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- secod_Row_End -->
    </div>
  </div>
  <!--Create_Milestone_End-->
  <script type="text/javascript">
    $(function() {
      $('.p').hide();
      var sum = 0;
      $(".my_milestone").each(function() {
        sum += +$(this).val();
      });
      var obtt = $(".obtt").val(sum);
    });
    $('.my_milestone').on("change keyup", function() {
      var sum = 0;
      $(".my_milestone").each(function() {
        sum += +$(this).val();
      });
      var pb = <?= $task_budget->task_milestone ?>;
      if (sum > pb) {
        $('.p').show();
        $('.subt').prop('readonly', 'readonly');
        $('.subt').removeAttr('type', 'submit');
      } else {
        $('.p').hide();
        var obtt = $(".obtt").val(sum);
        $('.subt').prop('type', 'submit');
        $('.subt').removeAttr('readonly');
      }
    });
  </script>