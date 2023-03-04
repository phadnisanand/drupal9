<?php

namespace Drupal\fetch_demo\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Url;
/**
 * Defines FetchDemoController class.
 */
class FetchDemoController extends ControllerBase {


	public function getContent() {

		return [
		  '#theme' => 'fetch_demo',
		];
	}
	
	public function  displayContent() {
		 return new JsonResponse([ 'data' => $this->getData(), 'method' => 'GET', 'status'=> 200]);
	}
	
 
	public function getData() {
		$result=[];
		$query = \Drupal::entityQuery('node')
		  ->accessCheck(TRUE)
		  ->condition('type', 'article')
		  ->sort('created' , 'DESC'); 
		$nodes_ids = $query->execute();
		if ($nodes_ids) {
		  foreach ($nodes_ids as $node_id) {
			$node = \Drupal\node\Entity\Node::load($node_id);
			$result[] = [
			  "id" => $node->id(),
			  "title" => $node->getTitle(),
			];
		  }
		}
		return $result;
	  }
	  
	  public function postContent() {
		$json_string =\Drupal::request()->getContent();
		$decoded = \Drupal\Component\Serialization\Json::decode($json_string);
		$node = Node::create(['type' => 'article']);
		$node->langcode = "en";
		$node->uid =  $decoded['userId'];
		$node->promote = 0;
		$node->sticky = 0;
		$node->title= $decoded['title'];
		$node->body =  $decoded['body'];
		$node->save();
		$nid = $node->id(); // Get Nid from the node object.
		return new JsonResponse([ 'data' => $nid, 'method' => 'GET', 'status'=> 200]);
	  }
	  
	  public function deleteContent($id) {
		  $node = \Drupal::entityTypeManager()->getStorage('node')->load($id);
		   if ($node) {
			  $node->delete();
			}
		  return new JsonResponse([ 'data' =>$id, 'method' => 'GET', 'status'=> 200]);
	  }
}
