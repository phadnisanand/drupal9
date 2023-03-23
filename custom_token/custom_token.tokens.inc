<?php
use Drupal\Core\Render\BubbleableMetadata;

/*
* implement hook_token_info()
*/
function custom_token_token_info(){
  $types['custom_token_type'] = array(
    'name' => t('Custom token type'),
    'description' => t('Define custom token type')
  );	
  $tokens['custom_token_name'] = array(
    'name' => t('Custom token name'),
    'description' => t('Define custom token name')
  );

  $tokens['absolute_url'] = array(
    'name' => t('Absolute URL'),
    'description' => t('Url of the site, no language prefix garanted'),
  );
	
  return array(
    'types' => $types,
    'tokens' => array(
      'custom_token_type' => $tokens
    )
  );	
}

/*
* implement hook_token()
*/
function custom_token_tokens($type, $tokens, array $data, array $options, BubbleableMetadata $bubbleable_metadata){
  $replacements = array();
  global $base_root;
  if($type == 'custom_token_type') {
    foreach ($tokens as $name => $original) {
      switch ($name) {
        case 'custom_token_name':
        $text = 'Anand Phadnis!';
	      $replacements[$original] = $text;
	      break;
        case 'absolute_url':
        $replacements[$original] = $base_root;
        break;
      }
    }
  }
  return $replacements;
}
?>