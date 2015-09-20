
<div class="container">
<hr>
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
