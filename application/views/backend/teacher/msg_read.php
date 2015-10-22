<? if(sizeof($msg) > 0) { ?>
<div class="col-md-12" style="color:black;font-size: 15px;font-family: "Courier New", Courier, monospace">
    <div class="col-md-12">
        <p>from:    <? echo $msg['m_from'] ?></p>
        <p>time:    <? echo $msg['m_date'] ?></p>
        <p style="display: none" id="dark"><? echo $msg['m_msg']; ?></p>
    </div>
    <div class="col-md-12">
        <?
    $deep = json_decode($msg['m_msg'],true);
    ?>
            <table class="table">
        <?

    $messages = $deep['msg'];

    foreach($messages as $m)
    {
        ?>
        <tr><td><p><? echo $m['from'] ?> <strong>said:</strong></p><h3><? echo $m['said'] ?></h3></td></tr>
    <?
    }

    ?>
            </table>
    </div>
    <br>
    <div class="col-md-12">
        <textarea placeholder="reply msg here" id="reply" class="form-control" style="width: 100%;" rows="5"></textarea>
        <br>
        <button onclick="zn('<? echo $msg['m_id'] ?>','<? echo $msg['m_to'] ?>','<? echo $msg['m_from'] ?>','<? echo $msg['m_title'] ?>')" class="btn btn-success"><i class="entypo-mail"></i>reply</button>
    </div>
</div>
<?  }  else {
    echo "invalid message,go away";
} ?>

<script type="text/javascript">
    function zn(m_id,m_from,m_to,m_title)
    {
        message_list_main = JSON.parse($("#dark").html());
        message_list_main = message_list_main['msg'];
        obj = new Date();
        date = obj.getFullYear()+"-"+obj.getMonth()+"-"+obj.getDate()+" "+obj.getHours()+":"+obj.getMinutes()+":"+obj.getSeconds();

        reply = $("#reply").val();

        if($.trim(reply) != '')
        {
            message_list_main.push({'from':m_from,'said':reply});

            msg_data = JSON.stringify({ 'm_id':m_id,'m_from':m_from,'m_to':m_to,'m_read':'1','m_title':m_title,'m_date':date,'m_msg':JSON.stringify({'msg':message_list_main}) });
            http = '<? base_url() ?>'+'index.php?'+'<? echo $this->session->userdata('login_type') ?>'+'/message_reply/';

            $.ajax({
                'url':http,
                'method':'POST',
                'data':{'msg_reply':msg_data},
                'success':function(data)
                {
                    alert(data);
                    window.location = '<? base_url() ?>'+'index.php?'+'<? echo $this->session->userdata('login_type') ?>'+'/message_list/';
                }
            });

        }
        else
        {
            alert("reply properly");
        }

    }
</script>