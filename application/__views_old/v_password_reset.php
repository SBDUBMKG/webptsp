<div class="wrapper row3">
    <section class="hoc container clear"> 
    <div class="left_content">
      <div class="single_post_content">
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <ol class="breadcrumb">
                <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li>
                Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->


                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="#"><?= translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->


                <li class="active"><?php echo translate(31);?></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <!-- filter -->
              <div class="box box-default">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="text-center">
                                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                                  <h2 class="text-center"><?php echo translate('reset_password',true);?></h2>
                                  <p><?php echo translate('txt_reset_password',true);?></p>
                                  <div class="panel-body">
                    <font color="green">
                    <?php $msg = ''; if(isset($_SESSION['msg'])){ $msg = $_SESSION['msg']; unset($_SESSION['msg']);} echo $msg; ?></font>
                                    <form id="reset-form" role="form" autocomplete="off" class="form" method="post">
                    
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                          <input id="new_password" name="new_password"  class="form-control" type="password" >
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <input name="reset-pass" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                      </div>
                                      
                                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                                    </form>
                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                  </div>

                </div>
              </div>
            </section>
          </div>
      </div>
    </div>
  </section>
</div>
