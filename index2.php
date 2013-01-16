<?php include 'core/init.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Site from &laquo;Super-Puper&raquo;</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

  </head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Название!</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <?php if (logged_in() === true) { ?>

<ul class="nav pull-right">
                    <li class="dropdown">
                        <a href=" <?php echo $base_url . "profile/" . $user_data['username']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user_data['username']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Item 1</a></li>
                            <li><a href="#">Item 2</a></li>
                            <li><a href="#">Item 3</a></li>
                        </ul>
                    </li>
                </ul>

              <?php }else{ ?><a href="login.php">Войти</a><?php } ?>
            </p>
            <ul class="nav">
              <li class="active"><a href="<?php echo $base_url; ?>">Главная</a></li>
              <li><a href="#about">О нас</a></li>
              <li><a href="<?php echo $base_url . "contact.php"; ?>">Контакты</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <div class="hero-unit">
          <h1>Главная страница!</h1>
            <p>Здесь много всякой ерунды типа текста, картинок, музыки и видео. Из всего этого Вы можете получить массу полезной и увлекательной информации. Но... Все это будет не скоро :P</p>
            <p><a class="btn btn-primary btn-large" onclick="alert('Отсюда тоже можно будет получить информацию ;)')">Ooops &raquo;&raquo;&raquo;</a></p>
</div>


 <div class="row-fluid">
      <div class="span4"><div class="hero-unit1"><H4 style="text-align: center">TOP 5</H4></div></div>
      <div class="span4"><div class="hero-unit"><H4 style="text-align: center">TOP 10</H4></div></div>
      <div class="span4"><div class="hero-unit1"><H4 style="text-align: center">TOP 100</H4></div></div>
    </div>
 <div class="row-fluid">
      <div class="span4"><div class="hero-unit">#1</div></div>
      <div class="span4"><div class="hero-unit1"><H4 style="text-align: center">#2</H4></div></div>
      <div class="span4"><div class="hero-unit">#3</div></div>
    </div>


    </div>
    <div class="span3">

                <div class="well sidebar-nav">
            <ul class="nav nav-list">
             <?php if (logged_in() === true) {
        include 'includes/widgets/loggedin.php';
    } ?>
              <li class="nav-header">Пользователи</li>
              <li><?php
        $user_count = user_count();
        $suffix = true_end($user_count, "пользователь", "пользователя", "пользователей");
        ?>
        Зарегистрировано <?php echo $user_count . " " . $suffix; ?>.</li>
              <li class="nav-header">On-Line</li>
              <li><?php include 'includes/widgets/online.php'; ?></li>
            </ul>
          </div><!--/.well -->
    </div>
  </div>


      <hr>

      <footer class="muted">
        <p class="pull-left">&copy; OOO "Super-Puper Company" 2013</p> <img src="images/hit.png" class="img-polaroid pull-right"><img src="images/hit.gif" class="img-polaroid pull-right"><img src="http://hotlog.ru/images/counters/407.gif" class="img-polaroid pull-right">
      </footer>

    </div><!--/.fluid-container-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
