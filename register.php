<?php include 'core/init.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Site from &laquo;Super-Puper&raquo;</title>
        <script src="js/jquery.min.js"></script>
        <script src="js/select2.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link href="css/select2.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#form').submit(function(){
                var some = $('#user_remember_me').is(':checked') ? "1" : "0";
                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url; ?>login.php",
                    data: "username=" + $('#login').val() + "&password=" + $('#password').val() + "&remember=" + some,
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
              <li><a href="<?php echo $base_url . "contact.php"; ?>">Контакты</a></li>
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
         <li class="active"><a href="<?php echo $base_url; ?>register.php">Регистрация</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Войти <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">




              <form action="" method="post" accept-charset="UTF-8" id="form">
                  <div style="display: none;" class="alert alert-error" id="error"></div>
  <input style="margin-bottom: 15px;" type="text" name="username" id="login" />
  <input style="margin-bottom: 15px;" type="password" name="password" id="password" />
<input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="remember_me" value="1" />
  <label class="string optional" for="user_remember_me"> Remember me</label>

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
         <?php if (empty($_POST) === false) {
    $required_fields = array('username', 'password', 'password_again', 'first_name', 'email', 'city');
    foreach($_POST as $key=>$value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fields marked with an asterisk are required';
            break 1;
        }
    }

    if (empty($errors) === true) {
        if (user_exists($_POST['username']) === true) {
            $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
        }
        if (preg_match("/\\s/", $_POST['username']) == true) {
            $errors[] = 'Your username must not contain any spaces.';
        }
        if (strlen($_POST['password']) < 6) {
            $errors[] = 'Your password must be at least 6 characters';
        }
        if ($_POST['password'] !== $_POST['password_again']) {
            $errors[] = 'Your password do not match';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'A valid email adress is required';
        }
        if (email_exists($_POST['email']) === true) {
            $errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
        }
    }
}

?>
<link rel="stylesheet" href="css/complete.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="js/jquery.ausu-autosuggest.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

// Validation
$("#register").validate({
rules:{
username:"required",
email:{required:true,email: true},
password:{required:true,minlength: 6},
password_again:{required:true, minlength: 6},
first_name:"required"
},

messages:{
username:{
required:"Введите имя пользователя"},
email:{
required:"Введите email",
email:"Введите правильный email"},
password:{
required:"Введите пароль",
minlength:"Пароль должен содержать не менее 6 символов"},
password_again:{
required:"Повторите пароль",
minlength:"Пароли должны совпадать"},
first_name:{
required:"Введите Ваше настроящее имя"},
},

errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass)
{
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass)
{
$(element).parents('.control-group').removeClass('error');
$(element).parents('.control-group').addClass('success');
}
});
});
</script>
<script>

    function cityFormatResult(city) {
        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + city.city_name_ru + "</div>";
        markup += "</td></tr></table>"
        return markup;
    }

    function cityFormatSelection(city) {
        return city.city_name_ru;
    }

</script>
<script>
    $(document).ready(function() {
        $("#cityID").select2({
            placeholder: "Выберите населенный пункт",
            minimumInputLength: 2,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "data.php",
                dataType: 'json',
                data: function (term, page) {
                    return {
                        data: term

                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {results: data.city};
                }
            },
            formatResult: cityFormatResult, // omitted for brevity, see the source of this page
            formatSelection: cityFormatSelection,  // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop" // apply css that makes the dropdown taller
        });
    });
</script>
<h2>Регистрация</h2>
<?php
if (isset($_GET['success']) && empty($_GET['success'])) {
    echo 'You\'ve been registered successfully! Please check your email to activate your account.';
} else {
    if (empty($_POST) === false && empty($errors) === true) {
        $register_data = array(
            'username'       => $_POST['username'],
            'password'       => $_POST['password'],
            'first_name'     => $_POST['first_name'],
            'last_name'      => $_POST['last_name'],
            'email'          => $_POST['email'],
            'email_code'     => md5($_POST['username'] + microtime()),
            'city_id'        => $_POST['cityID']
        );
        register_user($register_data);

        header('Location: register.php?success');
        exit();

    } else if (empty($errors) === false) {
        echo output_errors($errors);
    }
?>
    <form class="form-horizontal" method='post' action='' id="register">
      <fieldset>
        <div class="control-group">
          <label class="control-label" for="input01">Имя пользователя</label>
          <div class="controls">
            <input type="text" class="input-xlarge"name="username">

          </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="input01">Пароль*</label>
          <div class="controls">
            <input type="password" class="input-xlarge" name="password" id="password">

          </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01">Повторите пароль*</label>
          <div class="controls">
            <input type="password" class="input-xlarge"name="password_again">

          </div>
    </div>

     <div class="control-group">
        <label class="control-label" for="input01">Email*</label>
          <div class="controls">
            <input type="text" class="input-xlarge" name="email">

          </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="input01">Имя*</label>
          <div class="controls">
            <input type="text" class="input-xlarge" name="first_name">

          </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="input01">Фамилия</label>
          <div class="controls">
            <input type="text" class="input-xlarge" name="last_name">

          </div>
    </div>

<div class="control-group">
        <label class="control-label" for="input01">Город</label>
          <div class="controls">
                    <input type="hidden" class="bigdrop" id="cityID" name="cityID" style="width:310px"/>
                </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="input01"></label>
          <div class="controls">
           <button type="submit" class="btn btn-success" rel="tooltip" title="first tooltip">Зарегистрироваться</button>

          </div>

    </div>



      </fieldset>
    </form>

<?php
}?>
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


    <script src="<?php echo $base_url; ?>js/bootstrap.min.js"></script>
  </body>
</html>
