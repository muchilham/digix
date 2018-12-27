<div class="homepage">
        <div class="section no-pad-bot homepage_cover_section" id="index-banner">
            <div class="container">
                <div class="header_content">
                    <div class="slogan">
                      <h1>Di digiX kami percaya bahwa ujian bukan tembok yang menghalangimu untuk meraih cita-cita</h1>
                    </div>
                    <form action="<?php echo base_url();?>explore/index" method="get">
                        <div id="kategori" class="row center header_row">
                            <a href="<?php echo base_url();?>explore/index" class="waves-effect waves-light btn blue darken-3" style="margin-bottom:10px;"> Mulai Menjelajah </a>
                        </div>
                        <div class="search_container">
                            <input type="text" class="white" name="param">
                            <button class="btn waves-effect waves-light blue darken-3" style="height:3.05rem;width:6rem;">
                                 <i class="fa fa-search fa-2x"></i>
                            </button>
                        </div>
                    </form>
                    <div class="row center header_row">
                        <h3 class="header col s12 light white-text second_title">Raih mimpimu dengan sukses ujian bersama digiX...</h3>
                    </div>
                    <div class="pic-link">
                        <a href="#alasan">Kenapa digiX adalah pilihan yang tepat bagi anda</a>
                        <a href="#rating">Testimoni pengguna</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="rekomendasi" class="section grey lighten-3">
            <div class="row center black-title">
                <h2 class="col s12">Update Terbaru</h2>
            </div>
            <div class="row">
                <div class="container">
                    <?php foreach ($select_new_exam->result() as $result_select_new_exam) { ?>
                    <a class="nostyle" href="<?php echo base_url();?>description/index/<?php echo strtolower($result_select_new_exam->id_exam);?>">
                        <div class="col s6 m3">
                            <div class="card small">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img alt="<?php echo $result_select_new_exam->exam_name;?>" class="activator" src="<?php echo base_url(); ?>assets/adm/images/exam/<?php echo $result_select_new_exam->exam_image;?> ">
                                </div>
                                <div class="card-content update">
                            <span class="card-title activator grey-text text-darken-4">
                                <?php echo $result_select_new_exam->exam_name;?>
                            </span>
                                  <div class="card-desc">
                                    <?php echo substr(ucfirst($result_select_new_exam->exam_description),0,60). ' ...';?>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
            <div class="row center header_row">
                <a href="<?php echo base_url();?>explore/index" class="waves-effect waves-light btn blue darken-3" style="margin-bottom:10px;"> Lihat Semua Tes </a>
            </div>
        </div>

        <div class="container reviews_container" id="alasan">
            <div class="section">

                <div class="row">
                    <div class="col s12 m4">
                        <div class="icon-block">
                            <h2 class="center light-blue-text"><i class="material-icons">stars</i></h2>
                            <h5 class="center">Mudah &amp; Fleksibel</h5>
                            <p class="light">
                                Berbeda dengan buku-buku tebal persiapan ujian yang tidak praktis untuk dibawa ke mana-mana, digiX menyediakan platform yang
                                dapat diakses dari mana saja dan kapan saja. Seluruh progressmu juga dapat diakses dengan login ke akun pribadimu, baik dari laptop,
                                 tablet, atau handphonemu. Rasakan kemudahan dan fleksibilitas belajar di digiX.
                            </p>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="icon-block">
                            <h2 class="center light-blue-text"><i class="material-icons">thumb_up</i></h2>
                            <h5 class="center">Mentor yang Berpengalaman</h5>
                            <p class="light">
                                Mentor di digiX adalah profesional yang telah berpengalaman di bidangnya masing-masing.
                                Kamu adalah calon mahasiswa yang ingin tahu kehidupan kampus di UGM, ITB, UI? Cobalah
                                berkonsultasi dengan mentor kami yang merupakan alumnus dari kampus-kampus tersebut. Kamu
                                adalah calon pegawai yang ingin mengetahui kiat-kiat lolos interview? Tanyakanlah pada mentor
                                kami yang merupakan HR di perusahaan global Fortune 500.
                            </p>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="icon-block">
                            <h2 class="center light-blue-text"><i class="material-icons">verified_user</i></h2>
                            <h5 class="center">Materi yang Lengkap</h5>

                            <p class="light">
                                Berbeda dengan buku yang harus dicetak, tim kami terus mengumpulkan materi
                                untuk diupdate. Soal yang kami sediakan adalah 100% merepresentasikan soal
                                ujian dan dilengkapi dengan pembahasan yang mudah dipahami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="rating">
        <div class="testimoni">
          <div class="row">
            <h3>Testimoni</h3>
            <?php 
            if($select_testimoni->row() > 0) {
              foreach ($select_testimoni->result() as $row_testimoni) { ?>
              <div class="row">
                <div class="col s2">
                  <img alt="<?php echo $row_testimoni->review_name; ?>" src="<?php echo base_url(); ?>assets/adm/images/review/<?php echo $row_testimoni->review_photo; ?>" class="circle responsive-img">
                </div>
                <div class="col m10">
                  <h4>"<?php echo $row_testimoni->review; ?>"</h4>
                  <h4>--<?php echo $row_testimoni->review_name; ?></h4>
                </div>
              </div>
            <?php } 
            } 
            else {
            ?>
              <div class="row">
                <div class="col m12">
                  <center><h3>-</h3></center>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>