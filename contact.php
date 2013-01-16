<?php include 'core/init.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Site from &laquo;Super-Puper&raquo;</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo $base_url; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $base_url; ?>css/style.css" rel="stylesheet" media="screen">
    <link href="<?php echo $base_url; ?>css/bootstrap-responsive.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#form').submit(function(){
                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url; ?>login.php",
                    data: "username=" + $('#login').val() + "&password=" + $('#password').val(),
                    success: function(msg){
                        // Допустим ошибка
                        if(msg == "good") {
                            // Просто обновим страницу
                            window.location.reload();
                        }else{
                            $('#error').css("display", "");
                            $('#error').html(msg);
                        }
                    }
                });
                return false;
            });
        });
    </script>
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
              </p>
            <ul class="nav">
              <li><a href="<?php echo $base_url; ?>"><i class="icon-home icon-white"></i>Главная</a></li>
              <li><a href="#about">О нас</a></li>
              <li class="active"><a href="<?php echo $base_url . "contact.php"; ?>">Контакты</a></li>
            </ul>
          </div><!--/.nav-collapse -->
         <?php if (logged_in() === true) { ?>
<ul class="nav pull-right">

                    <li class="dropdown">
                       <a href=" <?php echo $base_url . "profile/" . $user_data['username']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user_data['username']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Item 1</a></li>
                            <li><a href="#">Item 2</a></li>
                            <li><a href="<?php echo $base_url; ?>logout.php">Выйти</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right"><span class="navbar-text pull-right">Вы вошли как </span></ul>
                <?php } else{ ?>
                <ul class="nav pull-right">
         <li><a href="<?php echo $base_url; ?>register.php">Регистрация</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Войти <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">




              <form action="" method="post" accept-charset="UTF-8" id="form">
                  <div style="display: none;" class="alert alert-error" id="error"></div>
  <input style="margin-bottom: 15px;" type="text" name="username" id="login" />
  <input style="margin-bottom: 15px;" type="password" name="password" id="password" />
<input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />
</form>

            </div>
          </li>
        </ul><?php } ?>

        </div>
      </div>
    </div>

    <div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <div class="hero-unit">
          <h1>Наши контакты</h1>
            <hr>
            <ul>
                <li>Телефон: +7 (123) 123 4567</li>
                <li>E-Mail: floopyman007@gmail.com</li>
            </ul>
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
