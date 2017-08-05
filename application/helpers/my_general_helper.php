<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function my_validate_password($plain, $encrypted) {
  if ($plain && $encrypted) {
    // split apart the hash / salt
    $stack = explode(':', $encrypted);

    if (sizeof($stack) != 2)
      return false;

    if (hash_hmac("sha256", utf8_encode($plain), utf8_encode($stack[1]), false) == $stack[0]) {
      return true;
    }
  }

  return false;
}

function my_encrypt_password($plain) {
  $salt = substr(md5(random_string('alnum', 10)), 0, 4);

  $password = hash_hmac("sha256", utf8_encode($plain), utf8_encode($salt), false);
  //md5($salt . $plain) . ':' . $salt;

  return $password . ":" . $salt;
}

/**
 * 
 * @param type $lat_itude
 * @param type $long_itude
 * @param type $width
 * @param type $height
 * @param type $zoom
 * @param type $type : roodmap, terrain, satellite, hybrid
 * @return type
 */
function my_get_google_map_image($lat_itude, $long_itude, $width = 450, $height = 300, $zoom = 15, $type = 'roadmap') {
  //$image = "https://maps.googleapis.com/maps/api/staticmap?center={$lat_itude},{$long_itude}&zoom={$zoom}&maptype={$type}&size={$width}x{$height}";
  $image = "https://maps.googleapis.com/maps/api/staticmap?center={$lat_itude},{$long_itude}&zoom={$zoom}&scale=false&size={$width}x{$height}&maptype={$type}&format=jpg&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7C{$lat_itude},{$long_itude}";

  return $image;
}

function my_get_bing_map_image($lat_itude, $long_itude, $width = 600, $height = 400, $zoom = 17) {
  if ($lat_itude && $long_itude) {
    $image = "https://dev.virtualearth.net/REST/v1/Imagery/Map/Aerial/{$lat_itude},{$long_itude}/{$zoom}?mapSize={$width},{$height}&key=Au7rlsDVn0-CG7wNZOyP72-Ka-XfbNT1UqVHArNnPj1KSh9CFvvO8TNv_vgi6M1r";
    return $image;
  } else {
    return "";
  }
}

function my_address_display($address, $is_full = true, $isHtml = true) {
  $str = "";
  if ($address->street_number) {
    $str .= $address->street_number . " ";
  }
  $str .= $address->address;

  if ($is_full) {
    if ($isHtml) {
      $str .= ",<br>";
    } else {
      $str .= ", ";
    }
    $str .= $address->city . ", " . $address->state . " " . $address->zipcode;
  }

  return $str;
}

function my_find_images_by_address($address) {
  //$address = strtolower(my_address_display($address, false));

  $images = array();
  $file_list = scandir(FCPATH . PICS_UPLOAD_DIRECTORY);
  foreach ($file_list as $file) {
    if ($file != '.' && $file != '..') {
      if (!is_dir(FCPATH . PICS_UPLOAD_DIRECTORY . $file)) {
        $_file = strtolower($file);
        if (strpos($_file, strtolower($address->street_number)) !== false && strpos($_file, strtolower($address->address)) !== false && strpos($_file, strtolower($address->zipcode)) !== false) {
          $images[] = $file;
        }
      }
    }
  }

  return $images;
}

function my_get_images_from_folder($page = 0, $limit_count = 20) {
  $start_index = ($page - 1) * $limit_count;
  $end_index = $start_index + $limit_count;
  $images = array();

  $file_list = scandir(FCPATH . PICS_UPLOAD_DIRECTORY);
  $fileindex = 0;
  foreach ($file_list as $file) {
    if ($file != '.' && $file != '..') {
      if (!is_dir(FCPATH . PICS_UPLOAD_DIRECTORY . $file)) {
        if ($fileindex >= $start_index) {
          $images[] = $file;
        }
        $fileindex ++;
        if ($fileindex == $end_index) {
          break;
        }
      }
    }
  }
  return $images;
}

function my_get_address_image($address, $width = 450, $height = 300, $zoom = 15) {
  $CI = &get_instance();
  $CI->load->model("image_m");

  $CI->image_m->get_feature_image_by_address($address->id);
  if ($CI->image_m->is_exists()) {
    return base_url(PICS_UPLOAD_DIRECTORY . $CI->image_m->image);
  } else {
    return my_get_addres_google_map_image($address);
  }
}

function my_get_addres_google_map_image($address, $width = 450, $height = 300, $zoom = 15) {
  return base_url("picsnow/google_map_image?lat=" . $address->itude_lat . "&long=" . $address->itude_long . "&w={$width}&h={$height}&zoom={$zoom}");
}

function my_get_address_link($address) {
  $link = "";
  if ($address->street_number) {
    $link .= $address->street_number . "-";
  }
  $link .= str_replace(" ", "-", $address->address);
  $link .= $address->city . "-" . $address->state . "-" . $address->zipcode;
  $link .= "_" . $address->id;

  return base_url("picture/" . $link);
}

function my_resize_image($img_src_file, $set_w, $set_h, $mode = "s") {
  list ( $src_w, $src_h, $src_t, $src_a ) = getimagesize($img_src_file);
  $set_tangent = $set_h / $set_w;
  $src_tangent = $src_h / $src_w;
  $img_dst = @imagecreatetruecolor($set_w, $set_h);
  $white = @imagecolorallocate($img_dst, 255, 255, 255);
  @imagefilltoborder($img_dst, 0, 0, $white, $white);
  if ($src_t == "1") {
    $img_src = @imagecreatefromgif($img_src_file);
  } else if ($src_t == "2") {
    $img_src = @imagecreatefromjpeg($img_src_file);
  } else if ($src_t == "3") {
    $img_src = @imagecreatefrompng($img_src_file);
  }
  if ($mode == "c") {
    $cut_x = ($src_tangent > $set_tangent) ? 0 : ($src_w - ($src_h / $set_tangent)) / 2;
    $cut_y = ($src_tangent > $set_tangent) ? ($src_h - ($src_w * $set_tangent)) / 2 : 0;
    @imagecopyresized($img_dst, $img_src, 0, 0, $cut_x, $cut_y, $set_w, $set_h, $src_w - $cut_x * 2, $src_h - $cut_y * 2);
  } else if ($mode == "s") {
    $span_x = ($src_tangent > $set_tangent) ? $set_h / $src_tangent : $set_w;
    $span_y = ($src_tangent > $set_tangent) ? $set_h : $set_w * $src_tangent;
    $padding_x = (int) (( $set_w - $span_x ) / 2);
    $padding_y = (int) (( $set_h - $span_y ) / 2);
    @imagecopyresized($img_dst, $img_src, $padding_x, $padding_y, 0, 0, $span_x, $span_y, $src_w, $src_h);
  }

  // Content type
  header('Content-Type: ' . $src_a);
  if ($src_t == "1") {
    imagegif($img_dst);
  } else if ($src_t == "2") {
    imagejpeg($img_dst);
  } else if ($src_t == "3") {
    imagepng($img_dst);
  }
}

function my_ucfirst($str) {
  return ucfirst(strtolower($str));
}

function my_get_file_datetime($file) {
  $exif_data = exif_read_data($file);
  if (isset($exif_data['DateTimeOriginal']) && !empty($exif_data['DateTimeOriginal'])) {
    return $exif_data['DateTimeOriginal'];
  } elseif (isset($exif_data['FileDateTime']) && !empty($exif_data['FileDateTime'])) {
    return date("Y:m:d H:i:s", $exif_data['FileDateTime']);
  }
  return false;
}
