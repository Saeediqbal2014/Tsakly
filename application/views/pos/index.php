<style type="text/css">
    .nav-link {
        padding: 2px 10px !important;
    }
</style>
<!-- Category_Start -->
<div class="pr-4 pl-4">
    <div class="container">
        <div class="row pt-1 pb-1">
            <div class="col-lg-6">
                <a class="" style=""></a><span class="Page_Title">All Pos </span>
            </div>
            <div class="col-lg-6">
                <a href="<?= base_url('add-item'); ?>" class="btn user_invait_btn float-right">+ Add New Item</a>
            </div>
        </div>
        <!-- secod_Row_Start -->
        <div class="row pt-5">
            <div class="col-lg-12  card pt-5 pb-5">
                <div class="row">
                    <div class="col-lg-12 Category_Tabel ">
                        <!--show alert-->
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-primary alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?= $this->session->flashdata('msg'); ?>
                            </div>
                        <?php } ?>
                        <div class="table table-responsive">

                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Stock</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                        <th>Time</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sno = 1;
                                    if (!empty($items)) {
                                        foreach ($items as $item) {
                                    ?>
                                            <tr>
                                                <th><?=$sno++?></th>
                                                <th><?=$item->name?></th>
                                                <th><?=$item->in_stock?></th>
                                                <th><?=$item->quantity?></th>
                                                <th><?=$item->date?></th>
                                                <th><?=$item->time?></th>
                                            </tr>

                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- secod_Row_End -->
    </div>
</div>
<!--Category_End-->


<!-- Modal -->


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

                <form action="<?= base_url('quotation/delete') ?>" method="post">
                    <input type="hidden" name="del" class="del_quot_id">
                    <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
                </form>

                <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>