
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
            <a href="contact.html" class="waves-effect waves-light btn blue darken-3" style="margin-bottom:10px;"> Subscribe </a>
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

<?php if(!$this->session->logged_in)
    { ?>
    <div id="login-modal" class="modal">
        <div class="modal-content">
        <h4>Login</h4>
        <form id="form-login" class="col s12" action="<?php echo base_url();?>index/login" method="POST">
            <div class="row">
                <div class="input-field col s6">
                    <input id="id_email" name="id_email" type="text">
                    <label for="id_email">Email / Username</label>
                </div>
                <div class="input-field col s6">
                    <input id="user_password1"  name="user_password1" type="password">
                    <label for="user_password1">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="waves-effect waves-light btn blue darken-3" type="submit" name="action">Login
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
            <!-- <p id="two">Don't have account? <a class="signup modal-trigger" href="#register-modal" id="signup">Sign up here</a></p> -->
        </form>
        </div>
    </div>

    <div id="register-modal" class="modal">
        <div class="modal-content">
            <h4>Register</h4>
            <hr width="100%" style="background-color:lightgrey; height:.5px">
            <div class="ajax-load text-center" style="display:none">
                <p><img src="https://demo.itsolutionstuff.com/plugin/loader.gif">Loading</p>
            </div>
            <form id="form-regist" class="col s12" action="<?php echo base_url();?>index/register" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s12">
                    <input id="id_user" type="text" name="id_user" required="">
                    <label for="id_user">Username</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                    <input id="first_name" type="text" name="first_name" required>
                    <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s6">
                    <inpuT id="last_name" type="text" name="last_name"  required >
                    <label for="last_name">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                    <input id="user_email" type="email" name="user_email" required >
                    <label for="user_email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                    <input id="user_password2" type="password" name="user_password2" required >
                    <label for="user_password2">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                    <input id="user_password3" type="password" name="user_password3"  class="form-control" required>
                    <label for="user_password3">Retype Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="file" id="user_photo" name="user_photo">
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12">
                        <button class="waves-effect waves-light btn blue darken-3" type="submit" name="action">Register
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                
                <!-- <p id="two">Already have an account? <a class="signin modal-trigger" href="#login-modal" id="signin">Sign in</a></p> -->
            </form>
        </div>
    </div>
    <?php } ?>

<div class="hiddendiv common"></div><div class="drag-target" data-sidenav="nav-mobile" style="left: 0px; touch-action: pan-y;"></div><iframe style="border: 0 none;height: 0;margin: 0;padding: 0;position: absolute;visibility: hidden;width: 0;"></iframe>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/init.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.steps.min.js"></script>  
<!-- <script src="<?php echo base_url();?>assets/js/treeview.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.js"></script> -->

<script>

setTimeout(function(){ $("#notif").hide(); }, 4000);

$(".dropdown-trigger").dropdown();

$(document).ready(function(){
    // $('.modal').modal({
    //    dismissible: true, // Modal can be dismissed by clicking outside of the modal
    //   opacity: .5, // Opacity of modal background
    //   in_duration: 300, // Transition in duration
    //   out_duration: 200, // Transition out duration
    //   onOpenStart: function() { $(".modal").removeClass('open'); },
    //   onCloseEnd: function() { $(".modal").removeClass('open'); } // Callback for Modal close
    // });
     $('.modal').modal();
     $('.sidenav').sidenav();
  });   

$(function() {
var $gallery = $("#gallery1");
$inputs = $gallery.find("input");
// $inputs.attr("checked", "checked");
$inputs.on("change", function() {
  $inputs.each(function(i, cb) {
    if (!cb.checked) $gallery.find("." + this.value).css("display", "none");
  });
  $inputs.each(function(i, cb) {
    if (cb.checked) $gallery.find("." + this.value).css("display", "inline");
  });
});
});
</script>

<script type="text/javascript">
    var page = 1;
    $("#moreload").click(function() {
            page++;
            loadMoreData(page);
    });

    function loadMoreData(page){
        $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
            .done(function(data)
            {
                if(data == " "){
                    $('.ajax-load').html("No more records found");
                    return;
                }
                $('.ajax-load').hide();
                $("#infinite-scroll").append(data);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('server not responding...');
            });
    }
</script>
<script type="text/javascript">
  function incrementValue(min,max)
  {
      var value = parseInt(document.getElementById('number').value, 10);
      var value2 = parseInt(document.getElementById('number2').value, 10);
      value = isNaN(value) ? 0 : value;
      value2 = isNaN(value2) ? 0 : value2;
      value++;
      value2++;
      if(value == max+1 || value == min || value2 == max+1 || value2 == min)
        return
      document.getElementById('number').value = value;
      document.getElementById('number2').value = value;
  }

  $("#pg-form").steps({
    headerTag: "h3",
    bodyTag: "section",
    enableAllSteps: true,
    enablePagination: true,
    onFinished: function (event, currentIndex)
    {
        var r = confirm("Are you sure want to finish it?");
        if(r == true)
        {
          $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>question/answer",
              data: $("#pg-form").serialize(),
              success: function(data) {
                  $("#score").html(data);
                  $('#modal-finish').modal("open",{
                    dismissible: false, // Modal can be dismissed by clicking outside of the modal
                    opacity: .9, // Opacity of modal background
                    inDuration: 300, // Transition in duration
                    outDuration : 200, // Transition out duration
                  });
              },
          });
        }
        else
        {
          return;
        }
    }
  });

  $("#essay-form").steps({
    headerTag: "h3",
    bodyTag: "section",
    enableAllSteps: true,
    enablePagination: true,
    onFinished: function (event, currentIndex)
    {
        var r = confirm("Are you sure want to finish it?");
        if(r == true)
        {
          $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>question/answer2",
              data: $("#essay-form").serialize(),
              success: function(data) {
                  $('#modal-essay-finish').modal("open",{
                    dismissible: false, // Modal can be dismissed by clicking outside of the modal
                    opacity: .9, // Opacity of modal background
                    inDuration: 300, // Transition in duration
                    outDuration : 200, // Transition out duration
                  });
              },
          });
        }
        else
        {
          return;
        }
    }
  });
  
  $(document).ready(function(){
      
  $("#signup").click(function() {
        $("#login-modal").hide("hide", function() {
        $("#register-modal").show("show");
        });
  })
  
  $("#signin").click(function() {
        $("#register-modal").hide("hide", function() {
        $("#login-modal").show("show");
        });
  })
  
  });

  $(document).ready(function(){
    $('select').formSelect();
  });

  $(document).ready(function(){
  $('.modal.modal-fixed-footer').modal({
    dismissible: false
  });
});
       
</script>
</body>
</html>
