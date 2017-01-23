<?php
  include "config.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "part_header.php";  ?>
  </head>
  <body>

    <?php include "part_nav.php";  ?>

    <div class="container">

      <div class="row section">
        <!-- Modal Add Data Siswa -->
        <div id="modalAdd" class="modal">
          <div class="modal-content">
            <h4 class="center-align">Tambah Data</h4>
              <form class="col s12" method="post" action="aksi.php">
                <div class="row">
                  <div class="input-field col s12">
                    <input id="txtname" name="txtname" type="text" class="validate" required="required">
                    <label for="txtname">Name</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                    <input id="txtemail" name="txtemail" type="text" class="validate" required="required">
                    <label for="txtemail" data-error="Invalid">Email</label>
                  </div>
                  <div class="input-field col s6">
                    <input id="txturl" name="txturl" type="text" class="validate">
                    <label for="txturl" data-error="Invalid">Url/Website</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="txtpesan" name="txtpesan" class="materialize-textarea" required="required"></textarea>
                    <label for="txtpesan">Message</label>
                  </div>
                </div>
                <div class="row">
                  <button class="btn waves-effect waves-light" type="submit" id="btnsimpan" name="btnsimpan">Simpan
                    <i class="material-icons left">send</i>
                  </button>
                </div>
              </form>
          </div>
          <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>
          </div>
        </div>
        <!-- Modal Add Data Siswa -->

        <!--search-->
        <div class="row">
          <div class="col s12 m12 l8">
          </div>
          <div class="col s12 m12 l4">
            <nav>
              <div class="nav-wrapper">
                <form method="get" action="pagination.php">
                  <div class="input-field black-text grey lighten-5">
                    <?php
                      $txtcari = "";
                      if(isset($_GET["txtcari"])){
                        $txtcari = $_GET["txtcari"];
                      }
                    ?>
                    <input id="txtcari" type="search" name="txtcari" value="<?php echo $txtcari;?>" placeholder="Type here and press Enter">
                    <label for="search"><i class="material-icons green-text">search</i></label>
                    <i class="material-icons">close</i>
                  </div>
                </form>
              </div>
            </nav>
          </div>
        </div>
        <!--search-->

        <div class="col s12 m12 l12">
          <table class="bordered highlight">
            <thead>
              <tr>
                  <td class="center-align"><b>Id</b></td>
                  <td class="center-align"><b>Time</b></td>
                  <td class="center-align"><b>Nama</b></td>
                  <td class="center-align"><b>Email</b></td>
                  <td class="center-align"><b>Website</b></td>
                  <td class="center-align"><b>Message</b></td>
                  <td class="center-align">
                    <b><a class="waves-effect waves lighten-2 btn" data-target="modalAdd"> <i class="material-icons">add</i></a></b>
                  </td>
              </tr>
            </thead>
            <tbody>
              <?php
              $num_rec_per_page=2;
      				if (isset($_GET["page"]))
      				{
      					$page  = $_GET["page"];
      				}
      				else
      				{
      					$page=1;
      				};
      				$start_from = ($page-1) * $num_rec_per_page;
              $txtcari = "";
              if(isset($_GET["txtcari"])){
                $txtcari = $_GET["txtcari"];
              }else{
                $txtcari = "";
              }
      				$q1 = mysqli_query($koneksi,"SELECT * FROM tb_tamu WHERE nama like '%$txtcari%' ORDER by id desc LIMIT $start_from, $num_rec_per_page");
              while($r1 = mysqli_fetch_assoc($q1))
              {
              ?>
              <tr>
                <td><?php echo $r1['id']; ?></td>
                <td class="center-align"><?php echo $r1['time']; ?></td>
                <td class="center-align"><?php echo $r1['nama']; ?></td>
                <td class="center-align"><?php echo $r1['email']; ?></td>
                <td class="center-align"><?php echo $r1['url']; ?></td>
                <td class="center-align"><?php echo $r1['pesan']; ?></td>
                <td class="center-align">
                  <!-- <a class="waves-effect waves lighten-2 btn" data-target="modalAdd"> <i class="material-icons">add</i></a> -->
                  <a class="waves-effect light-blue lighten-2 btn" data-target="modalEdit<?php echo $r1['id']; ?>"> <i class="material-icons">mode_edit</i></a>
                  <a class="waves-effect red lighten-2 btn" href="aksi.php?btndelete=<?php echo $r1['id']; ?>"> <i class="material-icons">delete</i></a>
                  <!-- Modal Edit Data Siswa -->
                  <div id="modalEdit<?php echo $r1['id']; ?>" class="modal">
                    <div class="modal-content">
                      <h4 class="center-align">Edit Data (<?php echo $r1['id']; ?>)</h4>
                        <form class="col s12" method="post" action="aksi.php">
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="txtid" name="txtid" type="hidden" value="<?php echo $r1['id']; ?>">
                              <input id="txtname" name="txtname" type="text" class="validate" value="<?php echo $r1['nama']; ?>" required="required">
                              <label for="txtname">Name</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s6">
                              <input id="txtemail" name="txtemail" type="text" class="validate" value="<?php echo $r1['email']; ?>" required="required">
                              <label for="txtemail" data-error="Invalid">Email</label>
                            </div>
                            <div class="input-field col s6">
                              <input id="txturl" name="txturl" type="text" class="validate" value="<?php echo $r1['url']; ?>">
                              <label for="txturl" data-error="Invalid">Url/Website</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <textarea id="txtpesan" name="txtpesan" class="materialize-textarea" required="required"><?php echo $r1['pesan']; ?></textarea>
                              <label for="txtpesan">Message</label>
                            </div>
                          </div>
                          <div class="row">
                            <button class="btn waves-effect waves-light" type="submit" id="btnupdate" name="btnupdate">Update
                              <i class="material-icons left">send</i>
                            </button>
                          </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>
                    </div>
                  </div>
                  <!-- Modal Edit Data Siswa -->
                </td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>

          <?php
    				$rs_result = mysqli_query($koneksi,"SELECT * FROM tb_tamu WHERE nama like '%$txtcari%' Order by id desc");
    				$total_records = mysqli_num_rows($rs_result);
    				$total_pages = ceil($total_records / $num_rec_per_page);
            $cari = "&txtcari=".$txtcari;
    			?>
          <ul class="pagination center-align card section">
            <li class="waves-effect"><a href="pagination.php?page=1<?php if(isset($_GET['txtcari'])){echo $cari;} ?>"><i class="material-icons">chevron_left</i></a></li>
              <?php
                for ($i=1; $i<=$total_pages; $i++){
                  if (!isset($_GET["page"]) && $i==1) {
                      echo '<li class="active"><a href="pagination.php?page='.$i.$cari.'">'.$i.'</a></li>';
                  }else if (isset($_GET["page"]) && $i==$_GET["page"]) {
                      echo '<li class="active"><a href="pagination.php?page='.$i.$cari.'">'.$i.'</a></li>';
                  }else {
                      echo '<li class="waves-effect"><a href="pagination.php?page='.$i.$cari.'">'.$i.'</a></li>';
                  }
                }
              ?>
            <li class="waves-effect"><a href="pagination.php?page=<?php echo $total_pages.$cari;?>" ><i class="material-icons">chevron_right</i></a></li>
          </ul>

        </div>
      </div>

    </div>

    <?php include "part_footer.php";  ?>

  </body>
</html>
