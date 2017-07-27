<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'bd_euphoria');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/6@SL4Ij([+dsnU>)ss07Q^3{u!N)K?Ug,X-#N2FM+4Tj+/Tb?i/XP#((QYcu3xr');
define('SECURE_AUTH_KEY',  ' qBeS2]HDqBM,JJ|3<10<0%@+ 6NY-PPrATdVA?1aS@Xfa<y.UB]2OD D_YoorD<');
define('LOGGED_IN_KEY',    'nTSAUKk80DK|WWjI(s!x>$dNBG:lT>Oo(61=JW!TsTm#jyzAbJ{Hl)f*5v IzsT0');
define('NONCE_KEY',        '`+;DmkeRJ^#|C0=8pl$w3@{|<C|gJ+_)FWI.X6(b~NBVN0uEDHW^dfW+!dx?})KE');
define('AUTH_SALT',        'u7_.#z!%ntTaj7@{7J $BY;.mlB*0UM#CXjpz&{y~@E]XRx4[mEm&mefaig]VRTY');
define('SECURE_AUTH_SALT', 'rI4Y]S+8KRNG}ahJv6X;%MC]&B*+iI&^.EmO)Kqzl;M_z%;`.{RR:a]d~xVe[*|R');
define('LOGGED_IN_SALT',   'b~LNrmDK _xh)PfWx*O_4e(iA(*(UsVqAm?b$YxRXS#_ljE8wI<Qs<pKkg,7 `6N');
define('NONCE_SALT',       '1$+e +-D&*Uc</37J!YP&8A&Y.Cz/2jQG+IXnL~Jn8[dF~>{A5+^%k{?@nNFQbF#');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
