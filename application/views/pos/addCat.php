<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Ediit_Project_Start -->
<div class="pr-4 pl-4">
    <div class="container">
        <div class="row pt-1 pb-1">
            <div class="col-lg-6">
                <a></a><span class="Page_Title">Create New Pos Category</span>
            </div>
            <div class="col-lg-6">
                <a href="<?= base_url('pos/categories'); ?>" class="btn user_invait_btn float-right">+ All Categories</a>
            </div>
        </div>
        <!-- secod_Row_Start -->
        <form action="<?= base_url('pos/store-category') ?>" method="post" id="validate_form">
            <div class="row pt-3">
                <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Category Name" data-parsley-required-message="Type only Characters." value="<?=@$row->name?>">
                                <span style="color:red;"><?= form_error('name') ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <?php if(isset($row->status)){ ?>
                                            <?php $selected1 = ($row->status == 1) ? 'selected' : '' ;?>
                                            <?php $selected2 = ($row->status == 0) ? 'selected' : '' ;?>
                                            <?php }?>
                                            <option> -- Select Status -- </option>
                                            <option value="1" <?=@$selected1?> > Active </option>
                                            <option value="0" <?=@$selected2?> > Inactive </option>
                                        </select>
                                        <span><?= form_error('status') ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."><?=@$row->description?></textarea>
                                <span><?= form_error('description') ?></span>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="row pt-4">

                        <div class="col-lg-12">
                            <input type="hidden" name="id" value="<?=@$row->id?>">
                            <input type="submit" name="submit" class="btn user_invait_btn confirm pop_up" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- secod_Row_End -->
    </div>
</div>
<!--Ediit_Project_End-->