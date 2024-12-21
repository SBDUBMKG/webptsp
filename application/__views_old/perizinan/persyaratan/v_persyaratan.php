<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
      <div class="table-responsive">
      <table class="table table-bordered" id="datatable">
          <thead>
          <tr>
              <th style="width: 20px;">No</th>
              <th>Judul</th>
              <th>Download</th>
          </tr>
          </thead>
          <tbody>
          	<?php
          	$nomor = 1;
          	foreach ($persyaratan as $ip) {
          		?>
          		<tr>
          			<td><?php echo $nomor ?></td>
          			<td><a href="<?php echo base_url().'library/rpiit/?data='.$ip['kode'] ?>" style="font-size:12px;font-weight:bold;" onclick="window.open(this.href, 'auth', 'width=800,height=400'); return false;"><?php echo $ip['judul']; ?></a><br/>
          				<?php echo $ip['kategori'] ?></td>
          			<td class="text-center">
          				<a href="<?php echo base_url().'library/rpiit/?data='.$ip['kode'] ?>" style="font-size:12px;font-weight:bold;" onclick="window.open(this.href, 'auth', 'width=800,height=400'); return false;"><span class="fa fa-download"></span></a>
          			</td>
          		</tr>
          		<?php
          		$nomor++;
          	}
          	?>
          </tbody>
      </table>
      </div>
    </div>
  </main>
</div>
