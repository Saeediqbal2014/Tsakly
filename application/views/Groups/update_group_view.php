<div class="container">
    <form method="POST" action="<?= base_url('Groups/updateGroup') ?>">
        <h4 class="text-center">Update Group</h4>
        <div class="row mt-5">
            <div class="col-8">
            <input type="hidden" name="id" value="<?= $group[0]->id ?>">
                <input type="text" name="group" value="<?= $group[0]->name ?>" class="form-control" />
                <span style="color:red"><?= form_error('group') ?></span>
            </div>
            <button class="btn btn-primary form-control col-1">Submit</button>
            <a href="<?= base_url('Groups') ?>" class="btn btn-dark ml-1 form-control col-1">Cancel</a>
        </div>
    </form>
</div>