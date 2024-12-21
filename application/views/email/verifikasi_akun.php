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
					<strong><?php echo $nama;?></strong> yang terhormat,
					<br />
					Anda telah membuat akun di website PTSP BMKG Online.
					Klik tombol verify dibawah ini untuk melakukan verifikasi akun anda.
					<br />
					<a href="<?php echo base_url(). 'verifikasi-akun/'.$hash ;?>">Verify</a>
					<br />
					Email ini dikirim secara otomatis oleh sistem. Anda tidak perlu membalas atau mengirim email ke alamat ini.
					<br />
					--------------------------------------------------------------
					<br />
					Dear <strong><?php echo $nama;?></strong>,
					<br />
					You just create new account in PTSP BMKG Online website.
					Click the following url to verify your account.
					<br />
					<a href="<?php echo base_url(). 'verifikasi-akun/'.$hash ;?>">Verify</a>
					<br />
					This is an automatically generated email – please do not reply to it.
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



