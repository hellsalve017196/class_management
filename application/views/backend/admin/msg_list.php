<div class="col-md-12">
    <table class="table" style="color: black;font-weight: bold">
        <tr>
            <td>message title</td>
            <td>time</td>
            <td>from</td>
            <td>decison</td>
        </tr>
        <?
            if(sizeof($msg_list) > 0)
            {
                foreach($msg_list as $m)
                {
                    $flag = true;

                    if($m['m_read'] === '0')
                    {
                        $flag = false;
                    }

                    ?>
                    <tr style="color:blue;<? if(!$flag) { echo 'font-weight:100'; } ?>">
                        <td><? echo $m['m_title'] ?></td>
                        <td><? echo $m['m_date'] ?></td>
                        <td><? echo $m['m_from'] ?></td>
                        <td><a class="sam" href="<? echo base_url().'index.php?'.$this->session->userdata('login_type').'/message_read/'.$m['m_id'] ?>" style="color: #00b4f5;">view</a> <a href="<? echo base_url().'index.php?'.$this->session->userdata('login_type').'/delete_message/'.$m['m_id'] ?>" class="sam" style="color: #00b4f5;">delete</a></td>
                    </tr>
                    <?
                }
            }
            else
            {
                echo "there is no message";
            }
        ?>
    </table>
</div>

<script>
        $(".sam").mouseover(function() {
            $(this).css({'color':'red'});
        });

        $(".sam").mouseout(function() {
            $(this).css({'color':'#00b4f5'});
        });
</script>