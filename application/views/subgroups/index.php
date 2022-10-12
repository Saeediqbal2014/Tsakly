<div class="container">
    <div class="row pt-1 pb-1">
        <div class="col-lg-6">
            <a class="" style=""></a><span class="Page_Title">Sub Groups</span>
        </div>
    </div>

    <div class="row">

        <?php if ($this->session->flashdata('insert')) { ?>
            <div class="col-6 offset-3">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <span><?= $this->session->flashdata('insert') ?></span>
                </div>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('update')) { ?>
            <div class="col-6 offset-3">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <span><?= $this->session->flashdata('update') ?></span>
                </div>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('delete')) { ?>
            <div class="col-6 offset-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <span><?= $this->session->flashdata('delete') ?></span>
                </div>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="col-6 offset-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <span><?= $this->session->flashdata('error') ?></span>
                </div>
            </div>
        <?php } ?>



        <?php

        $this->session->userdata('subgroup_add');
        $this->session->userdata('user');
        
         
        if ($this->session->userdata('subgroup_add') == 1 && $this->session->userdata('user') == 10) {                          
        ?>
        <div class="col-12">
            <a href="<?= base_url('Groups/add_subgroup') ?>" class="btn btn-dark float-right">Add Sub Group</a>
        </div>
        <?php
         }

         else if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_add') == 1) {                          
        ?>
        <div class="col-12">
            <a href="<?= base_url('Groups/add_subgroup') ?>" class="btn btn-dark float-right">Add Sub Group</a>
        </div>
        <?php
         }

         else if ($this->session->userdata('subgroup_add') == 1 && $this->session->userdata('user') == 8) {                          
        ?>
        <div class="col-12">
            <a href="<?= base_url('Groups/add_subgroup') ?>" class="btn btn-dark float-right">Add Sub Group</a>
        </div>
        <?php
         }
        ?>
        <div class="col-12 mt-4 card pt-3">
            <table class="table table-light table-striped">
                <thead class="thead-light">
                    <tr>
                        <th style="width:10%" class="text-center">S.No</th>
                        <th style="width:80%">Name</th>
                        <th style="width:10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($subgroup)) {
                        $s_no = 0;
                        foreach ($subgroup as $g) { ?>
                            <tr>
                                <?php $s_no++ ?>
                                <td class="text-center"><?= $s_no ?></td>
                                <td><?= $g->name ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_edit') == 1 || $this->session->userdata('subgroup_delete') == 1) {
                                    ?>
                                        <div class="btn-group Project_Box_Icon ">
                                            <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right p-1">
                                                <ul class="navbar-nav">
                                                    <?php
                                                    // foreach($rolespermissons as $rp){
                                                    
                                                    
                                                        // print_r($this->session->userdata('subgroup_edit')); die();
                                                    if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_edit') == 1) {
                                                      
                                                    ?>
                                                        <li>
                                                            
                                                           
                                                            <a href="<?= base_url() ?>Groups/subgoupedit/<?= $g->id ?>" class="nav-link">Edit</a>
                                                        </li>
                                                    <?php } 
                                                    if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_delete') == 1) {

                                                        
                                                    ?>
                                                        <li>
                                                            <a href="#" class="nav-link del_quot delete" data-toggle="modal" alt-deleteid='<?= $g->id ?>' data-target="#myModalrole" data-id="<?= $g->id ?>">Delete</a>
                                                        </li>
                                                    <?php }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(".delete").click(function() {
        var id = $(this).attr("alt-deleteid");

    });
</script>

<!-- Delete Group Modal -->
<div class="modal fade" id="myModalrole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle"> Are You Sure You Want to Remove ?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer float-left">
                <form action="<?= base_url('Groups/delete_subgroup') ?>" method="post">
                    <input type="hidden" name="id" class="del_quot_id">
                    <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
                </form>

                <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>