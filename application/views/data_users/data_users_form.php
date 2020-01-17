
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Data users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Form Data users</a></li>
             
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"><?php echo anchor(site_url('data_users'),'Data users', 'class="btn btn-success"'); ?></h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <?php if($this->uri->segment(3) == 'update') { ?>
                <input type="hidden" class="form-control" name="password_lama" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"  />
            <?php } else { ?>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
            <?php } ?>
        </div>
	  <!--   <div class="form-group">
            <label for="int">Akses Level <?php echo form_error('akses_level') ?></label>
            <select class="form-control" name="akses_level" id="akses_level" placeholder="Akses Level" value="<?php echo $akses_level; ?>">
               
                 <?php if($this->uri->segment(3) ==  'update'){ ?>
                <option value="<?php echo $akses_level; ?>">
                <?php if($akses_level == '1'){echo 'Superadmin';} 
                    else if($akses_level == '2') {echo'Petugas Rumah Sakit';}
                    else if($akses_level == '3') {echo'Petugas Kelurahan';}
                    else if($akses_level == '4') {echo'Petugas DISKUPCAPIL';}
                     else if($akses_level == '5') {echo'User';}
                    ?></option>
                <?php } ?>
                 <option value="1">Superadmin</option>
                 <option value="2">Petugas Rumah Sakit</option>
                <option value="3">Petugas Kelurahan</option>
                <option value="4">Petugas Diskupcapil</option>
                <option value="5">User</option>
               
            </select>
           
        </div> -->
	    <div class="form-group">
            
            <input type="hidden" class="form-control" name="tanggal_update" id="tanggal_update" placeholder="Tanggal Update" value="<?php echo date('Y-m-d h:i:sa') ?>" />
        </div>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_users') ?>" class="btn btn-default">Cancel</a>
	</form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper