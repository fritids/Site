<?php include '../core/init.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Site from &laquo;Super-Puper&raquo;</title>
        <script src="http://ivaynberg.github.com/select2/js/jquery-1.7.1.min.js"></script>
<script src="http://ivaynberg.github.com/select2/js/jquery-ui-1.8.20.custom.min.js"></script>

        <script src="http://ivaynberg.github.com/select2/prettify/prettify.min.js"></script>
        <script src="../js/select2.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo $base_url; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $base_url; ?>css/style.css" rel="stylesheet" media="screen">
    <link href="<?php echo $base_url; ?>css/select2.css" rel="stylesheet" media="screen">
    <link href="<?php echo $base_url; ?>css/bootstrap-responsive.css" rel="stylesheet">
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
        $("#e6").select2({
            placeholder: "Выберите населенный пункт",
            minimumInputLength: 2,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "../data.php",
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

  </head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <div class="span12">
        <p>
            <input type="hidden" class="bigdrop" id="e6" style="width:600px"/>
        </p>
        </div>
    </div> <!-- /container -->


    <script src="<?php echo $base_url; ?>js/bootstrap.min.js"></script>
  </body>
</html>
