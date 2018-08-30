<?php
$class_code = $wp_query->query_vars['class-code'];
//$school_code = 'CHC';
$school_code = get_option('wrdsb_school_code');
$page_title = $class_code . ' Class List';
$access_time = current_time('mysql');

global $wp_version;
$url = 'https://wrdsb-skinner.search.windows.net/indexes/codex-trillium-enrolments/docs/search?api-version=2016-09-01';
$args = array(
    'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
    'blocking'    => true,
    'headers'     => array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'api-key' => WRDSB_SKINNER_SEARCH_KEY
    ),
    'cookies'     => array(),
    'body'        => json_encode(array(
        "filter"  => "class_code eq '{$class_code}' and school_code eq '{$school_code}'",
        "search"  => "*",
        "select"  => "*",
        "orderby" => "student_email",
        "top"     => 1000,
        "count"   => true
    )),
    'compress'    => false,
    'decompress'  => true,
    'sslverify'   => false,
    'stream'      => false,
    'filename'    => null
);

$response = wp_remote_post($url, $args);
$response_object = json_decode($response['body'], $assoc = false);
$enrolments = $response_object->value;
$enrolments_count = $response_object->{'@odata.count'};
$page_min = 1;
$page_max = count($enrolments);
$pages = 1;

while ($enrolments_count > $page_max) {
    $body = json_decode($args['body'], $assoc = true);
    $body["skip"] = $pages * 1000;
    $args['body'] = json_encode($body);
    $response = wp_remote_post($url, $args);
    $response_object = json_decode($response['body'], $assoc = false);
    $enrolments = array_merge($enrolments, $response_object->value);
    $page_max = count($enrolments);
    $pages++;
}

$student_emails = array();
foreach ($enrolments as $enrolment) {
    $student_emails[] = "<div>{$enrolment->student_email},</div>";
}
$total_emails = count($student_emails);
$last_email = $total_emails - 1;
$student_emails[$last_email] = str_replace(',', '', $student_emails[$last_email]);

