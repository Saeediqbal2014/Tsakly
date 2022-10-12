<!-- Project_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a class="" style=""></a><span class="Page_Title">Project</span>
      </div>
    </div>
    <div class="row Project pt-3 pb-3">
      <div class="col-lg-6">
        <?php
        if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_add') == 1) {
        ?>
          <a href="<?= base_url('projects/insert_form'); ?>" class="btn user_invait_btn" style="font-size: 13px">+ Create Project
          </a>
        <?php } ?>
      </div>
      <div class="col-lg-6 mobile-padding-set-taskly">
        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_show') == 1 || $this->session->userdata('proj_p_show') == 1) { ?>
          <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
            <li class="nav-item mr-2">
              <a class="nav-link Project_Id_btn active " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link Project_Id_btn " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">High</a>
            </li>
            <li class="nav-item">
              <a class="nav-link Project_Id_btn" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Medium</a>
            </li>
            <li class="nav-item">
              <a class="nav-link Project_Id_btn" id="pills-last-tab" data-toggle="pill" href="#pills-last" role="tab" aria-controls="pills-last" aria-selected="false">Low</a>
            </li>
          </ul>
        <?php } ?>
      </div>
    </div>
    <?php if ($this->session->flashdata("errorproject")) { ?>
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata("errorproject") ?>
      </div>
    <?php }
    if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_show') == 1 || $this->session->userdata('proj_p_show') == 1) { ?>
      <!-- secod_Row_Start -->
      <div class="row pt-5">
        <div class="col-lg-12">
          <!-- Id_Content_Start -->
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <!--All_Start  -->
              <div class="row">
                <!--all start -->

                <?php if (is_array($projects) || is_object($projects)) {
                  $ua = 0;
                  foreach ($projects as $key => $a) : ?>

                    <div class="col-lg-6 mt-3" style="padding-right: 3%">
                      <div class="row">
                        <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                          <div class="row">
                            <div class="col-lg-6">
                              <a href="<?= base_url('projects/view_details/' . $a->project_id) ?>" class="Project_Title_Color"><?= $a->project_name ?></a>
                            </div>
                            <div class="col-lg-6">
                              <!-- Edit_Drop_Down -->
                              <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                <div class="btn-group Project_Box_Icon float-right">
                                  <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                                    <i class="fas fa-cog"></i>
                                  </button>

                                  <div class="dropdown-menu dropdown-menu-right p-1">
                                    <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" type="button">
                                      <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) { ?>
                                        <button class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                          <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                                          <a href="<?= base_url('projects/edit/' . $a->project_id); ?>" class="text-dark" style="font-size: 12px"> Edit </a>
                                        </button>
                                        <br>
                                      <?php
                                      }
                                      if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                        <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove" class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                          <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                                          <a class="text-dark del" data-toggle="modal" data-target="#myModal" style="font-size: 12px" data="<?= base_url("projects/delete/{$a->project_id}") ?>">
                                            Delete
                                          </a>
                                        </button>
                                      <?php } ?>
                                    </button>
                                  </div>
                                </div>
                              <?php } ?>
                              <!-- Edit_Drop_Down -->
                            </div>
                          </div>
                          <!-- 2nd_row_Start -->
                          <div class="row">
                            <div class="col-lg-12">
                              <?php
                              if ($a->project_status == 'high') {
                                $bg = "bg-danger";
                              } else if ($a->project_status == 'medium') {
                                $bg = "bg-info";
                              } else if ($a->project_status == 'low') {
                                $bg = "bg-secondary";
                              }
                              ?>
                              <a class="Right_Togel_Drop_Item_1_Sub_3 <?= $bg ?> text-white"><?= $a->project_status ?></a>
                              <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                <?= $a->description ?>
                              </p>
                            </div>
                          </div>
                          <!-- 2nd_row_End -->
                          <!-- 3rd_row_Start -->
                          <div class="row pt-2 pb-4">
                            <div class="col-lg-12" style="font-size: 13px">
                              <i class="fas fa-list light_color mr-1"></i>
                              <span class="light_color mr-2"><b><?= $tasks[$ua][0]->c ?></b> Tasks</span>
                              

                             
                            
                              <i class="fas fa-comments light_color mr-1"></i>
                              <span class="light_color"><b><?php echo $comments[$ua][0]; ?></b> Comments</span>
                            </div>
                          </div>
                          <!--  3rd_Row_End-->
                          <!-- 4th_Row_Start -->
                          <div class="row">
                            <div class="col-lg-8">
                              <?php foreach ($pro_users[$ua] as $key1 => $a1) :;
                                if ($a1->img == null) {
                                  $img = base_url('uploads/users/default.png');
                                } else {
                                  $img = base_url('uploads/users/' . $a1->img);
                                } ?>
                                <a href="<?= base_url('/users') ?>" data-toggle="tooltip" data-placement="bottom" title="<?= $a1->name ?>">
                                  <img class="img-fluid rounded-circle mr-2" src="<?= $img ?>" width="30px">
                                </a>
                              <?php endforeach; ?>
                            </div>

                            <div class="col-lg-4">
                              <a href="<?= base_url('projects/view_details/' . $a->project_id) ?>">
                                <button class="btn user_invait_btn float-right" style="font-size: 13px">View More</button>
                              </a>
                            </div>

                          </div>
                          <!-- 4th_Row_End -->
                        </div>
                      </div>
                    </div>
                  <?php $ua++;
                  endforeach;
                } else { ?>
                  <p class="User_Box_Txt">
                    <span class="light_color Bold">No record found...!</span>
                  </p>
                <?php } ?>
                <!-- all end-->
              </div>
              <!--All_End  -->
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <!--ongoing_Start  -->
              <!-- row_1_Start -->
              <div class="row pt-4">
                <!-- one -->
                <?php if (is_array($projects) || is_object($projects)) {
                  $uo = 0;
                  foreach ($projects as $key => $o) :;
                    if ($o->project_status == 'high') { ?>
                      <div class="col-lg-6 mt-3" style="padding-right: 3%">
                        <div class="row">
                          <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                            <div class="row">
                              <div class="col-lg-6">
                                <a href="<?= base_url('projects/view_details/' . $o->project_id) ?>" class="Project_Title_Color"><?= $o->project_name ?></a>
                              </div>
                              <div class="col-lg-6">
                                <!-- Edit_Drop_Down -->
                                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                  <div class="btn-group Project_Box_Icon float-right">
                                    <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                                      <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-1">
                                      <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" type="button">
                                        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) { ?>
                                          <button class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                            <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                                            <a href="<?= base_url('projects/edit/' . $o->project_id); ?>" class="text-dark" style="font-size: 12px"> Edit </a>
                                          </button>
                                          <br>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                          <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove" class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                            <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                                            <a class="text-dark del" data-toggle="modal" data-target="#myModal" style="font-size: 12px" data="<?= base_url("projects/delete/{$o->project_id}") ?>">
                                              Delete
                                            </a>
                                          </button>
                                        <?php } ?>

                                      </button>
                                    </div>
                                  </div>
                                <?php } ?>
                                <!-- Edit_Drop_Down -->
                              </div>
                            </div>
                            <!-- 2nd_row_Start -->
                            <div class="row">
                              <div class="col-lg-12">
                                <a class="Right_Togel_Drop_Item_1_Sub_3 bg-danger text-white"><?= $o->project_status ?></a>
                                <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                  <?= $o->description ?>
                                </p>
                              </div>
                            </div>
                            <!-- 2nd_row_End -->
                            <!-- 3rd_row_Start -->
                            <div class="row pt-2 pb-4">
                              <div class="col-lg-12" style="font-size: 13px">
                                <i class="fas fa-list light_color mr-1"></i>
                                <span class="light_color mr-2"><b><?= $tasks[$uo][0]->c ?></b> Tasks</span>
                                <i class="fas fa-comments light_color mr-1"></i>
                                <span class="light_color"><b>0</b> Comments</span>
                              </div>
                            </div>
                            <!--  3rd_Row_End-->
                            <!-- 4th_Row_Start -->
                            <div class="row">
                              <div class="col-lg-8" style="border: ">
                                <?php foreach ($pro_users[$uo] as $key1 => $o1) :;
                                  if ($o1->img == null) {
                                    $img = base_url('uploads/users/default.png');
                                  } else {
                                    $img = base_url('uploads/users/' . $o1->img);
                                  } ?>
                                  <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?= $o1->name ?>">
                                    <img class="img-fluid rounded-circle mr-2" src="<?= $img ?>" width="30px">
                                  </a>
                                <?php endforeach; ?>
                              </div>

                              <div class="col-lg-4">
                                <a href="<?= base_url('projects/view_details/' . $o->project_id) ?>">
                                  <button class="btn user_invait_btn float-right" style="font-size: 13px">View More</button>
                                </a>
                              </div>

                            </div>
                            <!-- 4th_Row_End -->
                          </div>
                        </div>
                      </div>
                  <?php  };
                    $uo++;
                  endforeach;
                } else { ?>
                  <p class="User_Box_Txt">
                    <span class="light_color Bold">No record found...!</span>
                  </p>
                <?php } ?>
                <!-- one -->
              </div>
              <!-- row_1_End -->
              <!--ongoing_End  -->
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
              <!--Onhold_Start  -->
              <!-- Row_1_Start -->
              <div class="row pt-4">
                <?php if (is_array($projects) || is_object($projects)) {
                  $uh = 0;
                  foreach ($projects as $key => $oh) :;
                    if ($oh->project_status == 'medium') { ?>
                      <!-- one -->
                      <div class="col-lg-6 mt-3" style="padding-right: 3%">
                        <div class="row">
                          <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                            <div class="row">
                              <div class="col-lg-6">
                                <a href="<?= base_url('projects/view_details/' . $oh->project_id) ?>" class="Project_Title_Color"><?= $oh->project_name ?>t</a>
                              </div>
                              <div class="col-lg-6">
                                <!-- Edit_Drop_Down -->
                                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                  <div class="btn-group Project_Box_Icon float-right">
                                    <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                                      <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-1">
                                      <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" type="button">
                                        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) { ?>
                                          <button class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                            <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                                            <a href="<?= base_url('projects/edit/' . $oh->project_id); ?>" class="text-dark" style="font-size: 12px"> Edit </a>
                                          </button>
                                          <br>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                          <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove" class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                            <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                                            <a class="text-dark del" data-toggle="modal" data-target="#myModal" style="font-size: 12px" data="<?= base_url("projects/delete/{$oh->project_id}") ?>">
                                              Delete
                                            </a>
                                          </button>
                                        <?php } ?>

                                      </button>
                                    </div>
                                  </div>
                                <?php } ?>
                                <!-- Edit_Drop_Down -->
                              </div>
                            </div>
                            <!-- 2nd_row_Start -->
                            <div class="row">
                              <div class="col-lg-12">
                                <a class="Right_Togel_Drop_Item_1_Sub_3 bg-info text-white"><?= $oh->project_status ?></a>
                                <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                  <?= $oh->description ?>
                                </p>
                              </div>
                            </div>
                            <!-- 2nd_row_End -->
                            <!-- 3rd_row_Start -->
                            <div class="row pt-2 pb-4">
                              <div class="col-lg-12" style="font-size: 13px">
                                <i class="fas fa-list light_color mr-1"></i>
                                <span class="light_color mr-2"><b><?= $tasks[$uh][0]->c ?></b> Tasks</span>
                                <i class="fas fa-comments light_color mr-1"></i>
                                <span class="light_color"><b>0</b> Comments</span>
                              </div>
                            </div>
                            <!--  3rd_Row_End-->
                            <!-- 4th_Row_Start -->
                            <div class="row">
                              <div class="col-lg-8" style="border: ">
                                <?php foreach ($pro_users[$uh] as $key1 => $oh1) :;
                                  if ($oh1->img == null) {
                                    $img = base_url('uploads/users/default.png');
                                  } else {
                                    $img = base_url('uploads/users/' . $oh1->img);
                                  } ?>
                                  <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?= $oh1->name ?>">
                                    <img class="img-fluid rounded-circle mr-2" src="<?= $img ?>" width="30px">
                                  </a>
                                <?php endforeach; ?>
                              </div>

                              <div class="col-lg-4">
                                <a href="<?= base_url('projects/view_details/' . $oh->project_id) ?>">
                                  <button class="btn user_invait_btn float-right" style="font-size: 13px">View More</button>
                                </a>
                              </div>

                            </div>
                            <!-- 4th_Row_End -->
                          </div>
                        </div>
                      </div>
                  <?php };
                    $uh++;
                  endforeach;
                } else { ?>
                  <p class="User_Box_Txt">
                    <span class="light_color Bold">No record found...!</span>
                  </p>
                <?php } ?>
                <!-- one -->
              </div>
              <!-- Row_1_End -->
              <!--onhold_End  -->
            </div>
            <div class="tab-pane fade" id="pills-last" role="tabpanel" aria-labelledby="pills-last-tab">
              <!--Finished_Start  -->
              <!-- Row_1_Start -->
              <div class="row pt-4">
                <?php if (is_array($projects) || is_object($projects)) {
                  $uf = 0;
                  foreach ($projects as $key => $f) :;
                    if ($f->project_status == 'low') { ?>
                      <!-- one -->
                      <div class="col-lg-6 mt-3" style="padding-right: 3%">
                        <div class="row">
                          <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                            <div class="row">
                              <div class="col-lg-6">
                                <a href="<?= base_url('projects/view_details/' . $f->project_id) ?>" class="Project_Title_Color"><?= $f->project_name ?></a>
                              </div>
                              <div class="col-lg-6">
                                <!-- Edit_Drop_Down -->
                                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                  <div class="btn-group Project_Box_Icon float-right">
                                    <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                                      <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right p-1">
                                      <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" type="button">
                                        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) { ?>
                                          <button class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                            <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                                            <a href="<?= base_url('projects/edit/' . $f->project_id); ?>" class="text-dark" style="font-size: 12px"> Edit </a>
                                          </button>
                                          <br>
                                        <?php }
                                        if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                                          <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove" class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                            <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                                            <a class="text-dark del" data-toggle="modal" data-target="#myModal" style="font-size: 12px" data="<?= base_url("projects/delete/{$f->project_id}") ?>">
                                              Delete
                                            </a>
                                          </button>
                                        <?php } ?>
                                      </button>
                                    </div>
                                  </div>
                                <?php } ?>
                                <!-- Edit_Drop_Down -->
                              </div>
                            </div>
                            <!-- 2nd_row_Start -->
                            <div class="row">
                              <div class="col-lg-12">
                                <a class="Right_Togel_Drop_Item_1_Sub_3 bg-secondary text-white"><?= $f->project_status ?></a>
                                <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                  <?= $f->description ?>
                                </p>
                              </div>
                            </div>
                            <!-- 2nd_row_End -->
                            <!-- 3rd_row_Start -->
                            <div class="row pt-2 pb-4">
                              <div class="col-lg-12" style="font-size: 13px">
                                <i class="fas fa-list light_color mr-1"></i>
                                <span class="light_color mr-2"><b><?= $tasks[$uf][0]->c ?></b> Tasks</span>
                                <i class="fas fa-comments light_color mr-1"></i>
                                <span class="light_color"><b>0</b> Comments</span>
                              </div>
                            </div>
                            <!--  3rd_Row_End-->
                            <!-- 4th_Row_Start -->
                            <div class="row">
                              <div class="col-lg-8" style="border: ">
                                <?php foreach ($pro_users[$uf] as $key1 => $f1) :;
                                  if ($f1->img == null) {
                                    $img = base_url('uploads/users/default.png');
                                  } else {
                                    $img = base_url('uploads/users/' . $f1->img);
                                  } ?>
                                  <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?= $f1->name ?>">
                                    <img class="img-fluid rounded-circle mr-2" src="<?= $img ?>" width="30px">
                                  </a>
                                <?php endforeach; ?>
                              </div>

                              <div class="col-lg-4">
                                <a href="<?= base_url('projects/view_details/' . $f->project_id) ?>">
                                  <button class="btn user_invait_btn float-right" style="font-size: 13px">View More</button>
                                </a>
                              </div>

                            </div>
                            <!-- 4th_Row_End -->
                          </div>
                        </div>
                      </div>
                  <?php };
                    $uf++;
                  endforeach;
                } else { ?>
                  <p class="User_Box_Txt">
                    <span class="light_color Bold">No record found...!</span>
                  </p>
                <?php } ?>
                <!-- one -->
              </div>
              <!-- Row_1_End -->
              <!--finished_End  -->
            </div>
          </div>
          <!-- Id_Content_End -->
        </div>
      </div>
      <!-- secod_Row_End -->
    <?php } ?>
  </div>
</div>
<!--Project_User_End-->