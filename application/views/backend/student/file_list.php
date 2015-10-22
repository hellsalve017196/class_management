<?
    if(sizeof($file_list) > 0)
    {
        ?>

        <table class="table">
            <thead>
                <td>File title</td>
                <td>Upload time</td>
                <td>Download</td>
            </thead>
            <tbody>
        <?

            foreach($file_list as $f)
            {
                ?>
                <tr>
                    <td><? echo $f['f_name'] ?></td>
                    <td><? echo $f['f_date'] ?></td>
                    <td><a class="btn btn-success" href="<? echo base_url().'uploads/'.$f['f_dir'] ?>" target="_blank">Download</a></td>
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
        echo "<h1>faculty have n't uploaded any files yet</h1>";
    }
?>