<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">Task Report</h4>
        </div>
        <div class='col-12'>
            <form action="<?= base_url('Reports/dateWise_sub_task_Report') ?>" method="post">
                <div class="container">
<!--                     <div class="row">

                        <div class="col-4">
                            <label for="">Statring Date</label>
                            <input type="date" name="first_date" <?php if (isset($_POST["first_date"])) { ?> value="<?= $_POST["first_date"]; ?>" <?php } ?> class='form-control'>
                        </div>
                        <div class="col-4">
                            <label for="">Completed Date</label>
                            <input type="date" name="last_date" <?php if (isset($_POST["last_date"])) { ?> value="<?= $_POST["last_date"]; ?>" <?php } ?> class='form-control'>
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" style="margin-top : 28px" class="btn btn-primary">Submit</button>
                        </div>
                    </div> -->
                </div>
            </form>
        </div>

        <div class="col-12 mt-3">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>S.NO</th>
                        <th>User</th>
                        <th>Sub Tasks</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $s_no = 0;
                    foreach ($users as $u) { ?>
                        <tr>
                            <?php $s_no++; ?>
                            <td><?= $s_no ?></td>
                            <td><?= $u->name; ?></td>
                            <td>
                                <?php 

                                $tt=$this->mm->fetch_sub_task($u->user_id);
                                
                                if($tt !="")
                                {    
                                echo count($tt);
                                }

                                ?>
                            </td>
                            <td class="text-center">
                                <?php echo "<a target='_new' href='" . base_url('Reports/view_sub_task/' . $u->user_id) . "'><i style='color:green;' class='fas fa-eye'></i></a>"; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>