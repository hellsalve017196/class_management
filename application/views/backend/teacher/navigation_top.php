<?
    $flag = false;

    $query = $this->db->query("SELECT m_id FROM message WHERE m_to = '".$this->session->userdata("email")."' AND m_read = 1");

    if($query->num_rows() > 0)
    {
        $flag = true;
    }
?>


<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="<? echo base_url().'index.php?'.$this->session->userdata("login_type").'/'.'send_msg_form' ?>"><i class="entypo-mail"></i>send</a>
                </li>
                <li><a href="<? echo base_url().'index.php?'.$this->session->userdata("login_type").'/'.'message_list' ?>"><i class="entypo-cloud-thunder"></i>message<? if($flag) { echo "(New)"; } ?></a>
                </li>
                <li><a href="<? echo base_url().'index.php?'.$this->session->userdata("login_type").'/'.'file_upload_view' ?>"><i class="entypo-attach"></i>Files</a>
                </li>
            </ul>
        </div>
    </div>
</div>