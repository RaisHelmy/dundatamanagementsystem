<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
  <body>

<?php 
    include "connect.php"; 
    include "header.php";
    $id=$_GET['updateid'];
    $result = mysqli_query($conn, "select name from uploaded_files where id=$id");
    $filename = mysqli_fetch_array($result);
    $filepath= 'uploads/'.$filename["name"];  
    //echo $filepath;
    if(!file_exists($filepath)){
      die('Error finding access database');
    }
    //$db = 'localhost/finalwp/'.$filename["name"];
    $db = realpath($filepath);
    //$db = pathinfo($filepath);['basename']
    $conn = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=".$db.";Uid=; Pwd=;");
    
$sql = "SELECT NamaDUN FROM DATA_SPR";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$NamaDUN = $row[0]["NamaDUN"]; // $NamaDUN;
$sql = "SELECT Count(*) FROM DATA_SPR";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$JumlahPengundi = $row[0]["Expr1000"]; //$JumlahPengundi
$sql = "SELECT Count(*) FROM (SELECT DISTINCT KodLokaliti FROM DATA_SPR)";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$JumlahLokaliti = $row[0]["Expr1000"]; //$JumlahLokaliti


$sql = "select NoSiri, Count(NamaPusatMengundi) as RecordCount from (select distinct NoSaluran as NoSiri, NamaPusatMengundi from DATA_SPR) GROUP BY NoSiri";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$dm = count($row); $dn=0;
for ($i=0;$i<$dm;$i++){
	$dn=$dn+$row[$i]["RecordCount"];
}
$JumlahSaluranMengundi = $dn;            //$JumlahSaluranMengundi
$sql = "SELECT Umur, DATEDIFF('yyyy', TarikhLahir, date()) AS Umur FROM DATA_SPR";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$do = count($row); 
$oa = $ob = $oc = $od = $oe = 0;
for($i=0;$i<$do;$i++){
	if($row[$i]["Umur"]<30){ $oa++; }
	else if($row[$i]["Umur"]>=30 && $row[$i]["Umur"]<=39){ $ob++; }
	else if($row[$i]["Umur"]>=40 && $row[$i]["Umur"]<=49){ $oc++; }
	else if($row[$i]["Umur"]>=50 && $row[$i]["Umur"]<=59){ $od++; }
	else { $oe++; }
}
$Umur29 = $oa;$Umur39 = $ob;$Umur49 = $oc;$Umur59 = $od;$Umur60plus = $oe; //$Umur29++
$sql = "SELECT NamaDM, COUNT(*) FROM DATA_SPR GROUP BY NamaDM";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$dm = count($row);
$JumlahDM = $dm;
?>
<div class="ui segment">
  <div class="ui two column very relaxed grid">
    <div class="column" style="padding-left: 80px;">
      <p><h1 class="ui header">Nama DUN: <?php echo $NamaDUN ?></h1></p>
      <p><h2 class="ui header">Maklumat DUN</h2></p>
      <p><h3 class="ui header">Jumlah Pengundi: <?php echo $JumlahPengundi?></h3></p>
      <p><h3 class="ui header">Jumlah Daerah Mengundi: <?php echo $JumlahDM?></h3></p>
      <p><h3 class="ui header">Jumlah Lokaliti: <?php echo $JumlahLokaliti?></h3></p>
      <p><h2 class="ui header">Maklumat Pengundi</h2></p>
      <p><h3 class="ui header">Jumlah Pusat Mengundi: <?php echo $JumlahDM = $dm;   $JumlahPusatMengundi?></h3></p>
      <p><h3 class="ui header">Jumlah Saluran Mengundi: <?php echo $JumlahSaluranMengundi?></h3></p>
      <p><h2 class="ui header">Maklumat Daerah Mengundi</h2></p>
      <table class="ui blue table">
        <thead>
          <tr><th>Nama Daerah Mengundi</th>
          <th>Jumlah Pengundi</th>
        </tr></thead><tbody>
  <?php 
  $sql = "SELECT NamaDM, COUNT(*) FROM DATA_SPR GROUP BY NamaDM";
  $result = $conn->query($sql);
  $row = $result->fetchAll(PDO::FETCH_ASSOC);
  $dm = count($row);
  $JumlahDM = $dm;                         //$JumlahDM
  for ($i=0;$i<$dm;$i++){                         //LoopJumlahPengundiDM
    $ArrJumlahPengundiDM[$i]["NamaDM"] = $row[$i]["NamaDM"];
    $ArrJumlahPengundiDM[$i]["JumlahPengundi"] = $row[$i]["Expr1001"]; 
  }
  for ($i=0;$i<$dm;$i++){                         //LoopJumlahPengundiDM
      echo  "<tr>
      <td>".$ArrJumlahPengundiDM[$i]["NamaDM"]."</td>
      <td>".$ArrJumlahPengundiDM[$i]["JumlahPengundi"]."</td>
      </tr>";
    }
  ?>
  </tbody>
