
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Tabel List 
                    <button class="btn btn-primary btn-icon-split btn-sm float-right" data-toggle="modal" data-target="#add">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah <?= $role;?></span>
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="35%">Nama</th>
                                <th width="30%">Email</th>
                                <th width="20%">Tanggal Daftar</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Daftar</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no=0; foreach($pengguna->result_array() as $list){$no++;
                                echo'
                            <tr>
                                <td>'.$no.'</td>
                                <td>'.$list['name'].'</td>
                                <td>'.$list['email'].'</td>
                                <td>'.date("d F Y", strtotime($list['date_created'])).'</td>
                                <td><a href="'.base_url("pengguna/edit/".$list['id']).'" class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#del-'.$list['id'].'"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <div class="modal fade" id="del-'.$list['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-warning" id="exampleModalLabel">Peringatan !!</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah yakin ingin menghapus <strong class="text-info">'.$list['name'].'</strong>?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <a class="btn btn-danger" href="'.base_url('auth/del_user/'.$list['id']).'">Yakin, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add-user" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-info" id="add-user">Tambah <?= $role;?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" method="POST" action=" <?= base_url('auth/add_'.$role); ?> ">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="<?= set_value('name') ?>" required>
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>" required>
                                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>'