<?php
include "../koneksi.php";
session_start();

  if(isset($_GET['ajukan'])){
    $id_user = $_SESSION['login_pegawai'];
    $sql = "UPDATE tabel_target_skp set status='Diajukan' WHERE nip='$id_user'";

      if ($db->query($sql) === TRUE) {
        header("location: index.php");
      }
      else {
        echo "Error deleting record: " . $db->error;
      }
  }

  if(isset($_GET['hapus'])){
  $id=$_GET['hapus'];
  $sql = "DELETE FROM tabel_target_skp WHERE id_target='$id'";

    if ($db->query($sql) === TRUE) {
      header("location: index.php");
    }
    else {
      echo "Error deleting record: " . $db->error;
    }
  }

  if(isset($_POST['btn_simpan'])){
    include '../koneksi.php';

    $kegiatan_tugas_jabatan = $_POST['kegiatan_tugas_jabatan'];
    $kuantitas = $_POST['kuantitas'];
    $output = $_POST['output'];
    $kualitas = $_POST['kualitas'];
    $waktu = $_POST['waktu'];
    $biaya = $_POST['biaya'];
    $id_user = $_SESSION['login_pegawai'];

    $sql = "INSERT INTO tabel_target_skp (kegiatan_tugas_jabatan, kuantitas, output, kualitas, waktu, biaya, nip, status)
      VALUES ('$kegiatan_tugas_jabatan','$kuantitas','$output','$kualitas','$waktu','$biaya','$id_user','Pending')";

    if ($db->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
  }

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kelola Sasaran Kerja Pegawai | Pegawai Yang Dinilai</title>
  <link rel="shorcut icon" href="../icon.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../asset_untuk_halaman_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../asset_untuk_halaman_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../asset_untuk_halaman_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../asset_untuk_halaman_admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../asset_untuk_halaman_admin/dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet" href="../asset_untuk_halaman_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">KP</span>
      <span class="logo-lg">DINKOMINFO JATIM</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->

            <a class="" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs fa fa-user">&nbsp;<?php
              echo $_SESSION['status_pegawai']; ?> : <?php echo $_SESSION['nama_pegawai']; ?></span>
            </a>

          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="index.php"><i class="fa fa-link"></i> <span>Kelola Sasaran Kerja Pegawai</span></a></li>
        <li class=""><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Formulir SKP
      </h1>
    </section>

    <!-- Main content -->

    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
              <a href="index.php?ajukan=oke" class="btn btn-primary" data-toggle="modal"><i class="fa fa-send"></i>&nbsp;Ajukan</a>
            </div>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Target Sasaran Kerja Pegawai</h4>
                    </div>
                    <div class="modal-body">


                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                          <label >Kegiatan Tugas Jabatan</label>
                          <textarea class="form-control" rows="4" name="kegiatan_tugas_jabatan" placeholder="Masukkan kegiatan tugas jabatan" required="" ></textarea>
                        </div>
                        <div class="form-group">
                          <label >Kuantitas</label>
                          <input type="number" class="form-control" required="" name="kuantitas" style="width: 30%;">
                        </div>
                        <div class="form-group">
                          <label >Output</label>
                          <select name="output" class="form-control" style="width: 50%;">
                            <option value="" >- Pilih Output -</option>
                            <option value="Laporan" >Laporan</option>
                            <option value="Dokumen" >Dokumen</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label >Kualitas</label>
                          <input type="number" class="form-control" required="" name="kualitas" style="width: 30%;">
                        </div>
                        <div class="form-group">
                          <label >Waktu (bulan)</label>
                          <input type="number" required="" class="form-control" name="waktu" style="width: 30%;">
                        </div>
                        <div class="form-group">
                          <label >Biaya</label>
                          <input type="number" class="form-control" required="" name="biaya" style="width: 50%;">
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-success pull-left" name="btn_simpan" >Simpan</button>
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 50px;">No.</th>
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">Kegiatan Tugas Jabatan</th>
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 50px;">Kuantitas</th>
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 50px;">Output</th>
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 75px;">Kualitas</th>
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 75px;">Waktu</th>
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;">Biaya</th>
                  <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Aksi</th>
                </thead>
                <tbody>

              <?php
                $no = 1;
                include "../koneksi.php";
                $get_nip = $_SESSION['login_pegawai'];

                $sql = "SELECT * FROM tabel_target_skp where NIP='$get_nip' and status not like 'Diajukan'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {

              ?>
                <tr role="row" class="odd">
                  <td><?php echo $no++; ?>

                  </td>
                  <td><?php echo $row['KEGIATAN_TUGAS_JABATAN']; ?></td>
                  <td><?php echo $row['KUANTITAS']; ?></td>
                  <td><?php echo $row['OUTPUT']; ?></td>
                  <td><?php echo $row['KUALITAS']; ?></td>
                  <td><?php echo $row['WAKTU']; ?></td>
                  <td><?php echo $row['BIAYA']; ?></td>
                  <td>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?php echo $row['ID_TARGET']; ?>"><i class="fa fa-edit"></i>&nbsp;Ubah</button>
                    <?php
                      include ('formubahkegiatantugasjabatan.php');
                    ?>
                      <a href="index.php?hapus=<?php echo $row['ID_TARGET']?>" type="button" class="btn btn-danger"><i class="fa fa-trash-o">&nbsp;Hapus</i></a>
                  </td>
                </tr>
                <?php
                  }
                }
                ?>

              </table></div></div><div class="row"><div class="col-sm-5"><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"></div></div></div></div>
            </div>
            <!-- /.box-body -->

          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Muhammad Sarwani</a>.</strong> All rights reserved.
  </footer>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="../asset_untuk_halaman_admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../asset_untuk_halaman_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../asset_untuk_halaman_admin/dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>