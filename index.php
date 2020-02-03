<?php
$invoice = [
    304,
    166,
    1273.56,
    177,
    660,
    496,
    1438,
    361,
    849.04,
    1824,
    266,
    110,
    1172,
    312,
    1316,
    788,
    78,
    78,
    20.4,
    1,
    90,
    9.6,
    2,
    1,
    4,
    1,
    12,
    12,
    1728,
    2265,
    1350,
    1328,
    92,
    2375,
    879,
    606,
    60,
    488,
    1640,
    660,
    1316,
    880,
    5,
    847,
    1086,
    1256,
    932,
    440,
    1372,
    1210,
    548,
    353,
    824,
    626,
    488,
    332,
    1488,
];
$recap = [
    110,
    14.6,
    3033,
    15744,
    1728,
    2122.6,
    3165,
    157,
    137.4,
    932,
    4177,
    5439,
    2265,
    266,
    5,
];
$debug="";
function ReverseSUM($value,$array){
    global $debug;
    ini_set('max_execution_time', 10);
    if (!function_exists('GenerateIteration')) {
        function GenerateIteration($number){
            global $debug;
            $iteration=array();
            $count = 0;
            while($count < $number){
                $count++;
                array_push($iteration,$count);
            }
            return $iteration;
        }
    }
    if (!function_exists('IncrementIteration')) {
        function IncrementIteration($iteration,$max){
            global $debug;
            $count=count($iteration);
            while($count > 0){
                if( $iteration[($count-1)] < $max ){
                    $iteration[($count-1)]++;
                    if($count != count($iteration)){
                        $count2=$count;
                        while($count2 <= count($iteration)){
                            if($count2 != count($iteration)){
                                if($debug){
                                    echo $iteration[$count2]."=".($iteration[($count2-1)]+1)."<br />";
                                    echo "Count: ".$count."<br />";
                                    echo "Count2: ".$count2."<br />";
                                    echo "Max: ".$max."<br />";
                                }
                                // if( ($iteration[$count2] < $max) ){
                                    $iteration[$count2]=($iteration[($count2-1)]+1);
                                    if($debug){ echo $iteration[$count2]."<br />"; }
                                // }
                            } else {
                                break;
                            }
                            $count2++;
                        }
                    }
                    break;
                }
                $max--;
                $count--;
            }
            return $iteration;
        }
    }
    if (!function_exists('SumIteration')) {
        function SumIteration($iteration,$array){
            global $debug;
            $result=array();
            foreach($iteration as $key){
                array_push($result,$array[$key]);
            }
            return array_sum($result);
        }
    }
    $count=count($array);
    $count=3;
    $values=array();
    while($count > 0){
        //Init of While Iteration
        $iteration=GenerateIteration($count);
        //We iterate
        if($debug){echo "<div>"."<div>Current Count: ".$count." | Number of Elements: ".count($iteration)." | Looking for SUM: ".$value." | SUM of Elements: ".SumIteration($iteration,$array)."</div>";}
        while(SumIteration($iteration,$array) != $value){
            if($iteration === IncrementIteration($iteration,(count($array)-1))){
                break;
            } else {
                $iteration=IncrementIteration($iteration,(count($array)-1));
                if($debug){
                    echo "<div>";
                    print_r($iteration);
                    echo "Incrementing To: ".SumIteration($iteration,$array);
                    echo "</div>";
                }
            }
            //End of While Iteration
        }
        //End of While Iteration
        if(SumIteration($iteration,$array) == $value){
            array_push($values,$iteration);
        }
        unset($iteration);
        if($debug){echo "</div>";};
        $count--;
    }
    return $values;
}
if($debug){
    echo "Sum of Invoice: ".array_sum($invoice)." and has ".count($invoice)." elements<br />";
    echo "Sum of Recap: ".array_sum($recap)." and has ".count($recap)." elements<br />";
    if(array_sum($invoice) == array_sum($recap)) { echo "both are equal<br />"; }
}
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Reverse SUM</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php">Reverse SUM</a>
        <div class="navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="https://github.com/LouisOuellet/ReverseSUM">GitHub</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
      <div class="container" style="padding:25px;">
        <h1 class="mt-5">Reverse SUM</h1>
        <p class="lead">This </p>
        <p>Back to <a href="/docs/4.4/examples/sticky-footer/">the default sticky footer</a> minus the navbar.</p>
        <?php foreach($recap as $line => $value){ ?>
          <?php if($line>0){?>
          <table border="1">
              <tr>
                  <th colspan="2" style="text-align:left;">Line <?=$line?> - <?=$value?></th>
              </tr>
              <tr>
                  <th>Iteration</th>
                  <th>Values</th>
              </tr>
              <?php foreach(ReverseSUM($value,$invoice) as $iteration => $values){?>
                  <tr>
                      <td><?=$iteration?></td>
                      <td>
                          <?php foreach($values as $array){?>
                              <?=($array +1)?><br />
                          <?php } ?>
                      </td>
                  </tr>
              <?php } ?>
          </table>
          <?php } ?>
        <?php } ?>
      </div>
    </main>

    <footer class="footer mt-auto py-3" style="padding:10px;background-color:#ccc;">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2019-2020 <a href="http://alb.laswitchtech.com">ALB Compagnie International</a>.</strong> All rights reserved.
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>