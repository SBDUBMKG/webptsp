<div class="beranda-area">
      <div class="container">
        <div class="beranda-top">
          <ul>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
            <li class="text-secondary"><?php echo translate(31);?></li>
          </ul>
        </div>
        <div class="beranda-main">
          <div class="beranda-main-item">
            <h3><?php echo translate(31);?></h3>
            <div class="Jumlah-border">
              <div class="Jumlah-border-left Jumlah-border-left3"></div>
              <div class="Jumlah-border-right Jumlah-border-right3"></div>
            </div>
          </div>
          <div class="beranda-main2">
            <div class="row mt-3 p-3" style="background-color: #D9EBE1; border-radius: 30px;">
                    <div class="col-md-12">
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
                                      <div class="form-group mt-3">
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
      </div>
    </div>