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
                        <span class="text">Tambah Kategori</span>
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama Kategori</th>
                                <th width="55%">Keterangan</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no=0; foreach($balance->result_array() as $list){$no++;
                                echo'
                            <tr>
                                <td>'.$no.'</td>
                                <td>'.$list['category'].'</td>
                                <td>'.$list['ket_category'].'</td>
                                <td><a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#edit-'.$list['id_category'].'"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#del-'.$list['id_category'].'"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <div class="modal fade" id="del-'.$list['id_category'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-warning" id="exampleModalLabel">Peringatan !!</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah yakin ingin menghapus data?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <a class="btn btn-danger" href="'.base_url('auth/del_category/'.$list['id_category']).'">Yakin, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="modal fade" id="edit-'.$list['id_category'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-warning" id="exampleModalLabel">Edit Jenis Kas !!</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form class="user" method="POST" action="'.base_url('auth/edit_category/'.$list['id_category']).'">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="jenis" placeholder="Input Kategori" value="'.$list['category'].'" required>
                                                </div>

                                                 <div class="form-group">
                                                    <textarea class="form-control" name="keterangan" placeholder="Catatan / Keterangan">'.$list['ket_category'].'</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>';}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-info" id="add">Tambah Kategori</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" method="POST" action="<?= base_url('auth/add_category'); ?> ">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="jenis" placeholder="Input Kategori" required>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="keterangan" placeholder="Catatan / Keterangan"></textarea>
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