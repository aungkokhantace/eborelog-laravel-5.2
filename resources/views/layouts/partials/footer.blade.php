<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y"); ?> <a href="http://fostasg.com/" target="_blank">FOSTA Pte Ltd</a>. All rights reserved.</span>
    <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span> -->
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- jquery -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

<!-- plugins:js -->
<script src="/template/vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="/template/vendors/chart.js/Chart.min.js"></script>
<script src="/template/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="/template/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="/template/js/off-canvas.js"></script>
<script src="/template/js/hoverable-collapse.js"></script>
<script src="/template/js/template.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/template/js/dashboard.js"></script>
<script src="/template/js/data-table.js"></script>
<script src="/template/js/jquery.dataTables.js"></script>
<script src="/template/js/dataTables.bootstrap4.js"></script>
<!-- End custom js for this page-->


<!-- start customized js -->
<script src="/js/form_actions.js"></script>
<!-- end customized js -->

<!-- sweet-alert js using content delivery network (CDN) -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- start jquery validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
<!-- end jquery validation -->

<!-- start signature-pad -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<!-- end signature-pad -->


<script>
  $(document).ready(function() {
    /* for flash alert to disapper automatically after timeout */
    setTimeout(function() {
      $('.alert').fadeOut();
    }, 5000);

    /* for datatable */
    $('.list-view-table').DataTable({
      // display datatable only after loading is complete 
      // (to prevent table is flashing on pageload issue)
      "initComplete": function() {
        $(".list-view-table").show();
      }
    });

    /* for tooltips */
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  });
</script>

</body>

</html>
