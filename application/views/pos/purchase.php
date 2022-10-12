<style type="text/css">
    .nav-link {
        padding: 2px 10px !important;
    }
</style>
<div class="pr-4 pl-4">
    <div class="container">
        <div class="row pt-1 pb-1">
            <div class="col-lg-6">
                <a class="" style=""></a><span class="Page_Title"> <?= $title ?> </span>
            </div>
        </div>
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

        <form action="<?= base_url('pos/purchase') ?>" method="post">
            <div class="row mt-2">
                <div class="col-3">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control form-control-sm cat-dropdown" name="category">
                            <option selected disabled>select any category</option>
                            <option value="all"> All </option>
                            <?php if (!empty($cats)) {
                                foreach ($cats as $key => $v) { ?>
                                    <option value="<?= $v->id ?>"><?= $v->name ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <div class="col-2" style="margin-top: 28px!important;">
                        <input type="submit" name="submit" class="btn btn-sm user_invait_btn confirm pop_up" value="Submit">
                    </div>
                </div>
            </div>
        </form>

        <div class="row pt-5">
            <div class="col-lg-12">
                <!-- Id_Content_Start -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <!--All_Start  -->
                        <div class="row">
                            <?php if (!empty($items)) {
                                foreach ($items as $item) :
                            ?>
                                    <div class="col-xl-4 col-lg-6 Bg_Color mt-2" style="border: 20px solid #F2F4F7;">
                                        <div style="">
                                            <div class="row text-center pb-3">
                                                <div class="col-lg-4">

                                                </div>
                                                <div class="col-lg-4 col-6 text-center">
                                                    <img class="rounded-circle User_Box_img" src="<?= site_url('uploads/product-images/' . $item->image) ?>" width="100%" height="100px">
                                                </div>
                                                <div class="col-lg-4 col-6">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-9 col-9">
                                                    <p class="User_Box_Txt" style="font-size: 11px;">
                                                        <span class="light_color User_Box_Txt_Name Bold"> <?= $item->name ?> </span>
                                                        <span>/ <?= $item->cat_name ?> </span>
                                                    </p>
                                                </div>

                                            </div>

                                            <div class="row mb-1">
                                                <div class="col-lg-12 pb-2">
                                                    <p class="User_Box_Txt">
                                                        <span class="light_color Bold">Status: </span>
                                                        <?php $btn = "";
                                                        if ($item->quantity > 0) {
                                                            $btn = '<p>
                                                            <a class="uview" data="' . $item->id . '" href="javascript:void(0)">
                                                                <button class="btn user_invait_btn float-left" style="font-size: 13px">Buy</button>
                                                            </a>
                                                        </p>';
                                                        ?>
                                                            <span class="badge badge-success"> Available </span>
                                                        <?php } else {
                                                            $btn = '<p>
                                                            <a class="" data="' . $item->id . '" href="javascript:void(0)">
                                                                <button class="btn user_invait_btn float-left" style="font-size: 13px">Request For This Item</button>
                                                            </a>
                                                        </p>'; ?> <span class="badge badge-danger"> Out Of Stock </span> <?php } ?>
                                                    </p>
                                                    <?php if ($this->session->userdata('user') != 1) {
                                                        echo $btn;
                                                    }  ?>
                                                    <p>
                                                        <a class="" data="">
                                                            <button class="btn user_invait_btn float-right" style="font-size: 13px">View details</button>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach;
                            } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>


<!-- userview -->
<div class="modal fade" id="modaluview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle"> Buy </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pos/buy-item') ?>" class="buy-item-form" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control item-name" readonly>
                            </div>
                        </div>
                        <input type="hidden" class="item-id" name="item_id">
                        <input type="hidden" class="item-stockH">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control item-price" name="price" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>In Stock</label>
                                <input type="number" class="form-control item-stock" name="stock" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control purchase-qty" name="qty">
                                <span class="qty-err" style="color:red;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-success buy-item-btn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <!-- <button type="submit" class="btn user_invait_btn float-left">Submit</button> -->
                <button type="button" class="btn user_invait_btn float-right " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- userview -->

<script>
    $(document).on("click", '.uview', function() {
        const item_id = $(this).attr("data");
        $.ajax({
            type: "GET",
            url: "<?= site_url('Pos/getItemDetail') ?>",
            data: {
                item_id: item_id
            },
            success: function(data) {
                res = JSON.parse(data);
                $(".item-name").val(res.name);
                $(".item-price").val(res.price);
                $(".item-id").val(res.id);
                $(".item-stock").val(res.quantity);
                $(".purchase-qty").val('');
                $(".buy-item-btn").removeClass("d-none");
                $(".qty-err").text("");
                $(".purchase-qty").css("border", "");

                $("#modaluview").modal('show');
            }
        });
    });

    $(document).on("keyup", ".purchase-qty", function(e) {
        // console.log(e.keyCode); return;
        let val = parseInt($(this).val());
        let stock = parseInt($(".item-stock").val());
        if (val > stock) {
            $(this).css("border", "1px solid red");
            $(".qty-err").text("Your entered quantity has exceded our stock limit ! please enter quantity in a range.");
            $(".buy-item-btn").addClass("d-none");
        } else if (val < stock) {
            $(this).css("border", "");
            $(".qty-err").text("");
            $(".buy-item-btn").removeClass("d-none");
        }

        if (e.keyCode == 8 && $(this).val() == "") {
            $(".qty-err").text("Please Enter Quantity");
            $(".buy-item-btn").addClass("d-none");
        }

        if (val == stock) {
            $(this).css("border", "");
            $(".qty-err").text("");
            $(".buy-item-btn").removeClass("d-none");
        }

    });


    // $(document).on("change",".cat-dropdown",function(){
    //     let cat_id = $(this).children("option:selected").val();

    // });
</script>