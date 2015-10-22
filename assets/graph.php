<?
//library
require_once ('library/jpgraph.php');
require_once ('library/jpgraph_line.php');


// Setup the graph
    $graph = new Graph(500,400); //height,width of the canvas
    $graph->SetScale("textlin");

    $theme_class=new UniversalTheme;

    $graph->SetTheme($theme_class);
    $graph->img->SetAntiAliasing(false);
    $graph->title->Set('mark distribution'); //title of the page
    $graph->SetBox(false);

    $graph->img->SetAntiAliasing();

    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);

    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");
    $graph->xaxis->SetTickLabels($count);
    $graph->xgrid->SetColor('#E3E3E3');

    // Create the first line
    $p1 = new LinePlot($marks);
    $graph->Add($p1);
    $p1->SetColor("#6495ED");
    $p1->SetLegend('Line 1');


    $graph->legend->SetFrameWeight(1);

// Output line
    $graph->Stroke();

?>