</table>
      <p><h2 class="ui header">Taburan Pusat Mengundi</h2></p>
      <table class="ui blue table">
        <thead>
          <tr><th>Nama Daerah Mengundi</th>
          <th>Nama Pusat Mengundi</th>
          <th>Jumlah Pengundi</th>
        </tr></thead><tbody>
<?php 
$sql = "SELECT NamaDM, NamaPusatMengundi, COUNT(*) FROM DATA_SPR GROUP BY NamaDM, NamaPusatMengundi";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$dm = count($row);
$JumlahPusatMengundi = $dm;   //$JumlahPusatMengundi
for ($i=0;$i<$dm;$i++){                //LoopJumlahPengundiPusatMengundi
  echo  "<tr>
      <td>".$row[$i]["NamaDM"]."</td>
      <td>".$row[$i]["NamaPusatMengundi"]."</td>
      <td>".$row[$i]["Expr1002"]."</td>
      </tr>";
    }
  ?>
</tbody>
</table>
    </div>
    <div class="column">
      <canvas id="AgeChart"></canvas>
      <p><h2 class="ui header">Taburan Pengundi Lokaliti</h2></p>
      <table class="ui blue table">
        <thead>
          <tr><th>Nama Daerah Mengundi</th>
          <th>Nama Lokaliti</th>
          <th>Jumlah Pengundi</th>
        </tr></thead><tbody>

      <?php 
$sql = "SELECT NamaLokaliti, NamaDM, COUNT(*) FROM DATA_SPR GROUP BY NamaDM, NamaLokaliti";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
$dm = count($row);
for ($i=0;$i<$dm;$i++){
	echo "<tr>
  <td>".$row[$i]["NamaDM"]."</td>
  <td>".$row[$i]["NamaLokaliti"]."</td>
  <td>".$row[$i]["Expr1002"]."<br>";
}
   ?>
  </tbody>
</table>

    </div>
  </div>
  <div class="ui vertical divider">
    and
  </div>
</div>

<script>
  var NamaDUN = '<?=$NamaDUN?>';
  var Umur29 = '<?=$Umur29?>';var Umur39 = '<?=$Umur39?>';var Umur49 = '<?=$Umur49?>';
  var Umur59 = '<?=$Umur59?>';var Umur60plus = '<?=$Umur60plus?>';
  const labels = [
    '29',
    '39',
    '49',
    '59',
    '60++',
  ];
//$Umur29 = $oa;$Umur39 = $ob;$Umur49 = $oc;$Umur59 = $od;$Umur60plus = $oe; //$Umur29++'Age Distribution for DUN ' + 
  const data = {
    labels: labels,
    datasets: [{
      label: 'Age Distribution for DUN ' + NamaDUN,
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [Umur29, Umur39, Umur49, Umur59, Umur60plus],
    }]
  };
  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };
  const myChart = new Chart(
    document.getElementById('AgeChart'),
    config
  );
</script>
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script>
  </body>
</html>