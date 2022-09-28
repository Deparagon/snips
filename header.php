<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Snips ">
    <meta name="generator" content="Snips">

    <?php

    switch (basename($_SERVER['PHP_SELF'])) {
        case 'categories.php':
            $title = 'Snippet Categories';
            $page = 'categories';
            break;
        case 'projects.php':
            $title = 'Projects';
            $page = 'projects';
            break;

        case 'index.php':
            $title = 'Snippets';
            $page = 'snippets';
            break;


        
        default:
            $title = 'Home';
            $page = 'home';
            break;
    }
     


    ?>
    <title><?php echo $title; ?></title>

<link href="assets/css/bootstrap.min.css" rel="stylesheet" >
<link href="assets/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="assets/css/codemirror.css" rel="stylesheet">
<link href="assets/css/foldgutter.css" rel="stylesheet">
<link href="assets/css/dialog.css" rel="stylesheet">
<link href="assets/css/monokai.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">

    <!-- Favicons -->
<!-- <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<link rel="mask-icon" href="assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="assets/img/favicons/favicon.ico"> -->
<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/sidebars.css" rel="stylesheet">
  </head>
