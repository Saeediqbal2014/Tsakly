<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Ediit_Project_Start -->
<div class="pr-4 pl-4">
    <div class="container">
        <div class="row pt-1 pb-1">
            <div class="col-lg-6">
                <a></a><span class="Page_Title"><?= $title ?></span>
            </div>
            <div class="col-lg-6">
                <a href="<?= base_url('pos/products'); ?>" class="btn user_invait_btn float-right">+ All Products</a>
            </div>
        </div>
        <?php if ($this->session->flashdata('wrong')) { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $this->session->flashdata('wrong'); ?>
            </div>
        <?php } ?>
        <!-- secod_Row_Start -->
        <form action="<?= base_url('pos/store-product') ?>" method="post" id="validate_form" enctype="multipart/form-data">
            <div class="row pt-3">
                <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Product Name" value="<?= @$row->name ?>">
                                <span style="color:red;"><?= form_error('name') ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="cat_id" class="form-control">
                                            <option> -- Select Category -- </option>
                                            <?php foreach ($cats as $val) : $selected = (@$row->cat_id == $val->id) ? 'selected' : ''; ?>
                                                <option value="<?= $val->id ?>" <?= @$selected ?>> <?= $val->name ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span style="color:red;"><?= form_error('cat_id') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Product Status</label>
                                <select name="in_stock" class="form-control">
                                    <option> -- Select Status -- </option>
                                    <option value="1"> Available </option>
                                    <option value="0"> Out Of Stock </option>
                                </select>
                                <span style="color:red;"><?= form_error('in_stock') ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity" placeholder="Enter Product Quantity" value="<?= @$row->quantity ?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="<?= @$row->price ?>">
                                <span style="color:red;"><?= form_error('price') ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                <?php if ($this->session->flashdata('error')) { ?>
                                    <span style="color:red;"><?= $this->session->flashdata('error'); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($row->id)) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Current Image</label> <br>
                                    <img src="<?= site_url('uploads/product-images/' . $row->image) ?>" width="50%" height="200px">
                                    <input type="hidden" name="existing_img" value="<?= $row->image ?>">
                                    <?php if ($this->session->flashdata('error')) { ?>
                                        <span style="color:red;"><?= $this->session->flashdata('error'); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                    <!--  -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" data-parsley-required-message="Type any description here."><?= @$row->description ?></textarea>
                                <span><?= form_error('description') ?></span>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="row pt-4">

                        <div class="col-lg-12">
                            <input type="hidden" name="id" value="<?= @$row->id ?>">
                            <?php $value = (@$row->id == "") ? 'Add' : 'Update'; ?>
                            <input type="submit" name="btn" class="btn user_invait_btn confirm pop_up" value="<?= $value ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- secod_Row_End -->
    </div>
</div>
<!--Ediit_Project_End-->