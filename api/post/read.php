<?php

$con=mysqli_connect('localhost','root','','bknews')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col =array(
    0   =>  'post_id',
    1   =>  'title',
    2   =>  'image',
    3   =>  'created'
);  //create column like table in database

$sql ="SELECT * FROM post";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM post WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND post_id Like '".$request['search']['value']."%' ";
    $sql.=" OR title Like '".$request['search']['value']."%' ";
    $sql.=" OR created Like '".$request['search']['value']."%' ";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($con,$sql);

$data=array();
$i = 1;
while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$i; 
    $subdata[]=$row[2]; 
    $subdata[]='<div style="background: url('.$row[6].') center center / cover; width:100px; height:100px;"></div>';
    $subdata[]=$row[7]; 
    $subdata[]='<br><a id="getEdit" class="btn btn-primary" href="update.php?id='.$row[0].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Sửa</a><button type="button" onclick = "destroy('.$row[0].')" class="btn btn-danger" style="margin-top:5px;"><i class="glyphicon glyphicon-trash">&nbsp;</i>Xóa</button>';
    $data[]=$subdata;
    $i++;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
?>
