  <!-- Optional JavaScript -->
  <script src="<?= base_url('public/assets/js/jquery.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/popper.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>
  <!-- Appear JavaScript -->
  <script src="<?= base_url('public/assets/js/jquery.appear.js') ?>"></script>
  <!-- Countdown JavaScript -->
  <script src="<?= base_url('public/assets/js/countdown.min.js') ?>"></script>
  <!-- Counterup JavaScript -->
  <script src="<?= base_url('public/assets/js/waypoints.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/jquery.counterup.min.js') ?>"></script>
  <!-- Wow JavaScript -->
  <script src="<?= base_url('public/assets/js/wow.min.js') ?>"></script>
  <!-- Apexcharts JavaScript -->
  <script src="<?= base_url('public/assets/js/apexcharts.js') ?>"></script>
  <!-- Slick JavaScript -->
  <script src="<?= base_url('public/assets/js/slick.min.js') ?>"></script>
  <!-- Select2 JavaScript -->
  <script src="<?= base_url('public/assets/js/select2.min.js') ?>"></script>
  <!-- Owl Carousel JavaScript -->
  <script src="<?= base_url('public/assets/js/owl.carousel.min.js') ?>"></script>
  <!-- Magnific Popup JavaScript -->
  <script src="<?= base_url('public/assets/js/jquery.magnific-popup.min.js') ?>"></script>
  <!-- Smooth Scrollbar JavaScript -->
  <script src="<?= base_url('public/assets/js/smooth-scrollbar.js') ?>"></script>
  <!-- lottie JavaScript -->
  <script src="<?= base_url('public/assets/js/lottie.js') ?>"></script>
  <!-- am core JavaScript -->
  <script src="<?= base_url('public/assets/js/core.js') ?>"></script>
  <!-- am charts JavaScript -->
  <script src="<?= base_url('public/assets/js/charts.js') ?>"></script>
  <!-- am animated JavaScript -->
  <script src="<?= base_url('public/assets/js/animated.js') ?>"></script>
  <!-- am kelly JavaScript -->
  <script src="<?= base_url('public/assets/js/kelly.js') ?>"></script>
  <!-- Flatpicker Js -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- Chart Custom JavaScript -->
  <script src="<?= base_url('public/assets/js/chart-custom.js') ?>"></script>

  <!-- Custom JavaScript -->
  <script src="<?= base_url('public/assets/js/custom.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/toastr.min.js') ?>"></script>

  <!-- Datatables -->
  <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> -->

  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>


  <!-- Dropify -->
  <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>

  <!-- Datepicker -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <!-- Summernote -->
  <script src="<?= base_url('public/assets/js/summernote.min.js') ?>"></script>

  <!-- chart dashboard -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/locale/id.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script> -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-clock-timepicker@2.6.5/jquery-clock-timepicker.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJD7w_-wHs4Pe5rWMf0ubYQFpAt2QF2RA&libraries=places&language=id&callback=initMap" async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.js"></script>

  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script>
    const baseUrl = '<?= base_url(); ?>';
    const apiUrl = 'https://feedapi.connexist.id:7443/d/f';
    const imageUrl = '<?= getenv('IMAGE_URL') ?>';

    $("#eventDate").datepicker({
      dateFormat: "yy/mm/dd"
    });

    $('.dropify').dropify({
      messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove': 'Remove',
        'error': 'Ooops, something wrong appended.'
      },
      error: {
        'fileSize': 'The file size is too big (1M max).'
      }
    });

    $(document).ready(function() {
      $('#froalaContent').summernote({
        toolbar: [
          ["style", ["style"]],
          ["font", ["bold", "underline", "clear"]],
          ["color", ["color"]],
          ["para", ["ul", "ol", "paragraph"]],
          ["table", ["table"]],
          ["insert", ["link"]],
          ["view", ["fullscreen"]]
        ],
      });
      $('#froalaContent').on('summernote.paste', function(e, ne) {
        //get the text
        let inputText = ((ne.originalEvent || ne).clipboardData || window.clipboardData).getData('Text');
        // block default behavior
        ne.preventDefault();
        //modify paste text as plain text
        let modifiedText = inputText.replace(/\r?\n/g, '<br>');

        modifiedText = '<span style="color: black;">' + modifiedText + '</span>';
        //put it back in editor
        document.execCommand('insertHtml', false, modifiedText);
      })
    });
  </script>