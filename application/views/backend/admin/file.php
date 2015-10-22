<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#file_upload" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('file_upload');?>
                </a>
            </li>
            <li>
                <a href="#file_list" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('file_list');?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->
        <div class="tab-content">

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box active" id="file_upload" style="padding: 5px">
                <div class="box-content">
                    <?
                    if(sizeof($class) > 0)
                    {
                        ?>
                        <form role="form" id="form"  enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="class">Select class:</label>
                                <select id="class" class="form-control">
                                    <?
                                    foreach($class as $c)
                                    {
                                        ?>
                                        <option value="<? echo $c['class_id'] ?>"><? echo $c['name'] ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file_name">file title:</label>
                                <input type="text" class="form-control" id="file_name">
                            </div>
                            <div class="form-group">
                                <label for="file_dir">upload file:</label>
                                <input type="file" name="userfile" class="form-control" id="file_dir">
                            </div>
                            <button type="button" onclick="uploadFile()" class="btn btn-success">Upload</button>
                        </form>
                        <div id="progress" style="display: none">
                            <h2>Uploading File</h2>
                            <div class="progress">
                                <div class="progress-bar" id="progressing" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">

                                </div>
                            </div>
                        </div>

                    <?
                    }
                    else
                    {
                        echo "you have n't created any class";
                    }
                    ?>
                </div>
            </div>
            <!----CREATION FORM ENDS--->

            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box" id="file_list">
                <?
                if(sizeof($class) > 0)
                {
                    ?>

                    <form role="form">
                        <div class="form-group">
                            <label for="c">Select class:</label>
                            <select id="c" class="form-control">
                                <?
                                foreach($class as $c)
                                {
                                    ?>
                                    <option value="<? echo $c['class_id'] ?>"><? echo $c['name'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                        <button type="button" onclick="zn()" class="btn btn-danger">view files</button>
                    </form>

                <?
                }
                else
                {
                    echo "you have n't created any class";
                }
                ?>
            </div>
            <!----TABLE LISTING ENDS--->

        </div>
    </div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">
    function zn()
    {
        class_id = $("#c").val();

        http = '<?  echo base_url().'index.php?modal/popup/file_manage/'  ?>'+class_id;

        showAjaxModal(http);
    }



    /*          file upload percentage            */
    function uploadFile() {
        var fd = new FormData();

        file_name = $("#file_name").val();
        class_id = $("#class").val();

        if(($.trim(file_name) != '') && ($.trim(class_id) != ''))
        {
            $("#form").hide();
            $("#progress").show();

            file_data = JSON.stringify({'f_name':file_name,'class_id':class_id});

            fd.append("userfile", document.getElementById('file_dir').files[0]);
            fd.append("file_data", file_data);

            http = '<? echo base_url().'index.php?'.$this->session->userdata('login_type').'/file_upload' ?>';

            var xhr = new XMLHttpRequest();

            xhr.upload.addEventListener("progress", uploadProgress, false);
            xhr.upload.addEventListener("load", uploadComplete, false);
            xhr.upload.addEventListener("error", uploadFailed, false);
            xhr.upload.addEventListener("abort", uploadCanceled, false);

            xhr.open("POST", http);

            xhr.setRequestHeader('Cache-Control','no-cache');

            xhr.send(fd);

            function uploadProgress(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                    document.getElementById("progressing").style.width = percentComplete.toString() + '%';
                    document.getElementById("progressing").innerHTML = percentComplete.toString() + '%';
                }
                else {
                    document.getElementById('progress').innerHTML = 'unable to compute';
                }
            }

            function uploadComplete(evt) {
                /* This event is raised when the server send back a response */
                alert('successfully uploaded :D');
                http = '<? echo base_url().'index.php?'.$this->session->userdata('login_type').'/file_upload_view/' ?>';

                window.location = http;
            }

            function uploadFailed(evt) {
                alert("There was an error attempting to upload the file.");
            }

            function uploadCanceled(evt) {
                alert("The upload has been canceled by the user or the browser dropped the connection.");
            }

        }
        else
        {
            alert("please fill up the form properly");
        }

    }
    /*          file upload percentage            */



    jQuery(document).ready(function($)
    {
        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>