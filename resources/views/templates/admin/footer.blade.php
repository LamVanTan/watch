  


    
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    
    <script src="{{$adminUrl}}/vendors/js/core.js"></script>
    <!-- endinject -->
    <!-- Vendor Js For This Page Ends-->
    <script src="{{$adminUrl}}/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="{{$adminUrl}}/vendors/chartjs/Chart.min.js"></script>
    <script src="{{$adminUrl}}/js/charts/chartjs.addon.js"></script>
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    <script src="{{$adminUrl}}/js/template.js"></script>
    <script src="{{$adminUrl}}/js/dashboard.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

    <script>


  $(document).ready(function(){

    // Define function to open filemanager window
    var lfm = function(options, cb) {
      var route_prefix =(options && options.prefix) ? options.prefix : '/public/laravel-filemanager';
      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
      var ui = $.summernote.ui;
      var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Insert image with filemanager',
        click: function() {

          lfm({type: 'image', prefix: '/public/laravel-filemanager'}, function(lfmItems, path) {
            lfmItems.forEach(function (lfmItem) {
              context.invoke('insertImage', lfmItem.url);
            });
          });

        }
      });
      return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('#summernote-editor').summernote({
      toolbar: [
        
         ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']],
          ['popovers', ['lfm']]
      ],
      buttons: {
        lfm: LFMButton
      }
    })
  });
</script>
  @if(Session::has('message'))
    @php 
      $message = Session::get('message');
    @endphp
            <script type="text/javascript">
              var tb = '{{$message}}';         
              alert(tb);
            </script>
  @endif
    <!-- endbuild -->
  </body>
</html>
