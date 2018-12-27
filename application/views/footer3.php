
<footer class="page-footer" style="background-color: #0d7ba5;">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Tentang digiX</h5>
        <p class="grey-text text-lighten-4">digiX menyediakan kumpulan soal yang lengkap untuk persiapan ujian,
          dan komunitas berpengalaman yang siap membantumu. digiX juga menyediakan layanan platform ujian online
          untuk kampus, bimbel, dan korporat.</p>
          <p>Ingin mendengar lebih lanjut dari kami?
        <div id="subscribe" class="row">
            <input name="email" data-abide-validator="email" placeholder="masukkan emailmu" title="Subscription form" required="" aria-invalid="false" type="email">
            <!-- <a href="#" class="waves-effect waves-light btn blue darken-3" style="margin-bottom:10px;"> Subscribe </a> -->
            <a href="<?php echo base_url(); ?>register" class="waves-effect waves-light btn blue darken-3" style="margin-bottom:10px;"> Subscribe </a>
        </div>

      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Kunjungi sosial media kami</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" target="_new" href="https://www.facebook.com/"><i class="fa fa-facebook-square"></i> Facebook </a></li>
          <li><a class="grey-text text-lighten-3" target="_new" href="https://twitter.com/"><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="grey-text text-lighten-3" target="_new" href="https://www.youtube.com/"><i class="fa fa-youtube-square" aria-hidden="true"></i> YouTube</a></li>
          <li><a class="grey-text text-lighten-3" target="_new" href="http://www.digix.com/blog"><i class="fa fa-weixin" aria-hidden="true"></i> Blog</a></li>
          <li><a class="grey-text text-lighten-3" href="mailto:support@digix.com?Subject=Hello" target="_top"><i class="fa fa-envelope-o" aria-hidden="true"></i> support@digix.com</a></li>

        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    ©  All pages Copyright to 2017 by digiX.com. All rights reserved.
    </div>
  </div>
</footer>
<div class="hiddendiv common"></div><div class="drag-target" data-sidenav="nav-mobile" style="left: 0px; touch-action: pan-y;"></div><iframe style="border: 0 none;height: 0;margin: 0;padding: 0;position: absolute;visibility: hidden;width: 0;"></iframe>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.client_side_pagination.js"></script>
    <!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/init.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.steps.js"></script>  
<!-- <script src="<?php echo base_url();?>assets/js/treeview.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.js"></script> -->
<script src="<?php echo base_url(); ?>assets/adm/plugins/datatables/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
   
    // Create an array of labels containing all table headers
    var labels = [];
    $('#myTable').find('thead th').each(function() {
        labels.push($(this).text());
    });
     
    // Add data-label attribute to each cell
    $('#myTable').find('tbody tr').each(function() {
        $(this).find('td').each(function(column) {
            $(this).attr('data-label', labels[column]);
        });
    });

    $(document).ready(function(){
        $('.modal').modal();
        $('.sidenav').sidenav();
    });   
    setTimeout(function(){ $("#notif").hide(); }, 4000);
</script> 
</body>
</html>
