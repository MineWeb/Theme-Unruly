<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eywek,Orphevs">

    <title><?= $seo_config['title'] ?></title>
    <link rel="icon" type="image/png" href="<?= $seo_config['favicon_url'] ?>"/>
    <meta name="title" content="<?= $seo_config['title'] ?>">
    <meta property="og:title" content="<?= $seo_config['title'] ?>">
    <meta name="description" content="<?= $seo_config['description'] ?>">
    <meta property="og:description" content="<?= $seo_config['description'] ?>">
    <meta property="og:image" content="<?= $seo_config['img_url'] ?>">

    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('modern-business.css') ?>
    <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('../font-awesome-4.1.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('flat.css') ?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
    <?= $this->Html->script('jquery-1.11.0.js') ?>
    <?= $this->Html->script('easy_paginate.js') ?>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <head> Unruly -->
    <?= $this->Html->css('Unruly-Main.css'); ?>
    <?= $this->Html->css('Unruly-Mobile.css'); ?>
    <?= $this->element('colors'); ?>
    <?= $this->element('css-custom'); ?>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,500" rel="stylesheet">
        
</head>
<body>
<?php if(!isset($theme_config['loading']) || $theme_config['loading'] == "true") { ?>
    <?= $this->Html->script('loading.js') ?>
<?php } ?>

  <?php if(isset($Lang)) { ?>
    <div class="back-nav"></div>
    <div class="menu">
    <div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container nav-content">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= $this->Html->url('/') ?>">
                    <?php
                      if(isset($theme_config['logo']) && $theme_config['logo']) {
                        //echo $this->Html->image($theme_config['logo']);
                        echo '<img src="'.$theme_config['logo'].'">';
                      } else {
                        echo '<p>'.$website_name.'</p>';
                      }
                      ?>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="li-nav">
                        <a href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME') ?></a>
                    </li>
                    <?php
                        if(!empty($nav)) {
                          $i = 0;
                          foreach ($nav as $key => $value) { ?>
                            <?php if(empty($value['Navbar']['submenu'])) { ?>
                              <li class="li-nav<?php if($this->params['controller'] == $value['Navbar']['name']) { ?> actived<?php } ?>">
                                  <a href="<?= $value['Navbar']['url'] ?>"<?= ($value['Navbar']['open_new_tab']) ? ' target="_blank"' : '' ?>><?= $value['Navbar']['name'] ?></a>
                              </li>
                            <?php } else { ?>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $value['Navbar']['name'] ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                <?php
                                $submenu = json_decode($value['Navbar']['submenu']);
                                foreach ($submenu as $k => $v) {
                                ?>
                                  <li><a href="<?= rawurldecode($v) ?>"<?= ($value['Navbar']['open_new_tab']) ? ' target="_blank"' : '' ?>><?= rawurldecode(str_replace('+', ' ', $k)) ?></a></li>
                                <?php } ?>
                                </ul>
                              </li>
                            <?php } ?>
                    <?php
                          $i++;
                        }
                      } ?>
                    <div class="connexion_bg">
                    <li class="button">
                        <div class="btn-group">
                          <?php if(isset($isConnected) && $isConnected) { ?>
                            <a href="<?= $this->Html->url('/profile') ?>" class="btn-a">
                            <button type="button" class="btn btn-success">
                                
                                <img src="https://minotar.net/helm/<?= $user['pseudo'] ?>/19.png"><?= $user['pseudo'] ?>
                                
                            </button>
                            </a>
                          <?php } else { ?>
                            <a href="#" data-toggle="modal" data-target="#login" class="btn-a">
                            <button type="button" class="btn btn-success" style="min-height: 35px;">
                                SE CONNECTER
                            </button>
                            </a>
                          <?php } ?>
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="notification-indicator"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <?php if($isConnected) { ?>
                              <li><a href="<?= $this->Html->url(array('controller' => 'profile', 'action' => 'index', 'plugin' => false)) ?>"><?= $Lang->get('USER__PROFILE') ?></a></li>
                              <li style="position:relative;">
                                <a href="#notifications_modal" onclick="notification.markAllAsSeen(2)" data-toggle="modal"><?= $Lang->get('NOTIFICATIONS__LIST') ?></a>
                                <span class="notification-indicator"></span>
                              </li>
                              <?php if($Permissions->can('ACCESS_DASHBOARD')) { ?>
                                
                                    <li><a href="<?= $this->Html->url(array('controller' => 'admin', 'action' => 'index', 'plugin' => false, 'admin' => true)) ?>"><?= $Lang->get('GLOBAL__ADMIN_PANEL') ?></a></li>
                              <?php } ?>
                              
                              <li><a href="<?= $this->Html->url(array('controller' => 'user', 'action' => 'logout', 'plugin' => false)) ?>"><?= $Lang->get('USER__LOGOUT') ?></a></li>
                            <?php } else { ?>
                              <li><a href="#" data-toggle="modal" data-target="#login"><?= $Lang->get('USER__LOGIN') ?></a></li>
                              <li><a href="#" data-toggle="modal" data-target="#register"><?= $Lang->get('USER__REGISTER') ?></a></li>
                            <?php } ?>
                          </ul>
                        </div>
                    </li>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    </div>
    </div>
  <?php } ?>
    <div class="nav-hop hidden-xs"></div>
    <?php
    $flash_messages = $this->Session->flash();
    if(!empty($flash_messages)) {
      echo '<div class="container">'.$flash_messages.'</div>';
    } ?>
    <?= $this->fetch('content'); ?>
    <!-- Footer -->
  <?php if(isset($Lang)) { ?>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p><?= $Lang->get('GLOBAL__FOOTER') ?></p>
          </div>
        </div>
      </div>
    </footer>



    <?= $this->element('modals') ?>

    <?= $this->Html->script('jquery-1.11.0.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>

    <?= $this->Html->script('app.js') ?>
    <?= $this->Html->script('form.js') ?>
    <?= $this->Html->script('notification.js') ?>
    <script>
    <?php if($isConnected) { ?>
      // Notifications
        var notification = new $.Notification({
          'url': {
            'get': '<?= $this->Html->url(array('plugin' => false, 'controller' => 'notifications', 'action' => 'getAll')) ?>',
            'clear': '<?= $this->Html->url(array('plugin' => false, 'controller' => 'notifications', 'action' => 'clear', 'NOTIF_ID')) ?>',
            'clearAll': '<?= $this->Html->url(array('plugin' => false, 'controller' => 'notifications', 'action' => 'clearAll')) ?>',
            'markAsSeen': '<?= $this->Html->url(array('plugin' => false, 'controller' => 'notifications', 'action' => 'markAsSeen', 'NOTIF_ID')) ?>',
            'markAllAsSeen': '<?= $this->Html->url(array('plugin' => false, 'controller' => 'notifications', 'action' => 'markAllAsSeen')) ?>'
          },
          'messages': {
            'markAsSeen': '<?= $Lang->get('NOTIFICATION__MARK_AS_SEEN') ?>',
            'notifiedBy': '<?= $Lang->get('NOTIFICATION__NOTIFIED_BY') ?>'
          }
        });
    <?php } ?>

    // Config FORM/APP.JS

    var LIKE_URL = "<?= $this->Html->url(array('controller' => 'news', 'action' => 'like')) ?>";
    var DISLIKE_URL = "<?= $this->Html->url(array('controller' => 'news', 'action' => 'dislike')) ?>";

    var LOADING_MSG = "<?= $Lang->get('GLOBAL__LOADING') ?>";
    var ERROR_MSG = "<?= $Lang->get('GLOBAL__ERROR') ?>";
    var INTERNAL_ERROR_MSG = "<?= $Lang->get('ERROR__INTERNAL_ERROR') ?>";
    var FORBIDDEN_ERROR_MSG = "<?= $Lang->get('ERROR__FORBIDDEN') ?>"
    var SUCCESS_MSG = "<?= $Lang->get('GLOBAL__SUCCESS') ?>";

    var CSRF_TOKEN = "<?= $csrfToken ?>";
    </script>

    <?php if(isset($google_analytics) && !empty($google_analytics)) { ?>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?= $google_analytics ?>', 'auto');
        ga('send', 'pageview');
      </script>
    <?php } ?>
    <?= (isset($configuration_end_code)) ? $configuration_end_code : '' ?>
  <?php } ?>
    
  <!-- JS Theme Unruly -->
    
    <script type="text/javascript">
        jQuery('.sword').click(function(){
          $('.sword').toggleClass('diamond');
        });
    </script>
    
</body>

</html>
