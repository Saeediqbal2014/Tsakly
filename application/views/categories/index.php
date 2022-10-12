<style type="text/css">
    /*.Category_Tabel .dataTables_paginate{
        padding-top: 4%;
        padding-bottom: 4%;
    }*/
    .Category_Tabel .page-item.active .page-link{
        box-shadow: 0 2px 6px #a4e6fc;
    background-color: #4fd1fe;
    border-color: #3acbfc;
    color: white;
    }
    .Category_Tabel .page-item.active .page-link:hover{
    color: white;
    background-color: #00bfff !important;
    }
</style>
<!-- Category_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
          <a class="" style=""></a><span class="Page_Title">Categories</span>
      </div>
      <div class="col-lg-6">
        <?php 
        if($this->session->userdata('user')==1 || $this->session->userdata('cat_create')==1 || $this->session->userdata('cat_add')==1){
        ?>
          <a href="<?=base_url('categories/insert_form'); ?>" 
           class="btn user_invait_btn float-right">+ Add Category</a>
        <?php } ?> 
      </div>
    </div>
      <!-- secod_Row_Start -->
    <?php 
    if($this->session->userdata('user')==1 || $this->session->userdata('cat_show')==1){
    ?>
    <div class="row pt-5">
      <div class="col-lg-12  card pt-5 pb-5">
          <div class="row">
              <div class="col-lg-12 Category_Tabel ">
                  <!--show alert-->
                    <?php if($this->session->flashdata('error')){?>
                    <div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?=$this->session->flashdata('error');?>
                    </div>
                    <?php } ?>
          <table id="example" 
          class="table table-striped table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Category</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
          <?php if(is_array($categories) || is_object($categories)){ $i=1; foreach($categories as $Key => $v):?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $v->cat_name ?></td>
                <td class="d-flex justify-content-center" style="gap:20px;">
                    <?php 
                    if($this->session->userdata('user')==1 || $this->session->userdata('cat_edit')==1){
                    ?>
                    <?=anchor("categories/edit/{$v->cat_id} ",'<i class="fas fa-pencil-alt"></i>')?>
                    <?php 
                    }
                    if($this->session->userdata('user')==1 || $this->session->userdata('cat_del')==1){
                    ?>
                    <a href=""data-toggle="modal" data-target="#myModalcat" class="delcat"  data="<?=$v->cat_id?>"><i class="fas fa-trash"></i></a>
                    <?php } ?>    
                </td>
            </tr>
          <?php  $i++;endforeach;}?>
        </tbody>
    </table>
      </div>
          </div>
      </div>
    </div> 
    <?php } ?>
      <!-- secod_Row_End -->
  </div>
</div>
            <!--Category_End-->


          <!-- Modal -->


<div class="modal fade" id="myModalcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">  Are You Sure You Want to Remove ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">

        <form action="<?=base_url('categories/delete')?>" method="post">        
            <input type="text" name="del" class="dels" hidden>
        <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
        </form>

        <button type="button" class="btn user_invait_btn" data-dismiss="modal" >No</button>
      </div>
    </div>
  </div>
</div>            
<script type="text/javascript">
  $('.delcat').click(function(){
      var id = $(this).attr('data'); 
      $('.dels').val(id);
  });
</script>