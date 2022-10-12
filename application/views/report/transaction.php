<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">Transaction Report</h4>
        </div>
        <div class='col-12'>
            <form action="<?= base_url('Reports/fetch_transaction') ?>" method="post">
                <div class="container">
                    <div class="row">

                        <div class="col-3">
                            <label for="">Group</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="group" required data-parsley-required-message="You must select at least one option.">
                                <option selected disabled>select Group</option>
                                <?php foreach ($groups as $key => $v) : $selected = ($_POST["group"] == $v->id) ? 'selected' : '';?>
                                    
                                    <option value="<?= $v->id ?>" <?=$selected?>><?= $v->name ?></option>
                                <?php endforeach; ?>

                            </select>
                            <span style="color:red"><?= form_error('group') ?></span>
                        </div>
                        <div class="col-3">
                            <label for="">From</label>
                            <input type="date" name="from" <?php if (isset($_POST["from"])) { ?> value="<?= $_POST["from"] ?>" <?php } ?> class='form-control'>
                        </div>
                        <div class="col-3">
                            <label for="">To</label>
                            <input type="date" name="to" <?php if (isset($_POST["to"])) {  ?> value="<?= $_POST["to"] ?>" <?php } ?> class='form-control'>
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" style="margin-top : 28px" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12">

            <input type="button" class="btn btn-info float-right" onclick="printDiv('printableArea')" value="Print" />

        </div>


        <div class="col-12 mt-3">
            <div id="printableArea" class="dddd">
                </br>
                <h5 class="text-center d-none ccc"> Transaction Report </h5>
                </br>
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Group</th>
                            <th>Date</th>
                            <th>Month</th>
                            <th>Description</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <?php
                    if (!empty($transactions) and isset($transactions)) {
                        foreach ($transactions as $t) { ?>
                            <tr>
                                <td><?= $t->name ?></td>
                                <td><?= $t->date ?></td>
                                <?php $date = date('d-' . $t->month . '-Y'); ?>
                                <td><?= date('M', strtotime($date)) ?></td>
                                <td><?= $t->description ?></td>
                                <td><?= $t->debit ?></td>
                                <td><?= $t->credit ?></td>


                            </tr>
                    <?php }
                    } ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

<script>
    // $("div.dddd").hide();   
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        $(document).find('h5.ccc').removeClass('d-none');
        window.print();

        document.body.innerHTML = originalContents;
    }
</script>