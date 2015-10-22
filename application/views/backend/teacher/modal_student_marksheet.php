<?

    function grade_temp($mark,$grade_list)
    {
        $grade = '';
        foreach($grade_list as $g)
        {
            if(($mark >= $g['mark_from']) and ($mark <= $g['mark_upto']))
            {
                $grade = $g['name'];
                break;
            }
        }

        return $grade;
    }


    if(sizeof($data) > 0)
    {
        $str = '<table class="table table-bordered"><thead><tr><td>Name</td><td>Mark total</td><td>Mark obtained</td><td>Percentage set by faculty</td><td>obtained(percentage)</td></tr></thead>';

        $table = '';
        $total = 0;
        $fac_per = 0;

        foreach($data as $d)
        {
                          $obtained = intval(($d['mark_obtained']*$d['value'])/$d['mark_total']);
                          $total = $total + $obtained;

                          $fac_per = $fac_per + $d['value'];
                          $table = $table .'<tr><td>'.$d['name'].'</td><td>'.$d['mark_total'].'</td><td>'.$d['mark_obtained'].'</td><td>'.$d['value'].'%</td><td>'.$obtained.'%</td></tr>';
        }
                      $current_mark = intval(($total/$fac_per)*100);

        $str = $str . $table . '<tr><td></td><td></td><td></td><td>total percentage:'.$fac_per.'%</td><td>percentage obtained:    '.$total.'%<br>(out of 100):     '.$current_mark.'<br>grade:     '.grade_temp($current_mark,$grade_list).'</td><tr>' . '</table>';

        echo $str;

    }
    else
    {
        echo "data haven't found";
    }

?>