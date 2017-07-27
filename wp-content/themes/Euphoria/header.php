<!DOCTYPE html>
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="wp-content/themes/Euphoria/bootstrap.min.css">

  <script src="wp-content/themes/Euphoria/js/jquery.min.js"></script>

  <script src="wp-content/themes/Euphoria/js/bootstrap.min.js"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="wp-content/themes/Euphoria/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="wp-content/themes/Euphoria/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<!-- container-->
<div class="container-fluid principal" id="wrap">
    <!--header--->
    <div class="header" id="header">
        <div class="cabecalho clearfix" id="cabecalho">
            <!--logo-->
            <div class="logo">
                <a class="scroll" href="#wrap"><img src="wp-content/themes/Euphoria/img/logo-branca.png"></a>
            </div>
            <!--menu-->
            <div class="menu">
                <nav>
                    <ul class="list-inline">
                        <li><a class="scroll" href="#quem-somos">QUEM SOMOS</a></li>
                        <li><a class="scroll" href="#produtos">PRODUTOS</a></li>
                        <li><a class="scroll" href="#novidades">NOVIDADES</a></li>
                        <li><a class="scroll" href="#clientes">CLIENTES</a></li>
                        <li><a class="scroll" href="#contato">CONTATO</a></li>
                    </ul>
                </nav>
            </div>
            <div class="menu-expansivo">
                <div class="dropdown">
                    <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="icone-menu" src="wp-content/themes/Euphoria/img/menu.png" width="30" height="30">
                    </button>
                    <a class="scroll" href="#wrap"><img src="wp-content/themes/Euphoria/img/logo-branca.png" id="logomarca" height="40"></a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a class="scroll" href="#quem-somos">QUEM SOMOS</a></li>
                        <li><a class="scroll" href="#produtos">PRODUTOS</a></li>
                        <li><a class="scroll" href="#novidades">NOVIDADES</a></li>
                        <li><a class="scroll" href="#clientes">CLIENTES</a></li>
                        <li><a class="scroll" href="#contato">CONTATO</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="frase-box">

            <?php query_posts('showposts=1&category_name=frase-cabecalho');
            while (have_posts()) : the_post(); ?>

                <!--frase-->
                <div class="frase"><?php the_content(); ?></div>

            <?php endwhile; ?>

            <?php query_posts('showposts=1&category_name=frase-cabecalho-sub-frase');
            while (have_posts()) : the_post(); ?>

                <!--frase-->
                <div class="sub-frase"><?php the_content(); ?></div>

            <?php endwhile; ?>

            <!--botao
            <div class="btn-veja-nossos-produtos-box center">
                <a  class="btn btn-veja-nossos-produtos scroll" id="veja-nossos-produtos" href="#produtos">Veja nossos produtos</a>
            </div>-->
        </div>
    </div>