<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Título</h4>
            </div>
            <div class="modal-body" id="myModalText">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-primary btn-lg hidden" id="btn-modal" data-toggle="modal" data-target="#myModal"></button>



<!-- api maps
<script>

    var map;
    function initMap() {
        var myLatLng = {lat: -19.515813, lng: -42.61077};

        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 16
        });
        var marker = new google.maps.Marker({
            map: map,
            position: myLatLng,
            title: 'Euphoria'
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbIeAzBl0K9EM3u-TVsrsFKlxSRKacZy0&callback=initMap"
        async defer></script>-->

<!--setar background-->
<?php query_posts('showposts=1&category_name=imagem-principal');
while (have_posts()) : the_post();
$conteudo = get_the_content();
$img = PegarMeioStr(' src="', '"', $conteudo);?>
    <script>
        $("#header").css({"background":"url('<?php echo $img ?>')", "background-repeat":"no-repeat","-moz-background-size":"100% 100%","-webkit-background-size":"100% 100%","background-size":"100% 100%","position":"relative","width":"100%","height":"100vh","display":"table","top":"0","left":"0"});
    </script>
<?php endwhile; ?>

<!--fancybox-->
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>


<!--scroll menu-->
<script>

    $(window).scroll(function(event){
        if ($(window).scrollTop() < 50){
            $("#cabecalho").css("background", "none");
        } else {
            $("#cabecalho").css("background", "rgba(1, 1, 1, 0.6)");
        }
    });
</script>

<!--api facebook like
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?php /* query_posts('showposts=1&category_name=facebook-api');
                          while (have_posts()) : the_post(); echo get_the_content(); endwhile; */?>',
            xfbml      : true,
            version    : 'v2.5'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>-->

<!--newsletter-->
<script language="javascript">
    $("#newsletter").keypress(function(e){
        var tecla = (e.keyCode?e.keyCode:e.which);

        if(tecla == 13 && this.value != "") {

        }
    });
</script>

<!--contato-->
<script language="javascript">
    $("#enviar-email").submit(function(e) {
        var nome = $("#contato-nome").val();
        var email = $("#contato-email").val();
        var mensagem = $("#contato-mensagem").val();

        location.href = "?nome="+nome+"&email="+email+"&mensagem="+mensagem;
    });
</script>

<script type="text/javascript">
 //funcao para navegacao de rolagem na pagina
jQuery(document).ready(function($) { 
    $(".scroll").click(function(event){        
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top-118}, 800);
   });
});
//funcao para fechar e abrir menu javascript
  $('.menu-anchor').on('click touchstart', function(e){
         $('html').toggleClass('menu-active');
         e.preventDefault();
         });
		 
		 
//funcao para fechar e abrir ver-todos os servicos
	$('.btn-box3').on('click touchstart', function(e){
         $('html').toggleClass('servicos-active');
         e.preventDefault();
         });

</script>
<script src="wp-content/themes/Euphoria/js/scrollReveal.js"></script>

<script type="text/javascript">
      (function($) {

        'use strict';

        window.sr= new scrollReveal({
          reset: true,
          move: '50px',
          mobile: true
        });

      })();
</script>

<?php wp_footer(); ?>

</body>
</html>