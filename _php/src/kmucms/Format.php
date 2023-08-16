<?php

namespace kmucms;

class Format {

  public static function getYouTubeEmbedLink($url) {
    $query = parse_url($url, PHP_URL_QUERY);
    parse_str($query, $output);
    if (isset($output['list'])) {
      return 'https://www.youtube-nocookie.com/embed/videoseries?list=' . $output['list'] . '&autoplay=1&rel=0';
    }
    if (isset($output['v'])) {
      return 'https://www.youtube-nocookie.com/embed/' . $output['v'] . '?autoplay=1&rel=0';
    }
    return $url;
  }

  public static function getYouTubeType($url) {
    $query = parse_url($url, PHP_URL_QUERY);
    parse_str($query, $output);
    if (isset($output['list'])) {
      return 'YouTube Wiedergabeliste';
    }
    return 'YouTube Video';
  }

  public static function trimexplode($del, $str) {
    $vars = explode($del, $str);
    $vars = array_map('trim', $vars);
    return array_filter($vars, fn($value) => !is_null($value) && $value !== '');
  }

  public static function getImage(string $url, int $width = 16, int $height = 9) {
    $img = '<img class="content-img" src="' . $url . '" />';
    if(empty($url)){
      $img = '<div class="content-img-container"> &nbsp; </div>';
    }
    return '<div class="content-img-div" style="padding-bottom:' . ($height / $width * 100) . '%">'.$img.'</div>';
  }
}
