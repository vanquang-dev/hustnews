<?php
/**
 *  Product
 */
class Category extends Database
{
  protected $id_category;
  protected $name_category;

  public function id_category($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->id_category = $value;
  }

  public function name_category($value) {
    $value = mysqli_escape_string($this->get_connection(), $value);
    $this->name_category = $value;
  }



  public function add_category() {
    // query
    $query = "INSERT INTO `category` (
    `name_category`
    ) VALUES (
    '".$this->name_category."'
    )";
    return mysqli_query($this->get_connection(), $query);
  }

  public function check_id() {
    $query = "SELECT * FROM `category` WHERE `id_category` = '".$this->id_category."'";
    $query_statement = mysqli_query($this->get_connection(), $query);
    $row = mysqli_num_rows($query_statement);
    return $row;
  }

  public function check_name() {
    $query = "SELECT * FROM `category` WHERE `id_category` = '".$this->id_category."'";
    $query_statement = mysqli_query($this->get_connection(), $query);
    $row = mysqli_fetch_array($query_statement);
    return $row['name_category'];
  }


  public function get_full() {
    $query = "SELECT *, `post`.`created` AS `created_post` FROM `post` JOIN `admin` ON `post`.`admin_id` = `admin`.`admin_id` WHERE `category`='".$this->name_category."' ORDER BY `post_id` DESC LIMIT 0, 10";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  public function get_category() {
    $query = "SELECT * FROM `category`";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    return $query_attachment;
  }

  public function get_one()
  {
    $query = "SELECT * FROM `post` WHERE `category` = '".$this->id_category."' ORDER BY `post_id` DESC LIMIT 1";
    $query_attachment = mysqli_query($this->get_connection(), $query);
    $row = mysqli_fetch_array($query_attachment);
    return $row;
  }
}
?>