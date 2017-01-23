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
        <!-- Modal Add Data -->
        <div id="modalAdd" class="modal">
          <div class="modal-content">
            <h4 class="center-align">Add Data</h4>
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
                  <button class="btn waves-effect waves-light" type="submit" id="btnsimpan" name="btnsimpan">Save
                    <i class="material-icons left">send</i>
                  </button>
                </div>
              </form>
          </div>
          <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>
          </div>
        </div>
        <!-- Modal Add Data -->

        <div class="col s12 m12 l12">
          <table class="bordered highlight">
            <thead>
              <tr>
                  <td class="center-align"><b>Id</b></td>
                  <td class="center-align"><b>Time</b></td>
                  <td class="center-align"><b>Name</b></td>
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
              $q1 = mysqli_query($koneksi, "SELECT * FROM tb_tamu");
              while($r1 = mysqli_fetch_array($q1))
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
                      <h4 class="center-align">Change Data (<?php echo $r1['id']; ?>)</h4>
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
                            <button class="btn waves-effect waves-light" type="submit" id="btnupdate" name="btnupdate">Save Changed
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
        </div>
      </div>

    </div>

    <?php include "part_footer.php";  ?>

  </body>
</html>
