<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">

                <div class="form-group">
                    <div class="form-group">
                        <textarea placeholder="Giver your access code" class="form-control" rows="5" id="comment"></textarea>
                    </div>

                    <button type="button" id="code" class="btn btn-danger">Add Course</button>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("code").addEventListener("click",function(){
        key = atob(document.getElementById("comment").value);

        http = '<? base_url() ?>'+'index.php?student/add_class/'+key+'/'+'<? echo $this->session->userdata("student_id") ?>';
        xml = new XMLHttpRequest();

        xml.onreadystatechange = function()
        {
            if((xml.readyState == 4) && (xml.status == 200))
            {
                alert(xml.responseText);
            }
        }

        xml.open("GET",http,false);
        xml.send();
    },false);
</script>