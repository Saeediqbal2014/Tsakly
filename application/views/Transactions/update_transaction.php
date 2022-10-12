<form action="<?= base_url("Transactions/updateTransaction") ?>" method="post">
    <div class="container">
        <?php $t = $transaction[0] ?>

        <div class="row pt-1 pb-1">
            <div class="col-lg-6">
                <a class="" style=""></a><span class="Page_Title">Update Transactions</span>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12">
                <a href="<?= base_url("Transactions") ?>" class="btn user_invait_btn float-right">All Transactions</a>
            </div>
        </div>

        <div class="row ">
            <div class="col-lg-12 m-auto card pt-5 pb-5">
                <div class="row">

                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('id') ?>">
                    <input type="hidden" name="date" value="<?= date('d-m-Y') ?>">
                    <input type="hidden" name="month" value="<?= date('m') ?>">
                    <div class="col-6">
                        <label for="">Groups</label>
                        <input type="hidden" name="trans_id" value="<?= $t->tid ?>">
                        <select name="group" id="group" class="form-control changeGroups">
                            <option value="<?= $t->gid ?>"><?= $t->gname ?></option>
                            <?php foreach ($groups as $g) { ?>
                                <option value="<?= $g->id ?>"><?= $g->name ?></option>
                            <?php } ?>
                        </select>

                        <span class='col-6' style="color:red"><?= form_error('group') ?></span>

                    </div>
                    <div class="col-6">
                        <label>Date</label>
                        <input type="text" data-dropup-auto="false" class="form-control datepicker" name="date" required data-date-format="DD/MM/YYYY" value="<?= $t->date ?>"/>
                        <span class='col-6' style="color:red"><?=form_error('date');?></span>
                    </div>

                    <div class="projectsss col-12 <?php if ($t->project_id == 0) {
                                            echo "d-none";
                                        } ?>" id="project">
                        <label for="">Projects</label>
                        <input type="hidden" name="prev_amnt" value="<?php if ($t->debit > 0) {
                                                                            echo $t->debit;
                                                                        } else {
                                                                            echo $t->credit;
                                                                        } ?>">
                        <select class="form-control" name="project">
                            <option value="">--Select--</option>
                            <?php foreach ($projects as $p) { ?>
                                <option value="<?= $p->project_id ?>" <?php if ($t->project_id == $p->project_id) {
                                                                            echo "selected";
                                                                        } ?>><?= $p->project_name ?></option>
                            <?php } ?>
                        </select>

                        <span class='col-12' style="color:red"><?= form_error('project') ?></span>

                    </div>
                    <div class="col-12 sub_g">
                        <label for="">Sub Groups</label>
                        <select class="form-control subg_groupss" name="subg_group" id="" required>
                            <option value="<?= $t->sgid ?>"><?= $t->sgname ?></option>

                        </select>

                        <span class='col-12' style="color:red"><?= form_error('subg_group') ?></span>

                    </div>
                    <div class="col-12">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="balance" value="<?php if ($t->debit > 0) {
                                                                                            echo $t->debit;
                                                                                        } else {
                                                                                            echo $t->credit;
                                                                                        } ?>" required>
                        <input type="hidden" name="old_debit" value="<?= $t->debit ?>">
                        <input type="hidden" name="old_credit" value="<?= $t->credit ?>">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="balance_type" value="debit" <?php if ($t->debit > 0) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                Debit
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="balance_type" value="credit" <?php if ($t->credit > 0) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                Credit
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="15" rows="5" class="form-control" required><?= $t->description ?></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary">Submit</button>
                        <a href="<?= base_url('Transactions') ?>" class="btn btn-dark">Cancel</a>
                    </div>

                </div>
            </div>
        </div>
</form>


<script>
    $(document).ready(function() {
        $("#group").on("change", function() {
            var id = $(this).val();
            // alert();
            var value = $(this).find("option:selected").text();
            if (value == 'projects' || value == 'Projects' || value == 'project' || value == 'Project') {
                $("#project").removeClass("d-none");
                $("#project").find("select").attr("required", "required");
            } else {
                $("#project").addClass("d-none");
                $("#project select").removeAttr("required");
            }
            $.ajax({
                url: "<?= base_url('Groups/get_subg/') ?>",
                method: "post",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.length > 0) {
                        $(".sub_g").removeClass("d-none");

                        for (a = 0; a < res.length; a++) {
                            $(".sub_g select").html("<option value=''>--Select--</option><option value='" + res[a].id + "'>" + res[a].name + "</option>");
                        }
                    } else {
                        $(".sub_g").addClass("d-none");
                    }
                }
            })
        })
    })
</script>