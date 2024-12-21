
<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
  <tr>
    <td align="center">
      <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
        <tr>
          <td align="center">
            <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" class="container590">
              <tr>
                <td align="center" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                  <div style="line-height: 24px">
										<?php 
										$lang = $this->session->userdata('bahasa');
										if($lang =='_en'){
										 ?>
										Dear <strong><?php echo $name;?></strong>,
										<br />
										Did you forget your password? 
										We received a request to reset the password for your account.
										<br />
										If you made this request, click the link below. If not, you can ignore this email.
										<br />
										<a href="<?php echo base_url(). 'reset-password/'. $hash ;?>">Reset Password</a>
										<br/>
										--------------------------------------------------------------<br />
										This is an automatically generated email – please do not reply to it.
										<?php } else { ?>
										<strong><?php echo $name;?></strong> yang terhormat, 
										<br />	
										Anda melakukan permintaan perubahan password.	
										<br />
										Untuk dapat mengubah password silahkan klik tautan di bawah ini.
										Jika Anda tidak pernah melakukan permintaan perubahan password abaikan email ini.
										<br />
										<a href="<?php echo base_url(). 'reset-password/'. $hash ;?>">Reset Password</a>
										<br />
										--------------------------------------------------------------<br />
										Email ini dikirim secara otomatis oleh sistem. Anda tidak perlu membalas atau mengirim email ke alamat ini.
										<?php } ?>
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>