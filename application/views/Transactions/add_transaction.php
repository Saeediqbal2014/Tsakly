        <form action="add_transaction" method="post">
            <div class="container">


                <div class="row pt-1 pb-1">
                    <div class="col-lg-6">
                        <a class="" style=""></a><span class="Page_Title">Add Transactions</span>
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

                            <div class="col-6">
                                <label for="">Groups</label>
                                <select class="form-control changeGroups" name="group" id="group">
                                    <option value="">--Select--</option>
                                    <?php foreach ($groups as $g) { ?>
                                        <option value="<?= $g->id ?>"><?= $g->name ?></option>
                                    <?php } ?>
                                </select>

                                <span class='col-6' style="color:red"><?= form_error('group') ?></span>

                            </div>

                            <div class="col-6">
                                <label>Date</label>
                                <input type="text" data-dropup-auto="false" class="form-control datepicker" name="date" required  placeholder="MM/DD/YYYY" data-date-format="DD/MM/YYYY" />
                                <span class='col-6' style="color:red"><?=form_error('date');?></span>
                            </div>
                            <div class="col-12 projectsss d-none" id="project">
                                <label for="">Projects</label>
                                <select class="form-control projectss" name="project">
                                    <option value="">--Select--</option>
                                    <?php foreach ($projects as $p) { ?>
                                        <option value="<?= $p->project_id ?>"><?= $p->project_name ?></option>
                                    <?php } ?>
                                </select>

                                <span class='col-12' style="color:red"><?= form_error('project') ?></span>
                            </div>
                            
                            <div class="col-12 sub_g d-none">
                                <label for="">Sub Groups</label>
                                <select class="form-control subg_groupss" name="subg_group" id="" required>
                                    <option value=""> -- Select -- </option>

                                </select>

                                <span class='col-12' style="color:red"><?= form_error('subg_group') ?></span>

                            </div>
                            <div class="col-12">
                                <label for="">Balance</label>

                                <input type="number" name="balance" class="form-control" required />
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="balance type" value="debit" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Debit
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="balance type" value="credit">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Credit
                                    </label>
                                </div>
                            </div>
                            <span class='col-12' style="color:red"><?= form_error('balance') ?></span>
                            <br>
                            <div class="col-12">
                                <label for="">Description</label>
                                <!-- <input type="text" name="description" class="form-control" /> -->
                                <textarea name="description" id="" cols="15" class="form-control" rows="5" required></textarea>
                                <span class='col-12' style="color:red"><?= form_error('description') ?></span>
                            </div>
                            <button class="btn btn-primary mt-2 ml-3">Submit</button>
                            <a class="btn btn-dark mt-2 ml-1 " href="index">Cancel</a>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    
        <script>
            // $(document).ready(function() {
            //     $("#group").on("change", function() {
            //         var id = $(this).val();
            //         // alert();
            //         var value = $(this).find("option:selected").text();
            //         if (value == 'projects' || value == 'Projects' || value == 'project' || value == 'Project') {
            //             $("#project").removeClass("d-none");
            //             $("#project").find("select").attr("required", "required");
            //         } else {
            //             $("#project").addClass("d-none");
            //             $("#project select").removeAttr("required");
            //         }
            //         $.ajax({
            //             url: "<?= base_url('Groups/get_subg/') ?>",
            //             method: "post",
            //             dataType: "json",
            //             data: {
            //                 id: id
            //             },
            //             success: function(res) {
            //                 if (res.length > 0) {
            //                     $(".sub_g").removeClass("d-none");

            //                     for (a = 0; a < res.length; a++) {
            //                         $(".sub_g select").html("<option value=''>--Select--</option><option value='" + res[a].id + "'>" + res[a].name + "</option>");
            //                     }
            //                 } else {
            //                     $(".sub_g").addClass("d-none");
            //                 }
            //             }
            //         })
            //     })
            // })
        </script>
        