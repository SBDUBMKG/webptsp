<?php 
$lang = $this->session->userdata('bahasa');
if($lang =='_en'){
 ?>
Dear <strong><?php echo $name;?></strong>,
Did you forget your password? 
We received a request to reset the password for your account.
<br />
If you made this request, click the link below. If not, you can ignore this email.
<br />
<a href="<?php echo base_url(). 'reset-password/'. $hash ;?>">Reset</a>
<br/>
--------------------------------------------------------------<br />
This is an automatically generated email – please do not reply to it.
<?php } else { ?>
<strong><?php echo $name;?></strong> yang terhormat, Anda melakukan permintaan perubahan password.
<br />
Untuk dapat mengubah password silahkan klik tautan di bawah ini.
Jika Anda tidak pernah melakukan permintaan perubahan password abaikan email ini.
<br />
<a href="<?php echo base_url(). 'reset-password/'. $hash ;?>">Reset</a>
<br />
--------------------------------------------------------------<br />
Email ini dikirim secara otomatis oleh sistem. Anda tidak perlu membalas atau mengirim email ke alamat ini.
<?php } ?>
