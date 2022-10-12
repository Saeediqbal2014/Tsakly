<div class="container">


    <div class="row pt-1 pb-1">
        <div class="col-lg-6">
            <a class="" style=""></a><span class="Page_Title">Add Sub Group</span>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <a href="<?= base_url("Groups/subgroup") ?>" class="btn user_invait_btn float-right">All Sub Groups</a>
        </div>
    </div>

    <form method="POST" action="<?= base_url('Groups/addsubgroup') ?>">
        <div class="row ">
            <div class="col-lg-12 m-auto card pt-5 pb-5">
                <div class="row">
                    <div class="col-6">
                        <label>Sub Group Name</label>
                        <input type="text" name="name" placeholder="Enter Sub Group Name" class="form-control" />
                        <span style="color:red"><?= form_error('name') ?></span>
                    </div>
                    <div class="col-6">
                        <label>Select Group</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="group" required data-parsley-required-message="You must select at least one option.">
                            <option selected disabled>select Group</option>
                            <?php foreach ($groups as $key => $v) : ?>
                                <option value="<?= $v->id ?>"><?= $v->name ?></option>
                            <?php endforeach; ?>

                        </select>
                        <span style="color:red"><?= form_error('name') ?></span>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button class="btn btn-primary form-control col-1">Submit</button>
                        <a href="<?= base_url('Groups/subgroup') ?>" class="btn btn-dark ml-1 form-control col-1">Cancel</a>
                    </div>
                </div>
    </form>
</div>