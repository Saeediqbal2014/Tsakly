//projectleader
<?php
              foreach($emp as $key => $v):;
              if($this->session->userdata('id') == $v->user_id )
              {
                if($v->user_role == 1){

              ?>
              <a href="<?=base_url('projects/insert_form_of_new_member/'.$project->project_id); ?>" class="btn user_invait_btn float-right" style="font-size: 13px">
              <!--     <i class="fas fa-envelope text-white mr-1" style="font-size: 12px"></i> -->+ Add
              </a>
              <?php
               }
              };endforeach;?>

//projectleader

                <!-- 4th_Row -->
                      <div class="row pt-4">
                        <div class="col-lg-12 card bn pt-2 pb-2" 
              style="border-top:2px solid #4fd1fe!important">
              <!-- 1st_row_Start -->
                          <div class="row pt-3">
                            <div class="col-lg-6">
                              <h6 class="Secondry_Font_Color mt-2">
                                Team Members (5)
                              </h6>
                            </div>
                            <div class="col-lg-6">
                              <a href="<?=base_url('projects/insert_form_of_milestone/'.$project->project_id); ?>" 
                                        class="btn user_invait_btn float-right" style="font-size: 13px">
                                          <!-- <i class="fas fa-envelope text-white mr-1" style="font-size: 12px"></i> -->
                                            Create Milestone
                              </a>
                            </div>
                          </div>
                          <!-- 1st_row_End -->
                          <!-- 2nd_Row_Start -->
                            <div class="row pt-4">
                              <div class="col-lg-11 m-auto pb-2"
                  style="border: 1px solid rgba(120,130,140,.13);">
                                <div class="row">
                                  <div class="col-lg-2">
                                    <div class="ribbon ribbon-corner">
                                      <span class="milestone-count">#1</span>
                                    </div>
                                  </div>
                                <div class="col-lg-10 pt-5">
                                  <div class="row">
                                    <div class="col-lg-8">
                                      <h3 class="Project_Detail_Mil" 
                                      style="font-weight: 300;">Mile 1</h3>
                                    </div>
                                    <div class="col-lg-4">
                                      <div class="float-right">
                <a href="#" class="btn btn-sm btn-outline-danger float-right mt-1 ml-1">
                    <i class="fas fa-trash" style="font-size: 11px"></i>
                </a>

                <a href="#" class="btn btn-sm btn-outline-info float-right mt-1">
                    <i class="fas fa-pencil-alt" style="font-size: 11px"></i>
                </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-8">
                <a class="Right_Togel_Drop_Item_1_Sub_3 bg-warning text-white">InComplete</a>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="float-right">
                                      <p style="font-size: 14px"><b>Milestone Cost: </b> $1,000</p>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                                </div>
                              </div>
                            </div>
                          <!-- 3rd_Row_End -->

                          <div class="row pt-4">
                              <div class="col-lg-11 m-auto pb-2"
                  style="border: 1px solid rgba(120,130,140,.13);">
                                <div class="row">
                                  <div class="col-lg-2">
                                    <div class="ribbon ribbon-corner">
                                      <span class="milestone-count">#1</span>
                                    </div>
                                  </div>
                                <div class="col-lg-10 pt-5">
                                  <div class="row">
                                    <div class="col-lg-8">
                                      <h3 class="Project_Detail_Mil" 
                                      style="font-weight: 300;">Mile 1</h3>
                                    </div>
                                    <div class="col-lg-4">
                                      <div class="float-right">
                <a href="#" class="btn btn-sm btn-outline-danger float-right mt-1 ml-1">
                    <i class="fas fa-trash" style="font-size: 11px"></i>
                </a>

                <a href="#" class="btn btn-sm btn-outline-info float-right mt-1">
                    <i class="fas fa-pencil-alt" style="font-size: 11px"></i>
                </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-8">
                <a class="Right_Togel_Drop_Item_1_Sub_3 bg-warning text-white">InComplete</a>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="float-right">
                                      <p style="font-size: 14px"><b>Milestone Cost: </b> $1,000</p>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                                </div>
                              </div>
                            </div>
                          <!-- 4th_inner_Row_End -->
                          <div class="row pt-4">
                              <div class="col-lg-11 m-auto pb-2"
                  style="border: 1px solid rgba(120,130,140,.13);">
                                <div class="row">
                                  <div class="col-lg-2">
                                    <div class="ribbon ribbon-corner">
                                      <span class="milestone-count">#1</span>
                                    </div>
                                  </div>
                                <div class="col-lg-10 pt-5">
                                  <div class="row">
                                    <div class="col-lg-8">
                                      <h3 class="Project_Detail_Mil" 
                                      style="font-weight: 300;">Mile 1</h3>
                                    </div>
                                    <div class="col-lg-4">
                                      <div class="float-right">
                <a href="#" class="btn btn-sm btn-outline-danger float-right mt-1 ml-1">
                    <i class="fas fa-trash" style="font-size: 11px"></i>
                </a>

                <a href="#" class="btn btn-sm btn-outline-info float-right mt-1">
                    <i class="fas fa-pencil-alt" style="font-size: 11px"></i>
                </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-8">
                <a class="Right_Togel_Drop_Item_1_Sub_3 bg-warning text-white">InComplete</a>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="float-right">
                                      <p style="font-size: 14px"><b>Milestone Cost: </b> $1,000</p>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                                </div>
                              </div>
                            </div>
                          <!-- 4th_inner_Row_End -->
                        </div>
                      </div>
                    <!-- 4th_Row -->