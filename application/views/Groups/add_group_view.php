<div class="container">

    <div class="row pt-1 pb-1">
        <div class="col-lg-6">
            <a class="" style=""></a><span class="Page_Title">Add Group</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-12">
            <a href="<?= base_url("Groups") ?>" class="btn user_invait_btn float-right">All Groups</a>
        </div>
    </div>

    <form method="POST" action="<?= base_url('Groups/addGroup') ?>">

        <div class="row ">
            <div class="col-lg-12 m-auto card pt-5 pb-5">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Group Name</label>
                        <input type="text" name="group" placeholder="Enter Group Name" class="form-control" />
                        <span style="color:red"><?= form_error('group') ?></span>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a href="<?= base_url('Groups') ?>" class="btn btn-dark ml-1">Cancel</a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>