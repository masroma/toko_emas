
        <h2 style="margin-top:0px">Produk <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="int">Nama Produk <?php echo form_error('nama_produk') ?></label>
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kategori <?php echo form_error('kategori') ?></label>
            
            <select class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>">
             <?php foreach($data_kategori as $row ) { ?>
                   <option <?php if($row->kategori == $kategori){ echo 'selected="selected"'; } ?> value="<?php echo $row->kategori ?>"><?php echo $row->kategori;?> </option>
                 
              <?php }?>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Kode <?php echo form_error('kode') ?></label>
            <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" />
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
         <div class="form-group">
               <?php if($gambar1 != null) { ?>
                   <img src="<?php echo base_url();?>assets/produk/<?php echo $gambar1;?>" width="150px"/>
               <?php } else { ?>
               <p style="margin-bottom:-10px;">photo gambar belum diisi</p>
               <?php } ?><br/>
            <label for="varchar">Gambar 1 <?php echo form_error('gambar1') ?></label>
            
              <?php if($this->uri->segment(3)=='create'){?>
                <input type="file" class="form-control" name="gambar1" value="<?php echo $gambar1; ?>" id="gambar" placeholder="Gambar" />
            <?php } else { ?>
                <input type="file" class="form-control" name="gambar1" id="gambar" placeholder="Gambar" />
            <input type="hidden" class="form-control" name="gambar1_lama" id="gambar" placeholder="Gambar" value="<?php echo $gambar1; ?>" />
            <?php } ?>
        </div>

        <div class="form-group">
               <?php if($gambar2 != null) { ?>
                   <img src="<?php echo base_url();?>assets/produk/<?php echo $gambar2;?>" width="150px"/>
               <?php } else { ?>
               <p style="margin-bottom:-10px;">photo gambar belum diisi</p>
               <?php } ?><br/>
            <label for="varchar">Gambar 2 <?php echo form_error('gambar2') ?></label>
            
              <?php if($this->uri->segment(3)=='create'){?>
                <input type="file" class="form-control" name="gambar2" value="<?php echo $gambar2; ?>" id="gambar" placeholder="Gambar" />
            <?php } else { ?>
                <input type="file" class="form-control" name="gambar2" id="gambar" placeholder="Gambar" />
            <input type="hidden" class="form-control" name="gambar2_lama" id="gambar" placeholder="Gambar" value="<?php echo $gambar2; ?>" />
            <?php } ?>
        </div>

        <div class="form-group">
               <?php if($gambar3 != null) { ?>
                   <img src="<?php echo base_url();?>assets/produk/<?php echo $gambar3;?>" width="150px"/>
               <?php } else { ?>
               <p style="margin-bottom:-10px;">photo gambar belum diisi</p>
               <?php } ?><br/>
            <label for="varchar">Gambar 3 <?php echo form_error('gambar3') ?></label>
            
              <?php if($this->uri->segment(3)=='create'){?>
                <input type="file" class="form-control" name="gambar3" value="<?php echo $gambar3; ?>" id="gambar" placeholder="Gambar" />
            <?php } else { ?>
                <input type="file" class="form-control" name="gambar3" id="gambar" placeholder="Gambar" />
            <input type="hidden" class="form-control" name="gambar3_lama" id="gambar" placeholder="Gambar" value="<?php echo $gambar3; ?>" />
            <?php } ?>
        </div>

        <div class="form-group">
               <?php if($gambar4 != null) { ?>
                   <img src="<?php echo base_url();?>assets/produk/<?php echo $gambar4;?>" width="150px"/>
               <?php } else { ?>
               <p style="margin-bottom:-10px;">photo gambar belum diisi</p>
               <?php } ?><br/>
            <label for="varchar">Gambar 4 <?php echo form_error('gambar4') ?></label>
            
              <?php if($this->uri->segment(3)=='create'){?>
                <input type="file" class="form-control" name="gambar4" value="<?php echo $gambar4; ?>" id="gambar" placeholder="Gambar" />
            <?php } else { ?>
                <input type="file" class="form-control" name="gambar4" id="gambar" placeholder="Gambar" />
            <input type="hidden" class="form-control" name="gambar4_lama" id="gambar" placeholder="Gambar" value="<?php echo $gambar4; ?>" />
            <?php } ?>
        </div>

         <div class="form-group">
               <?php if($gambar5 != null) { ?>
                   <img src="<?php echo base_url();?>assets/produk/<?php echo $gambar5;?>" width="150px"/>
               <?php } else { ?>
               <p style="margin-bottom:-10px;">photo gambar belum diisi</p>
               <?php } ?><br/>
            <label for="varchar">Gambar 5 <?php echo form_error('gambar5') ?></label>
            
              <?php if($this->uri->segment(3)=='create'){?>
                <input type="file" class="form-control" name="gambar5" value="<?php echo $gambar5; ?>" id="gambar" placeholder="Gambar" />
            <?php } else { ?>
                <input type="file" class="form-control" name="gambar5" id="gambar" placeholder="Gambar" />
            <input type="hidden" class="form-control" name="gambar5_lama" id="gambar" placeholder="Gambar" value="<?php echo $gambar5; ?>" />
            <?php } ?>
        </div>
       
	   
	   
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('status') ?></label>
           
            <select class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>">
                
                <option value="ready">Tersedia</option>
                 <option value="pre order">Pre Order</option>
                
            </select>
        </div>
	    <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a>
	</form>
   