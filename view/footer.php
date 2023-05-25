        <footer>

            <!-- Bootstrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
            
            <!-- Font Awesome -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
            
            <!-- Custom -->
            <?php if (isset($data['script'])) {
                foreach ($data['script'] as $script) { ?>
                    <script type="text/javascript" src="../public/js/<?= $script ?>"></script>
                <?php } 
            } ?>

        </footer>
    </body>
</html>
