<div class="beranda-area">
      <div class="container">
        <div class="beranda-top">
          <ul>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
            <li class="text-secondary"><?php echo substr(translate(97), 0, strlen(translate(97)) - 1);?></li>
          </ul>
        </div>
        <div class="beranda-main">
          <div class="beranda-main-item">
            <h3><?php echo substr(translate(97), 0, strlen(translate(97)) - 1);?></h3>
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
                                  <h2 class="text-center"><?php echo translate('lupa_password',true);?></h2>
                                  <p><?php echo translate('text_lupa_password',true);?></p>
                                  <div class="panel-body"><font color="red">
                    <?php $msg = ''; if(isset($_SESSION['msg'])){ $msg = $_SESSION['msg']; unset($_SESSION['msg']);} echo $msg; ?></font>
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                    
                                      <div class="form-group">
                                        <div class="input-group">
                                          <!-- script awal yang diedit Nurhayati Rahayu 22 Nopember 2023 -->
                                          <!-- span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span> -->
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                          <!-- script awal yang diedit Nurhayati Rahayu 22 Nopember 2023 -->                                          <input id="username" name="username" placeholder="Username" class="form-control"  > <!-- diubah Rahmat 09/02/2023 placeholder="Username" yang sebelum adalah placeholder="Email" -->
                                        </div>
                                      </div>
                                      <div class="form-group mt-2">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
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