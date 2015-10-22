<?

    if(sizeof($file_list))
    {
        ?>

        <table class="table">
            <thead>
            <tr>
                <th>Filename</th>
                <th>Uploaded time</th>
                <th>operation</th>
            </tr>
            </thead>

            <tbody>
                <?
                    foreach($file_list as $f)
                    {
                        ?>
                        <tr>
                            <td><? echo $f['f_name'] ?></td>
                            <td><? echo $f['f_date'] ?></td>
                            <td><a href="<? echo base_url().'/uploads/'.$f['f_dir'] ?>" target="_blank" class="btn btn-success">Download</a><span>  </span><a href="<? echo base_url().'index.php?'.$this->session->userdata('login_type').'/file_delete/'.$f['f_id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?
                    }
                ?>
            </tbody>
        </table>

        <?
    }
    else
    {
        echo 'there is no file uploaded here';
    }
?>


