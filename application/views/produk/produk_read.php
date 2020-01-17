
        <h2 style="margin-top:0px">Produk Read</h2>
        <table class="table">
	    <tr><td>Nama Produk</td><td><?php echo $nama_produk; ?></td></tr>
	    <tr><td>Kategori</td><td><?php echo $kategori; ?></td></tr>
	    <tr><td>Kode</td><td><?php echo $kode; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	     <tr><td>Gambar 1</td><td> <a href="<?php echo base_url();?>assets/produk/<?php echo $gambar1; ?>" target="_blank"><img src="<?php echo base_url();?>assets/produk/<?php echo $gambar1; ?>" width="150px"></a></td></tr>
	    <tr><td>Gambar 2</td><td> <a href="<?php echo base_url();?>assets/produk/<?php echo $gambar2; ?>" target="_blank"><img src="<?php echo base_url();?>assets/produk/<?php echo $gambar2; ?>" width="150px"></a></td></tr>
	     <tr><td>Gambar 3</td><td> <a href="<?php echo base_url();?>assets/produk/<?php echo $gambar3; ?>" target="_blank"><img src="<?php echo base_url();?>assets/produk/<?php echo $gambar3; ?>" width="150px"></a></td></tr>
	    <tr><td>Gambar 4</td><td> <a href="<?php echo base_url();?>assets/produk/<?php echo $gambar4; ?>" target="_blank"><img src="<?php echo base_url();?>assets/produk/<?php echo $gambar4; ?>" width="150px"></a></td></tr>
	    <tr><td>Gambar 5</td><td> <a href="<?php echo base_url();?>assets/produk/<?php echo $gambar5; ?>" target="_blank"><img src="<?php echo base_url();?>assets/produk/<?php echo $gambar5; ?>" width="150px"></a></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
      