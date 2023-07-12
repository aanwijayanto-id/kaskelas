<?php function rupiah($angka){
        $hasil_rupiah = 'Rp '.number_format($angka,0,',','.');
        return $hasil_rupiah;
    }?>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Statistik Pendapatan Kas Kelas Tahun <?= date("Y");?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <hr>
                                    Diagram perbandingan kas kelas
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan Kas Kelas</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable-two" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="20%">Tanggal</th>
                                                    <th width="20%">Kategori</th>
                                                    <th width="30%">Nominal</th>
                                                    <th width="25%">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Kategori</th>
                                                    <th>Nominal</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php $no=0; foreach($income->result_array() as $list){$no++;
                                            echo'
                                            <tr>
                                                <td>'.$no.'</td>
                                                <td>'.date("d F Y", strtotime($list['date_input'])).'</td>
                                                <td>'.$list['category'].'</td>
                                                <td>'.rupiah($list['nominal']).'</td>
                                                <td>'.$list['keterangan'].'</td>
                                            </tr>';}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran Kas Kelas</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="20%">Tanggal</th>
                                                    <th width="20%">Kategori</th>
                                                    <th width="30%">Nominal</th>
                                                    <th width="25%">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Kategori</th>
                                                    <th>Nominal</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php $no=0; foreach($expense->result_array() as $list){$no++;
                                            echo'
                                            <tr>
                                                <td>'.$no.'</td>
                                                <td>'.date("d F Y", strtotime($list['date_input'])).'</td>
                                                <td>'.$list['category'].'</td>
                                                <td>'.rupiah($list['nominal']).'</td>
                                                <td>'.$list['keterangan'].'</td>
                                            </tr>';}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>