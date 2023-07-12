<?php function rupiah($angka){
        $hasil_rupiah = 'Rp '.number_format($angka,0,',','.');
        return $hasil_rupiah;
    }?>

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
                        <span class="text">Tambah Pendapatan</span>
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Tanggal</th>
                                <th width="30%">Nama</th>
                                <th width="20%">Nominal</th>
                                <th width="15%">Keterangan</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no=0; foreach($balance->result_array() as $list){$no++;
                                echo'
                            <tr>
                                <td>'.$no.'</td>
                                <td>'.date("d F Y", strtotime($list['date_input'])).'</td>
                                <td>'.$list['name'].'</td>
                                <td>'.rupiah($list['nominal']).'</td>
                                <td>'.$list['keterangan'].'</td>
                                <td><a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#edit-'.$list['id_balance'].'"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#del-'.$list['id_balance'].'"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <div class="modal fade" id="del-'.$list['id_balance'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <a class="btn btn-danger" href="'.base_url('auth/del_balance/'.$list['id_balance']).'">Yakin, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="modal fade" id="edit-'.$list['id_balance'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-warning" id="exampleModalLabel">Edit Pendapatan !!</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form class="user" method="POST" action="'.base_url('auth/edit_balance/'.$list['id_balance']).'">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <select class="form-control" name="siswa" required>
                                                        <option value="'.$list['id_user'].'">'.$list['name'].'</option>
                                                        <option value="">-- Pilih Siswa --</option>';
                                                        foreach($siswa->result_array() as $pengguna){
                                                            echo '<option value="'.$pengguna['id'].'">'.$pengguna['name'].'</option>';
                                                        }
                                                    echo'</select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="type" required>
                                                        <option value="'.$list['id_category'].'">'.$list['category'].'</option>
                                                        <option value="">-- Pilih Jenis Pendapatan --</option>';
                                                        foreach($jenis->result_array() as $type){
                                                            echo '<option value="'.$type['id_category'].'">'.$type['category'].'</option>';
                                                        }
                                                        echo'</select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" name="nominal" placeholder="Rp. 0" value="'.$list['nominal'].'" required>
                                                </div>

                                                 <div class="form-group">
                                                    <textarea class="form-control" name="keterangan" placeholder="Catatan / Keterangan">'.$list['keterangan'].'</textarea>
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
                    <h5 class="modal-title text-info" id="add">Tambah Pendapatan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" method="POST" action="<?= base_url('auth/add_income'); ?> ">
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" name="siswa" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php foreach($siswa->result_array() as $pengguna){
                                    echo '<option value="'.$pengguna['id'].'">'.$pengguna['name'].'</option>';
                                }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="type" required>
                                <option value="">-- Pilih Jenis Pendapatan --</option>
                                <?php foreach($jenis->result_array() as $type){
                                    echo '<option value="'.$type['id_category'].'">'.$type['category'].'</option>';
                                }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="nominal" placeholder="Rp. 0" required>
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