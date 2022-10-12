<div class="container">
    <h4 class="text-center">Transactions Details</h4>
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

        <div class="col-12">
            <a href="<?= base_url('Transactions/add_trans') ?>" class="btn btn-dark">Add Transaction</a>
        </div>
        <div class="col-12 mt-4" style="overflow-x:auto;">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Group</th>
                        <th>Sub-Group</th>
                        <th>Date</th>
                        <th>Month</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $t) { ?>
                        <tr>
                            <td><?= $t->gr_name ?></td>
                            <td><?= $t->sg_name ?></td>
                            <td> <?= $date = $t->date ?></td>
                            <td><?= date('M', strtotime($date)) ?></td>
                            <td><?= $t->description ?></td>
                            <td><?= $t->debit ?></td>
                            <td><?= $t->credit ?></td>
                            <td>
                                <?php
                                if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_edit') == 1 || $this->session->userdata('tran_delete') == 1) {
                                ?>
                                    <div class="btn-group Project_Box_Icon ">
                                        <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right p-1">
                                            <ul class="navbar-nav">
                                                <?php
                                                if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_edit') == 1) {
                                                ?>
                                                    <li>
                                                        <a href="Transactions/getTrans/<?= $t->tid ?>" class="nav-link">Edit</a>
                                                    </li>
                                                <?php }
                                                if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_delete') == 1) {
                                                ?>
                                                    <li>
                                                        <a href="#" class="nav-link del_quot" data-toggle="modal" data-target="#myModalrole" data-id="<?= $t->tid ?>">Delete</a>
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Delete Transaction Modal -->
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

                <form action="<?= base_url('Transactions/delete_trans') ?>" method="post">
                    <input type="hidden" name="t_id" class="del_quot_id">
                    <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
                </form>

                <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>