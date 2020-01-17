
        <h2 style="margin-top:0px">Order <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Link Produk <?php echo form_error('link_produk') ?></label>
            <input type="text" class="form-control" name="link_produk" id="link_produk" placeholder="Link Produk" value="<?php echo $link_produk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Whatsapp <?php echo form_error('no_whatsapp') ?></label>
            <input type="text" class="form-control" name="no_whatsapp" id="no_whatsapp" placeholder="No Whatsapp" value="<?php echo $no_whatsapp; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Undian <?php echo form_error('no_undian') ?></label>
            <input type="text" class="form-control" name="no_undian" id="no_undian" placeholder="No Undian" value="<?php echo $no_undian; ?>" />
        </div>
	  
	    <input type="hidden" name="id_order" value="<?php echo $id_order; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('order') ?>" class="btn btn-default">Cancel</a>
	</form>
   