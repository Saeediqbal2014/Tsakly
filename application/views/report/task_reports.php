<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">Task Report</h4>
        </div>
        



        <div class="col-12 mt-3" style="overflow-x:auto;">
            <table class="table table-light" id="myTable">
                <thead class="thead-light">
                    <tr>
                        <th>S.NO</th>
                        <th>Task Title</th>
                        <th>Task Due Date</th>
                        <th>Milestone</th>
                        <th>Priority</th>
                        <th>Project_name</th>
                        <th>Project Budget</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $s_no = 0;
                    foreach ($taskDetails as $p) { ?>
                        <tr>
                            <?php $s_no++; ?>
                            <td><?= $s_no ?></td>
                            <td><?= $p->task_title ?></td>
                            <td><?= date('m/d/Y', strtotime($p->task_due_date)) ?></td>
                            <td><?= $p->task_milestone ?></td>
                            <td><?= $p->task_priority ?></td>
                            <td><?= $p->project_name ?></td>
                            <td><?= $p->project_budget ?></td>
                            <td class="text-center">
                                <?php echo "<a href='" . base_url('Reports/view_task_reports/' . $p->project_task_id) . "'><i style='color:green;' class='fas fa-eye'></i></a>"; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>