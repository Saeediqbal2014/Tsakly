<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">Projects Report</h4>
        </div>
        <div class='col-12'>
            <form action="<?= base_url('Reports/dateWiseProjectsReport') ?>" method="post">
                <div class="container">
                    <div class="row">

                        <div class="col-4">
                            <label for="">From</label>
                            <input type="date" name="first_date" <?php if (isset($_POST["first_date"])) { ?> value="<?= $_POST["first_date"]; ?>" <?php } ?> class='form-control'>
                        </div>
                        <div class="col-4">
                            <label for="">To</label>
                            <input type="date" name="last_date" <?php if (isset($_POST["last_date"])) { ?> value="<?= $_POST["last_date"]; ?>" <?php } ?> class='form-control'>
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" style="margin-top : 28px" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 mt-3" style="overflow-x:auto;">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                        <th>Budget</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $s_no = 0;
                    foreach ($projects as $p) { ?>
                        <tr>
                            <?php $s_no++; ?>
                            <td><?= $s_no ?></td>
                            <td><?= $p->project_name ?></td>
                            <td><?= $p->project_budget ?></td>
                            <td><?= date('d-M-Y', strtotime($p->start_date)) ?></td>
                            <td><?= date('d-M-Y', strtotime($p->end_date)) ?></td>
                            <td><?= $p->project_status ?></td>
                            <td><?= $p->status_c_or_i ?></td>
                            <td class="text-center">
                                <?php echo "<a href='" . base_url('Reports/view_project_task/' . $p->project_id) . "'><i style='color:green;' class='fas fa-eye'></i></a>"; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>