$emails_list = '';
foreach ($student_emails as $email) {
    $emails_list .= $email;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php echo $page_title; ?></title>

  <link href="https://s3.amazonaws.com/wrdsb-ui-assets/1/master.css" rel="stylesheet" media="all">

  <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-60x60.png" rel="apple-touch-icon" />
  <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
  <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
  <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <script src="https://s3.amazonaws.com/wrdsb-theme/js/addtohomescreen.min.js"></script>
  <script src="https://s3.amazonaws.com/wrdsb-theme/js/jquery.floatThead.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script>
    $(document).ready(function(){
      $('table.table-fixed-head').floatThead({
        useAbsolutePositioning: false
      });
    });

    $("table").addClass("table table-striped table-bordered");
    $("table").wrap("<div class='table-responsive'></div>");
  </script>

  <?php wp_head(); ?>

  <!-- Google Analytics Tracking Code -->
  <?php //if (wrdsb_i_am_a_staff_site()) { ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-16094689-22', 'auto');
    ga('require', 'linkid');
    ga('send', 'pageview');
  </script>
  <?php //} ?>
</head>

<body id="top" class="layout layout-vertical layout-left-navigation layout-below-toolbar layout-below-footer">

<!-- Facebook Code -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=609688172419098";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- header -->
<div class="container container-top">
  <div class="header">
    <div class="row">
      <div class="col-md-9 col-sm-8">
        <div id="logo" role="heading">
          <a aria-labelledby="logo" href="<?php echo home_url(); ?>/"><span><?php echo get_bloginfo('name'); ?></span>
            <p id="sitename"><?php echo get_bloginfo('name'); ?></p>
            <?php if (get_bloginfo('description') != '') { ?>
            <p id="sitedescription"><?php echo get_bloginfo('description'); ?></p>
            <?php } ?>
          </a>
        </div>
      </div>
      <div class="col-md-3 col-sm-4">
        <div class="staff-shortcuts" role="complementary" aria-labelledby="staff-shortcut-list">
          <div id="staff-shortcut-list">
            <a href="#address">Contact Information</a>
          </div>
          <div class="searchbox" role="search" aria-labelledby="search">
            <form action="<?php echo home_url(); ?>/" method="get">
              <input aria-label="Search" type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="navbar my-navbar" role="navigation" aria-labelledby="navbar-header">
    <div id="navbar-header">
      <button type="button" class="navbar-toggle togglesearch" data-toggle="collapse" data-target=".navbar-search">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-search"></span>
      </button>

      <button type="button" class="navbar-toggle togglenav" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
      <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php get_bloginfo('name'); ?></a>
    </div>
          
    <div class="collapse navbar-search" role="search" aria-labelledby="mobileSearch">
          <form action="<?php echo home_url(); ?>/" method="get">
            <input aria-label="Search" type="text" name="s" id="mobileSearch" value="<?php the_search_query(); ?>" placeholder="Search" />
          </form>
    </div>

    <div id="menu" role="navigation" aria_label="Menu">
      <?php if (has_nav_menu('top')) {
        wp_nav_menu(array('theme_location' => 'top', 'menu_class' => 'nav nav-justified', 'container_class' => 'collapse navbar-collapse'));
      } else {
        wp_page_menu(array('depth' => 1, 'show_home' => true, 'menu_class' => 'collapse navbar-collapse' ));
      } ?>
    </div>
  </div><!-- /.navbar -->
</div><!-- /.container-top -->

<div class="container container-breadcrumb" role="navigation">
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo get_option('home'); ?>">Home</a>
    </li>
    <li>
      Trillium
    </li>
    <li>
      <a href="<?php echo get_option('home'); ?>/trillium/classes">Classes</a>
    </li>
    <li>
      <a href="<?php echo get_option('home'); ?>/trillium/enrolments/?class-code=<?php echo $class_code; ?>"><?php echo $page_title; ?></a>
    </li>
    <li>
      Email List
    </li>
  </ol>
</div>

<main>
  <div class="container">
    <div class="row">
      <div id="wrapper">
        <div class="content-wrapper">
          <div class="content custom-scrollbar">
              <!-- CONTENT -->
              <div class="content container">
                <h3><?php echo $class_code ?></h3>
                <?php echo $emails_list; ?>
              </div>
              <!-- CONTENT -->
          </div> <!-- end content area -->
        </div>
      </div>
    </div>
  </div>
</main>

<div id="footer" class="footer" role="contentinfo">
  <div class="container">
    <div class="row">
      <div id="address" class="col-sm-6 col-md-3" aria-labelledby="address">
        <address>
          <h1>Waterloo Region District School Board</h1>
          <p>51 Ardelt Avenue<br />
          Kitchener, ON N2C 2R5</p>
          <p>Switchboard: 519-570-0003<br />
          <a href="https://www.wrdsb.ca/about-the-wrdsb/contact/">Contact the WRDSB</a></p>
          <p><a href="https://www.wrdsb.ca/about-the-wrdsb/contact/website-feedback/" target="_blank">Website Feedback Form</a></p>
        </address>
      </div>
      <div class="col-sm-6 col-md-3" aria-labelledby="connect-wrdsb">
      </div>
      <div class="col-sm-6 col-md-3" role="region">
      </div>
      <div class="col-sm-6 col-md-3" role="region">
        <?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
          <?php dynamic_sidebar( 'footer-right' ); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="container" id="loginbar" role="navigation" aria_labelledby="adminbar">
  <p id="adminbar" class="copyright" style="text-align: center;">
  <?php
  // Get all the information about the site
  $sitename = get_bloginfo('name');
  $siteurl = site_url();
  $parsed_url = parse_url(network_site_url());
  $host = explode('.', $parsed_url['host']);

  // create link text
  $admin_link  = '<a href="'.$siteurl.'/wp-login.php">Log into '.$sitename.'</a>';
  $staff_admin_link = ' &middot; Go to <a href="https://staff.wrdsb.ca/" target="_blank" javascript="ga(' . "'send', 'event', 'Page', 'click_banner', 'staff intranet', event.target.href,{'nonInteraction':1});" . '">Staff Intranet</a>';
  $school_handbook_link = '';

  // customize links for school network
  //if (($host[0] === 'schools' && wrdsb_i_am_a_school) || $host[0] === 'wplabs') { // for testing school pages
  if ($host[0] === 'schools' && wrdsb_i_am_a_school) {
    $fulldomain = explode('.',$_SERVER['HTTP_HOST']);
    $admin_link  = '<a href="https://schools.wrdsb.ca/'.$fulldomain[0].'/wp-login.php">Log into '.$sitename.'</a>';
    $school_handbook_link = ' &middot; Go to <a target="_blank" href="https://staff.wrdsb.ca/' .$fulldomain[0].'">'.strtoupper($fulldomain[0]).' School Handbook</a>';
  }

  // customize links for staff network
  if ($host[0] === 'staff') {
    $staff_admin_link = '';
  }

  // display the login/logout link
  if ( is_user_logged_in() ) {
    wp_loginout();
  }
  else {
    echo $admin_link;
  }

  // display the auxilliary links
  echo $staff_admin_link . $school_handbook_link; 
  ?>
  </p>
</div>

<?php wp_footer(); ?>

</body>
</html>
