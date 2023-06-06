        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <head>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../public/css/style.css" />

    <?php if (isset($data['script'])) {
                foreach ($data['script'] as $script) { ?>
                    <script type="text/javascript" src="../public/js/<?= $script ?>"></script>
                <?php } 
            } ?>

    <title>
        <?php echo $data['title']; ?>
    </title>

</head>
        
        <footer class="page-footer font-small teal pt-4 ">


<!-- Footer -->


  <!-- Footer LIENS -->
  <div style="background: #101820;text-align:center">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- LIENS -->
        <h3 class="font-weight-bold text-uppercase mt-3 mb-4" style="color:white;"></h3>

        <ul class="list-unstyled">
          <img style="max-width:45%" src="public/img/ASRII_LOGO-FULL-2.png">
          <img style="max-width:55%" src="public/img/ASRII_TXT-V.png">
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- LIENS -->
        <h3 class="font-weight-bold text-uppercase mt-3 mb-4" style="color:white;padding-top:12%">LIENS</h3>

        <ul class="list-unstyled">
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 1</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 2</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 3</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 4</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- LIENS -->
        <h3 class="font-weight-bold text-uppercase mt-3 mb-4" style="color:white; padding-top:12%">LIENS</h3>

        <ul class="list-unstyled">
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 1</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 2</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 3</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 4</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- LIENS -->
        <h3 class="font-weight-bold text-uppercase mt-3 mb-4" style="color:white; padding-top:12%">LIENS</h3>

        <ul class="list-unstyled">
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 1</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 2</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 3</a>
          </li>
          <li>
            <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#!">Link 4</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer LIENS -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">© 2022-2023 CoopTeam - Copyright
    <a href="/"> </a>
  </div>
  <!-- Copyright -->
<!-- Footer -->
        </footer>

    </body>
</html>
