<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Admin</title>
  </head>
  <body>
    <div class="container-fluid bg-dark">
    <nav class="container navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Kaya 2020</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>kategori">Kategori <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>produk">Produk <span class="sr-only">(current)</span></a>
      </li>
         <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>data_users">User <span class="sr-only">(current)</span></a>
      </li>

       </li>
         <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>order">Order <span class="sr-only">(current)</span></a>
      </li>
    
    </ul>
     <ul class="navbar-nav m;-auto">
       <li class="nav-item active">
        <a class="nav-link" href="#">Halo <?php echo $this->session->userdata('ses_username');?> <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>auth/logout">Keluar <span class="sr-only">(current)</span></a>
      </li>
     </ul>
   
  </div>
</nav>
</div>

<div class="container py-5">
