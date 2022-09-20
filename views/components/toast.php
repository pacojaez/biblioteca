<!-- <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
    Hello, world! This is a toast message.
   </div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div> -->
<?php if( isset($GLOBALS['mensaje']) ){

        echo "
            <div class='toast' role='alert' aria-live='assertive' aria-atomic='true' id='toastNotification' data-autohide='false' >
                <div class='toast-header'>
                    <strong class='me-auto'>Acción realizada</strong>
                    <small>Este es el mensaje del sistema</small>
                    <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
                <div class='toast-body'>";
                    echo $GLOBALS['mensaje'];
                echo "</div>
            </div>";

            echo '<script>
            $(document).ready(function alertToast(){               
                  $("#toastNotification").toast({delay: 4000});
                  $("#toastNotification").toast("show");            
              });          
            </script>';

}

