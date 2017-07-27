<?php get_header() ?>

<?php
function validaEmail($email){
    $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
    if (preg_match($er, $email)){
        return true;
    } else {
        return false;
    }
}
function PegarMeioStr($in, $fim, $str)
{
    @$ex = explode($in, $str);
    @$ex2 = explode($fim, $ex[1]);
    return $ex2[0];
}
function get_attachment_url_by_slug( $slug ) {
    $args = array(
        'post_type' => 'attachment',
        'name' => sanitize_title($slug),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_header = get_posts( $args );
    $header = $_header ? array_pop($_header) : null;
    return $header ? wp_get_attachment_url($header->ID) : '';
}

if(isset($_POST['newsletter-email']) && $_POST['newsletter-email'] != '') {
    $email = trim($_POST['newsletter-email']);
    if(validaEmail($email)) {
        $email = addslashes($email);

        //cadastrar na newsletter
        $query = "INSERT INTO wp_newsletter (email, status) VALUES ('".$email."','C')";
        $wpdb->get_results($query);

        echo '

            <script>
                $(function() {
                    $("#myModalLabel").html("Newsletter");
                    $("#myModalText").html("Email cadastrado!");
                    $("#btn-modal").trigger("click");
                });
            </script>

        ';

    } else {
        echo '

            <script>
                $(function() {
                    $("#myModalLabel").html("Newsletter");
                    $("#myModalText").html("Email invalido");
                    $("#btn-modal").trigger("click");
                });
            </script>

        ';
    }
}

if(isset($_GET['nome']) && isset($_GET['email']) && isset($_GET['mensagem'])) {

    $admin_email = "";

    query_posts('showposts=1&category_name=email');
    while (have_posts()) : the_post();
        $admin_email = get_the_content();
    endwhile;

    $nome = trim(@$_GET['nome']);
    $email = trim(@$_GET['email']);
    $mensagem = trim(@$_GET['mensagem']);
    $headers = 'From: '.$nome.' <'.$email.'>' . "\r\n";
    if(wp_mail($admin_email, 'Contato via Web', $mensagem, $headers)) {
        echo '

            <script>
                $(function() {
                    $("#myModalLabel").html("Contato");
                    $("#myModalText").html("Mensagem enviada!");
                    $("#btn-modal").trigger("click");
                    var url=document.location.href;
                    var url_nova= url.split("?")[0];
                    window.history.pushState("",document.title,url_nova);
                });
            </script>

        ';
    } else {
        echo '

            <script>
                $(function() {
                    $("#myModalLabel").html("Contato");
                    $("#myModalText").html("Não foi possível enviar a mensagem.");
                    $("#btn-modal").trigger("click");
                    var url=document.location.href;
                    var url_nova= url.split("?")[0];
                    window.history.pushState("",document.title,url_nova);
                });
            </script>

        ';
    }
}
?>

<!--quem somos-->
    <div class="quem-somos" id="quem-somos">
        <div class="quem-somos-box clearfix">

             <?php query_posts('showposts=1&category_name=quem-somos');
             while (have_posts()) : the_post();
                 $conteudo = get_the_content();
                 $img = PegarMeioStr(' src="', '"', $conteudo);
                 $quem_somos = "";
                 if(strpos($conteudo, "<a") == 0){
                    $quem_somos = substr($conteudo, strpos($conteudo, "</a>")+4, strlen($conteudo)-strpos($conteudo, "</a>")+4);
                 } else {
                    $quem_somos = substr($conteudo, 0, strpos($conteudo, "<a"));
                 }
                 ?>
                    <!--imagem-->
                    <div class="img-quem-somos">
                        <img src="<?php echo $img ?>">
                    </div>
                    <!--texto-->
                    <div class="quem-somos-texto">

                        <label><?php the_title(); ?></label>
                        <p><?php echo $quem_somos ?></p>

                    </div>
             <?php endwhile; ?>

        </div>
    </div>

    <!--produtos-->
    <div class="produtos" id="produtos">
        <?php query_posts('showposts=1&category_name=produtos');
         while (have_posts()) : the_post(); ?>

            <span class="linha1"></span>
            <label><?php the_title(); ?></label>
            <span class="linha2"></span>

            <p><?php the_content(); ?></p>

        <?php endwhile; ?>

        <div class="produtos-grid clearfix">
            <?php
             $produtos = array();
             query_posts('category_name=produto');
             $cont = 1;
             while (have_posts()) : the_post();
                $produtos[$cont]['nm_produto'] = get_the_title();
                $produtos[$cont]['img_url'] = PegarMeioStr(' src="', '"', get_the_content());
                $cont++;
             endwhile; ?>

            <?php

            foreach($produtos as $pos => $produto) { ?>
                <a class="item fancybox" rel="group<?php echo $pos ?>" href="<?php echo $produto['img_url'] ?>">
                    <img src="<?php echo $produto['img_url'] ?>">
                    <div class="item-nome"><?php echo $produto['nm_produto'] ?></div>
                </a>
                <?php
                $query = "SELECT image_url FROM wp_huge_itslider_images WHERE name = '".$produto['nm_produto']."'";
                $result = $wpdb->get_results($query);
                foreach ($result as $img) {
                    echo '<a class="fancybox" rel="group'.$pos.'" href="'.$img->image_url.'"></a>';
                }
             } ?>
        </div>
    </div>

    <!--novidades-->
    <div class="novidades" id="novidades">
         <?php query_posts('showposts=1&category_name=novidades');
         while (have_posts()) : the_post(); ?>

            <span class="linha1"></span>
            <label><?php the_title(); ?></label>
            <span class="linha2"></span>

            <p><?php the_content(); ?></p>

        <?php endwhile; ?>

        <div class="novidades-grid clearfix">
            <?php
            $query = "SELECT name,image_url FROM wp_huge_itslider_images WHERE name like 'novidade-%' ORDER BY ordering DESC";
            $result = $wpdb->get_results($query);

            $vt_imgs['vertical'] = array();
            $vt_imgs['horizontal'] = array();
            $vt_imgs['quadrada'] = array();

            foreach ($result as $img) {
                if($img->name == "novidade-vertical") {
                    $vt_imgs['vertical'][] = $img->image_url;
                }
                else if($img->name == "novidade-horizontal") {
                    $vt_imgs['horizontal'][] = $img->image_url;
                }
                else if($img->name == "novidade-quadrado") {
                    $vt_imgs['quadrada'][] = $img->image_url;
                }
            }
            $vertical = false;
            $horizontal = false;
            $cont_quadrada = 0;

            foreach($vt_imgs['horizontal'] as $img_horizontal) {
                if(!$horizontal) {
                    echo '<a class="item-top-right fancybox" rel="group-novidades" href="'.$img_horizontal.'"><img src="'.$img_horizontal.'"></a>';
                    $horizontal = true;
                }
                else
                    echo '<a class="fancybox" rel="group-novidades" href="'.$img_horizontal.'"></a>';
            }
            foreach($vt_imgs['vertical'] as $img_vertical) {
                 if(!$vertical) {
                    echo '<a class="item-left fancybox" rel="group-novidades" href="'.$img_vertical.'"><img src="'.$img_vertical.'"></a>';
                    $vertical = true;
                }
                else
                    echo '<a class="fancybox" rel="group-novidades" href="'.$img_vertical.'"></a>';
            }
            foreach($vt_imgs['quadrada'] as $img_quadrada) {
                if($cont_quadrada != 2) {
                    echo '<a class="item-bottom-right fancybox" rel="group-novidades" href="'.$img_quadrada.'"><img src="'.$img_quadrada.'"></a>';
                    $cont_quadrada++;
                }
                else
                    echo '<a class="fancybox" rel="group-novidades" href="'.$img_quadrada.'"></a>';
            }
            ?>
            <!--
            <div class="item-left"><img src=""></div>
            <div class="item-top-right"><img src=""></div>

            <div class="item-bottom-right"><img src=""></div>
            <div class="item-bottom-right"><img src=""></div>
            -->
        </div>
    </div>

    <!--clientes-->
    <div class="clientes" id="clientes">
        <?php
        //$cat_id = get_cat_ID("clientes");
        query_posts('showposts=1&category_name=clientes');
         while (have_posts()) : the_post(); ?>

            <span class="linha1"></span>
            <label><?php the_title(); ?></label>
            <span class="linha2"></span>

            <p><?php the_content(); ?></p>

        <?php endwhile; ?>

        <div class="clientes-grid clearfix">

            <?php
            query_posts('showposts=3&category_name=comentarios-clientes');
            $cont = 1;
            while (have_posts()) : the_post();
             $conteudo = get_the_content();
             $img = PegarMeioStr(' src="', '"', $conteudo);
             $fala = "";
             if(strpos($conteudo, "<a") == 0){
                $fala = substr($conteudo, strpos($conteudo, "</a>")+4, strlen($conteudo)-strpos($conteudo, "</a>")+4);
             } else {
                $fala = substr($conteudo, 0, strpos($conteudo, "<a"));
             }
             ?>

               <div class="item">
                    <div class="img"><img src="<?php echo $img ?>"></div>
                    <div class="texto">
                        <p><?php echo $fala ?></p>
                        <label><?php the_title(); ?></label>
                    </div>
                </div>

            <?php $cont++; endwhile; ?>

        </div>
    </div>

    <!--fique por dentro-->
    <div class="fique-por-dentro">
        <form action="" method="post">
            <label for="newsletter-email">FIQUE POR DENTRO DAS NOSSAS NOVIDADES:</label>
            <input type="email" id="newsletter-email" name="newsletter-email" placeholder="Informe seu email pessoal" required>
            <input type="submit" value="Enviar" >
        </form>
    </div>

    <!--contato-->
    <div class="contato" id="contato">
            <span class="linha1"></span>
            <label>Contato</label>
            <span class="linha2"></span>

        <div class="contato-box clearfix">
            <div class="dados-contato left">
                <?php
                query_posts('showposts=1&category_name=endereco');
                 while (have_posts()) : the_post(); ?>

                    <p><img src="wp-content/themes/Euphoria/img/contato-endereco.jpg"><?php echo get_the_content(); ?></p>

                <?php endwhile; ?>

                <?php
                query_posts('showposts=1&category_name=telefone');
                 while (have_posts()) : the_post(); ?>

                    <p><img src="wp-content/themes/Euphoria/img/contato-telefone.jpg"><?php the_title(); echo ": ".get_the_content(); ?></p>

                <?php endwhile; ?>

                <?php
                query_posts('showposts=1&category_name=email');
                 while (have_posts()) : the_post(); ?>

                    <p><img src="wp-content/themes/Euphoria/img/contato-email.jpg"><?php the_title(); echo ": ".get_the_content(); ?></p>

                <?php endwhile; ?>

            </div>
            <div class="enviar-email right">
                <form action="javascript:" name="enviar-email" id="enviar-email">
                    <input type="text" name="nome" id="contato-nome" placeholder="Seu nome" required>
                    <input type="email" name="email" id="contato-email" placeholder="Seu email" required>
                    <textarea type="text" name="mensagem" id="contato-mensagem" placeholder="Mensagem" required></textarea>
                    <input type="submit" value="ENVIAR">
                </form>
            </div>
            <!--
            <div class="api-fb left">
               <!-- api
               <!--<div class="fb-like"></div>
            </div>
            -->
        </div>
    </div>

    <?php echo do_shortcode("[put_wpgm id=1]"); ?>

    <!--footer-->
    <div class="footer">
        <img src="wp-content/themes/Euphoria/img/logo-dourada.png">
    </div>

</div>

<?php get_footer(); ?>