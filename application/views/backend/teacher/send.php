<form role="form" style="font-weight: bold">
    <div style="display: none" id="flag">normal</div>
    <div class="form-group">
        <label for="email">msg type:</label>
        <select id="msg_type" class="form-control">
            <option value="normal">normal</option>
            <option value="class">class</option>
        </select>
    </div>

    <div class="form-group" id="res" style="display: none">
        <label for="email">select class:</label>
        <?
            if(sizeof($class_data) > 0)
            {
                ?>
                    <select class="form-control" id="class">
                <?
                foreach($class_data as $c)
                {
                    ?>
                    <option value="<? echo $c['class_id'] ?>"><? echo $c['name'] ?></option>
                    <?
                }
                ?>
                    </select>
            <?
            }
            else
            {
                echo "you hanen't created any class";
            }
        ?>
    </div>

    <div class="form-group" id="email_form">
        <label for="email">Email address:</label>
        <input type="text" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="title">message title:</label>
        <input type="text" class="form-control" id="title">
    </div>

    <div class="form-group">
        <label for="message">message:</label>
        <br>
        <textarea id="message" rows="5" style="width: 100%"></textarea>
    </div>

    <button type="button" id="send" class="btn btn-success"><i class="entypo-mail"></i>send</button>
</form>

<script type="text/javascript">

    $(document).ready(function() {
        //chosing msg types
        $("#msg_type").change(function() {
            flag = $(this).val();

            if(flag == 'class')
            {
                $("#email_form").hide();
                $("#res").show();

                $("#flag").html('class');
            }
            else
            {
                $("#email_form").show();
                $("#res").hide();

                $("#flag").html('normal');
            }
        });

        //sending msg
        $("#send").on('click',function() {

            flag = $("#flag").html();

            if(flag == 'normal')
            {
                m_to = $("#email").val();
                m_title = $("#title").val();
                m_msg = $("#message").val();
                m_from = '<? echo $this->session->userdata('email'); ?>';

                if((m_to != '') && (m_title != '') && (m_from != '') && (m_msg != ''))
                {
                    msg_data = JSON.stringify({'m_from':m_from,'m_to':m_to,'m_title':m_title,'m_msg':m_msg});
                    http = '<? base_url() ?>'+'index.php?teacher/single_msg/'
                    $.ajax({
                        method:'post',
                        url:http,
                        data:{'msg':msg_data},
                        success:function(data)
                        {
                            alert(data);
                            $("#email").val('');
                            $("#title").val('');
                            $("#message").val('');
                        }
                    });
                }
                else
                {
                    alert("plese fill the fields properly");
                }
            }
            else
            {
                class_id = $("#class").val();
                m_title = $("#title").val();
                m_msg = $("#message").val();
                m_from = '<? echo $this->session->userdata('email'); ?>';

                if((class_id != '') && (m_title != '') && (m_from != '') && (m_msg != ''))
                {
                    msg_data = JSON.stringify({'m_from':m_from,'class_id':class_id,'m_title':m_title,'m_msg':m_msg});

                    http = '<? base_url() ?>'+'index.php?teacher/class_msg/'

                    $.ajax({
                        method:'post',
                        url:http,
                        data:{'msg':msg_data},
                        success:function(data)
                        {
                            alert(data);
                            $("#title").val('');
                            $("#message").val('');
                        }
                    });
                }
                else
                {
                    alert("plese fill the fields properly");
                }
            }

        });

    });
</script>