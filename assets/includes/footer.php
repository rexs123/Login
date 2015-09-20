
<div class="container">
<hr>
<?php $sql = "SELECT * FROM settings"; $result = mysqli_query($conn, $sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {  echo  '&copy; '. date(Y) .' '. $row['copyright']; }}?>
<p class="pull-right"> Designed by <a href="http://rexsdev.com">Rexsdev</a> | Powered by <a href="http://simplex.rexsdev.com">Simplex</a>, running version <?php echo $ver; ?></p>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script> 
<script src="<?php echo DIR;?>/assets/js/bootstrap.js"></script>
<script src="<?php echo DIR;?>/assets/js/ps.js"></script>
<script src="<?php echo DIR;?>/assets/js/search.js"></script>
   <script src="https://rexsdev.com/assets/js/tooltip.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            "use strict";
            var options = {};
            options.ui = {
                container: "#pwd-container",
                showStatus: true,
                showProgressBar: false,
                viewports: {
                    verdict: ".pwstrength_viewport_verdict"
                }
            };
            $(':password').pwstrength(options);
        });
    </script>
</html>
