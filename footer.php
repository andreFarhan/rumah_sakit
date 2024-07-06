<footer class="page-footer text-center text-md-left">
	<div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        &#xA9; 2023 Copyright: <p> Rumah Sakit </p>
      </div>
    </div>
</footer>

<script src="bootstrap/js/jquery-3.4.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/jquery.dataTables.min.js"></script>
<script src="bootstrap/js/dataTables.bootstrap4.min.js"></script>
<script src="font-awesome/js/all.min.js"></script>
<script src="sweetalert/js/sweetalert2.all.min.js"></script>
<script>
  $(document).ready(function() {
  	$('#Table').DataTable();
  });

  $('#Table').dataTable( {
    "order" : []
  } );

  $(".button-collapse").sideNav();

  new WOW().init();
</script>

<?php 
if (isset($_SESSION['alert'])) {alert();} ?>
  