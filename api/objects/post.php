<?php
/**
 *  Product
 */
class Post extends Database
{
  protected $image;
  protected $title;
  protected $description;
  protected $detail_description;
  protected $admin_id;
  protected $category;
  protected $post_id;

  public function image($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->image = $value;
  }

  public function title($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->title = $value;

  }

  public function description($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->description = $value;
    return $value;
  }

  public function detail_description($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->detail_description = $value;
  }

  public function admin_id($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->admin_id = $value;
  }

  public function category($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->category = $value;
  }

  public function created($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->created = $value;
  }

  public function post_id($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->post_id = $value;
  }

  public function id_category($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->id_category = $value;
  }


  public function add() {
    // query
    $query = "INSERT INTO `post` (
    `admin_id`, `title`, `description`, `category`, `detail_description`, `image`
    ) VALUES (
    '".$this->admin_id."',
    '".$this->title."',
    '".$this->description."',
    '".$this->category."',
    '".$this->detail_description."',
    '".$this->image."'
    )";
    return mysqli_query($this->get_connection(), $query);
  }

  public function add_post() {
    // query
    $query = "INSERT INTO `post` (
    `admin_id`, `title`, `description`, `category`, `detail_description`, `image`
    ) VALUES (
    '".$this->admin_id."',
    '".$this->title."',
    '".$this->description."',
    'xã hội',
    '".$this->detail_description."',
    '".$this->image."'
    )";
    return mysqli_query($this->get_connection(), $query);
  }

  public function add_category() {
    // query
    $query = "INSERT INTO `category` (
    `name_category`
    ) VALUES (
    '".$this->category."'
    )";
    return mysqli_query($this->get_connection(), $query);
  }

  public function get_id_product() {
    // query
    $query = "SELECT `id` FROM `product` WHERE `date` = '".$this->date."' AND `name_product` = '".$this->name_product."' AND `id_user` = '".$this->id_user."'";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    $row = mysqli_fetch_array($query_attachment);
    return $row['id'];
  }

  // get post first
  public function get_post_new()
  {
    $query = "SELECT * FROM `post` ORDER BY `post_id` DESC LIMIT 3";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  public function get_post_datatable()
  {
    $query = "SELECT * FROM `post`";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  public function get_post()
  {
    $query = "SELECT *, `post`.`created` AS `created_post` FROM `post` JOIN `admin` ON `post`.`admin_id` = `admin`.`admin_id` ORDER BY `post_id` DESC LIMIT 0, 20";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  public function get_post1()
  {
    $query = "SELECT *, `post`.`created` AS `created_post` FROM `post` JOIN `admin` ON `post`.`admin_id` = `admin`.`admin_id` ORDER BY `post_id` DESC LIMIT 3, 10";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  // get detail post
  public function get_post_detail()
  {
    $query = "SELECT *, `post`.`created` AS `created_post` FROM `post` JOIN `admin` ON `post`.`admin_id` = `admin`.`admin_id` WHERE `post_id` = ".$this->post_id;
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return mysqli_fetch_array($query_attachment);
  }


  // get detail post
  public function get_post_popular()
  {
    $query = "SELECT `like`.`post_id`, `title`, COUNT(*) AS `total` FROM `like` JOIN `post` ON `like`.`post_id` = `post`.`post_id` GROUP BY `like`.`post_id` ORDER BY `total` DESC LIMIT 10";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  public function check_category() {
    $query = "SELECT * FROM `category` WHERE `name_category` = '".$this->category."'";
    $query_statement = mysqli_query($this->get_connection(), $query);
    $row = mysqli_num_rows($query_statement);
    return $row;
  }

  public function get_post_docs() {
    $query = "SELECT *, `post`.`created` AS `created_post` FROM `post` JOIN `admin` ON `post`.`admin_id` = `admin`.`admin_id` WHERE `category`='".$this->category."' ORDER BY `post_id` DESC LIMIT 0, 3";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  public function get_update() {
    $query = "SELECT * FROM `post` WHERE `post_id`= ".$this->post_id;
    $query_attachment = mysqli_query($this->get_connection(), $query);
    $row = mysqli_fetch_array($query_attachment);
    return $row;
  }

  public function update() {
    $query = "UPDATE `post` SET `title` = '".$this->title."', `description` = '".$this->description."', `detail_description` = '".$this->detail_description."' WHERE `post_id`= ".$this->post_id;
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }
  // delete post
  function destroy() {
    // query
    $query = "DELETE FROM `post` WHERE `post_id` = ".$this->post_id;
    return mysqli_query($this->get_connection(), $query);
  }
}
?>