<?php
/**
 * Returns HTML for a recent node to be displayed in the recent content block.
 *
 * @param $variables
 *   An associative array containing:
 *   - node: A node object.
 *
 * @ingroup themeable
 */
function MyTheme_node_recent_content($variables) {
  $node = $variables['node'];

  $output = '<div class="node-title">';
  $output .= l($node->title, 'node/' . $node->nid);
  $output .= theme('mark', array('type' => node_mark($node->nid, $node->changed)));
  $output .= '</div><div class="node-author">';
  $output .= theme('username', array('account' => user_load($node->uid)));
  $output .= '</div>';
  $output .= '<div class= "node-created">';
  $output .= format_date($node->created);
  $output .= '</div>';

  return $output;
}
function MyTheme_mark($variables) {
  $type = $variables['type'];
  global $user;
  if ($user->uid) {
    if ($type == MARK_NEW) {
      return ' <span class="marker">**</span>';
    }
    elseif ($type == MARK_UPDATED) {
      return ' <span class="marker">*</span>';
    }
  }
}

function MyTheme_preprocess_username(&$variables){
  if(!empty($variables['account']->mail)){
    $variables['extra'] .= '(' . $variables['account']->mail . ')';
  }
}

function MyTheme_process_username(&$variables){
    $variables['extra'] .= str_replace('@', '@NOSPAM.', $variables['extra']);
}

function MyTheme_preprocess_html(&$variables){
  if($GLOBALS['user']->uid ==1){
    //Adds css dynamically, one parameter - the page
    //to the css file. 
    //drupal_get_path gets the path - two parameters,
    //theme or module, name of theme.
    drupal_add_css(drupal_get_path('theme','MyTheme').'/css/superadmin.css');
  }
}

function MyTheme_form_alter(&$form, &$form_state, $form_id){
  if(!empty($form['#node_edit_form'])){
    dpm($form);
  }
}

function MyTheme_theme($existing, $type, $theme, $path){
  return array(
      'nody_form' => array(
          'render element' => 'form',
          'template' => 'node-form',
          'path' => drupal_get_path('theme', 'MyTheme') . '/templates',
        ),
    );
}

function MyTheme_preprocess_node_form(&$variables){
  $variables['full_form'] = drupal_render_children($variables['form']); 
}
?>
