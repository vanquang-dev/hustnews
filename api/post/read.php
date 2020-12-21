<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; chartset="UTF-8"');

	// include object database and login
	// include_once '../config/database.php';
	// include_once '../config/time.php';
	// include_once '../config/utf8tourl.php';
	// include_once '../objects/post.php';
	
	// // dashboard login object
	// $post = new Post();
	// $data = [];

	// $query = $post->get_post();
	// $i = 0;
	// while ($row = mysqli_fetch_array($query)) {
	// 	$data['result'][$i]['id'] = $row['post_id'];
	// 	$data['result'][$i]['username'] = $row['username'];
	// 	$data['result'][$i]['avatar'] = $row['avatar'];
	// 	$data['result'][$i]['title'] = $row['title'];
	// 	$data['result'][$i]['description'] = $row['description'];
	// 	$data['result'][$i]['image'] = $row['image'];
	// 	$data['result'][$i]['created'] = time_stamp($row['created_post']);
	// 	$data['result'][$i]['link_post'] = utf8tourl($row['title'])."-".$row['post_id'].".html";
	// 	$i++;
	// }
	// // set reponse code - 200 OK
	// http_response_code(200);
	// // send data json 
	// echo json_encode($data);
?>

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

while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$row[0]; 
    $subdata[]=$row[2]; 
    $subdata[]='<div style="background: url('.$row[6].') center center / cover; width:100px; height:100px;"></div>';
    $subdata[]=$row[7]; 
    $subdata[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
                <button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</button>';
    $data[]=$subdata;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
?>