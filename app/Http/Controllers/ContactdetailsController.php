<?php namespace Schoolprof\Http\Controllers;

use Schoolprof\Http\Requests;
use Schoolprof\Http\Requests\FindContactdetailsRequest;

use Schoolprof\Http\Controllers\Controller;

use Schoolprof\Contactdetail;
use Schoolprof\Contact;

use Illuminate\Http\Request;

class ContactdetailsController extends Controller {
  protected $contact;
  protected $types = ['tel','mail'];
  protected $sync = [];
  //
  public function process($contact,$request)
  {
  	$this->contact = $contact;
    $details = array_key_exists('contactdetails',$request)?$request['contactdetails']:$request;
  	if($details && is_array($details) ){
  	  if(array_key_exists('new',$details)) $this->create($details['new']);
      if(array_key_exists('old',$details)) $this->update($details['old']);
  	}
    $contact->contactdetails()->sync($this->sync);
    return true;
  }

  public function processOne($contact,$request)
  {
    $id = $this->create($request,true);
    $contact->contactdetails()->sync($this->sync,false);
    return $id;
  }

  /**
   * Create or find a new contactdetail for the contact.
   * The layout should be: details[type][label][] = value
   * @param  [type] $details [description]
   * @return [type]          [description]
   */
  protected function create($details,$returnid = false)
  {
  	foreach($details as $type => $labelwithvalues ){
  	  foreach($labelwithvalues as $label => $values){
  	  	foreach($values as $value){
  	  	  //The format of the $details seems to be OK
    		  if( $this->isCorrectType($type) ){
            $detail = Contactdetail::firstOrCreate(compact('type','value'));  	
    		  	$this->sync[(int)$detail->id] = ['label' => $label];
            //If a return is asked, we only need to proces one detail.
            if($returnid) return $detail->id;
    		  }
  	  	}
  	  }
  	}
    // 1 is personal contact (not otherwise specified)
    // Safe to return...
    if($returnid) return 1;
  }

  protected function update($details)
  {
    unset($details[1]);
    foreach($details as $id => $value){
      $contactdetail = $this->contact->contactdetails->find($id);
      if($contactdetail && ($contactdetail->value <> $value) ){
        $contactdetail->value = $value;
        $contactdetail->save();       
      }
      $this->sync[(int)$id] = [];
    }
  }

  protected function isCorrectType($type)
  {
  	return in_array($type,$this->types,true);
  }


  public function getData(FindContactdetailsRequest $request)
  {
    $contact = Contact::findOrFail($request->input('id'));
    $contactdetails = $this->dataToList($contact->contactdetails);
    if(!empty($contactdetails))  
      $list[trans('contactdetails.contact')] = $contactdetails;
    $prive = $this->dataToList($contact->person->contactdetails);
    if(!empty($prive))
      $list[trans('contactdetails.personal')]= $prive;
    //Face2Face is default form of communication...
    $additional[] = ['id' => 1, 'label' => trans('contactdetails.f2f')];
    $list[trans('contactdetails.additional')] = $additional;
    return  json_encode($list);      
  }

  protected function dataToList($details)
  {
    $list = array();
    foreach($details as $detail){
      $label = '('.$detail->pivot->label.') '.$detail->value;
      $list[] = [
        'id' => $detail->id, 
        'label' => trans('contactdetails.'.$detail->type).' '.$label
        ];
    }
    return $list;
  }



}
