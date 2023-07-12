<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-lg-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>


  <div class="row">
   <div class="col-lg-12">

    <?= form_open_multipart('Auth/edit_user');  ?>
    <div class="form-group row">
     <label for="email" class="col-sm-2 col-form-label">Email</label>
     <div class="col-sm-10">
       <input type="text" class="form-control" id="email" name="email" value="<?= $pengguna->email;?>" readonly />
     </div>
   </div>

   <div class="form-group row">
     <label for="name" class="col-sm-2 col-form-label">Full Name</label>
     <div class="col-sm-10">
       <input type="text" class="form-control" id="name" name="name" value="<?= $pengguna->name;?>" required>
     </div>
   </div>

   <div class="form-group row">
     <label for="name" class="col-sm-2 col-form-label">Password Lama</label>
     <div class="col-sm-10">
       <input type="password" class="form-control" id="name" name="passwordold">
     </div>
   </div>

   <div class="form-group row">
     <label for="name" class="col-sm-2 col-form-label">Password Baru</label>
     <div class="col-sm-10">
       <input type="password" class="form-control" id="name" name="password">
     </div>
   </div>

   <div class="form-group row">
     <label for="name" class="col-sm-2 col-form-label">Ulangi Password</label>
     <div class="col-sm-10">
       <input type="password" class="form-control" id="name" name="passwordx">
     </div>
   </div>

   <div class="form-group row">
    <div class="col-sm-2">Picture</div>
    <div class="col-sm-10">
     <div class="row">
      <div class="col-sm-3">
       <img src="<?= base_url('assets/img/profile/'.$pengguna->image)?>" class="img-thumbnail">
     </div>
     <div class="col-sm-9">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="image" name="image">
        <label class="custom-file-label" for="image">Choose file</label>
      </div>
    </div>
  </div>
</div>
</div>

<div class="form-group row justify-content-end">
 <div class="col-sm-10">
  <button type="submit"  class="btn btn-primary">Edit</button>
  <a href="#" onclick="goBack()" class="btn btn-danger">Kembali</a> 
</div>
</div>

</form>

</div>
</div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
  function goBack() {
    window.history.back();
  }
</script>