<div class="modal fade" id="HelloModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabelSigned" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="ModalLabelSigned">Welcome:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body 1">
        <div style = "align:center">
            <input type ="text" id ="Username" class="form-control validate">
            <label data-error="wrong" data-success="right" for ="Username">Username</label>
            <br>
            <input type ="password" id ="Password"  class="form-control validate">
            <label data-error="wrong" data-success="right" for ="Password">Password</label>
        </div>
      </div>
      <div id='loginError' class='text-danger' style='font-style:italic; font-size:.7em'></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='Submit'>Login</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $("#Submit").click(function(){
      $.ajax({
        type: "POST",
        url:  "scripts/InfoSet.php",
        data:
          {
            Username:$("#Username").val(),
            Password:$("#Password").val()
          },
        success: function(result)
            {
                $("#HelloModal").modal("hide");

                if(result=="Admin") window.location.href="Home.php";
                else if(result=="Server" || result=="Preparers") window.location.href="Home.php";

            }

      });
    }); //Click
  });// JQuerys
</script>
