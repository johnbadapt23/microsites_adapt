<!doctype html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php // <title> is now rendered by WordPress core via add_theme_support('title-tag')
      // in includes/_setup.php, hooked into wp_head() below - gives proper
      // "Page Title – Site Name" formatting instead of the bare page title
      // the old wp_title() call produced. ?>
<?php adapt_seo_head_tags(); ?>
<?php adapt_seo_json_ld(); ?>

<?php // Theme stylesheets and scripts are enqueued in includes/_head.php. ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/favicon-16x16.png">
<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/site.webmanifest">
<link rel="mask-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#000000">
<meta name="theme-color" content="#000000">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://unpkg.com">
<link rel="preconnect" href="https://js.hs-scripts.com">
<link rel="preconnect" href="https://www.googletagmanager.com">

<?php get_template_part( 'templates/partials/_icons' ); ?>
<?php wp_head(); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NHF4ZRS');</script>
<!-- End Google Tag Manager -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-769682308"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-769682308');
</script>
<?php $site_schema_code = get_field( 'site_schema_code', 'options' ); ?>
<?php if ( $site_schema_code ) { ?>
    <?php echo $site_schema_code; ?>
<?php } ?>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async src="//js.hs-scripts.com/8336221.js"></script>
<!-- End of HubSpot Embed Code -->
</head>
<body <?php body_class(''); ?> rel="<?php if ( is_404() ): echo 'notFound'; endif; ?>" <?php if(current_user_can('mepr-active')) { ?>id="logged-in"<?php } ?>>
    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NHF4ZRS"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


	<?php get_template_part( 'templates/partials/_header' ); ?>
