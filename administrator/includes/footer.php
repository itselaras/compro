    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Easing UI -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/redraw.js"></script>

    <!-- Datepicker -->
    <script src="js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

    <!-- CKEditor -->
    <script src="js/plugins/ckeditor/ckeditor.js"></script>

    <!-- Bootbox -->
    <script src="js/plugins/bootbox/bootbox.min.js"></script>
    <script src="js/plugins/bootbox/boot.js"></script>

    <!-- BootstrapTable -->
    <!-- <script src="js/bootstrap-table.js"></script> -->
    <script src="js/plugins/typeahead.js"></script>
    <script src="js/bootstrap-file-input.js"></script>
    
    <!-- Function -->
    <script src="js/function.js"></script>

    <!-- Chart -->
    <script src="js/plugins/morris/morris.js"></script>
    <script src="js/plugins/morris/raphael.min.js"></script>

    <!-- Ion Calendar -->
    <script src="js/plugins/bootstrap-datepicker.js"></script>




</body>

</html>

<script type="text/javascript">
    function updatePesan() {
        $.ajax({
            url: 'pesan-cek',
            dataType: 'json'
        })
        .done(function(data) {
            if(data.banyak == 0)
            {
                $('.badge-pesan').addClass('invisible');                
            } else
            {
                $('.badge-pesan').removeClass('invisible');                
                $('.badge-pesan').html(data.banyak);
            }
            if(data.banyak > 0)
            {
                $.ajax({
                    url: 'pesan-get'
                })
                .done(function(data) {
                    $('.container-pesan').html(data);
                });
            }
            if(data.notif > 0)
            {
                $('.audio-container').append('<audio class="notif-sound"><source src="notif/notif.mp3"></source></audio>');
                var audio = $('.notif-sound')[0];
                audio.play();
            }
        });
    }
    $(document).ready(function() {
        updatePesan();
        $('body').removeClass('invisible').hide().fadeIn('400');
        $('.navbar-static-top').on('click', '.menu-logout', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'logout.php',
                dataType: 'json'
            })
            .done(function(data) {
                console.log("success");
                window.location.href=data.url;
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
        $(function() {
            Example.init({
                "selector": ".bb-alert"
            });
            Error.init({
                "selector": ".bb-error"
            });
        });
        setInterval(function(){
            updatePesan();
        },10000);
    });
</script>
