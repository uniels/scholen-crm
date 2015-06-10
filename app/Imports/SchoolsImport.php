<?php namespace Schoolprof\Imports;

use Schoolprof\Http\Requests\XlsUploadRequest;
use Schoolprof\School;

/**
 * Creates an importer for the cfi-school-excelsheet.
 */
class SchoolsImport extends \Maatwebsite\Excel\Files\ExcelFile {

    /**
     * This is the layout compared to the SchoolModel:
     * "header in file" => "field in database"
     * Value null means 'no corresponding field in database'
     * @var array
     */
    protected $mapping = array();
    protected $schoolmapping = array(
          "provincie"               => 'provence',
          "bevoegd_gezag_nummer"    => 'parent_brin',
          "brin_nummer"             => 'brin',
          "vestigingsnummer"        => 'brin_es',
          "vestigingsnaam"           => 'name',
          "straatnaam"              => 'street',
          "huisnummer_toevoeging"   => 'number',
          "postcode"                => 'pc',
          "plaatsnaam"              => 'place',
          "gemeentenummer"          => null,
           "gemeentenaam"           => 'municipal',
           "denominatie"            => 'denomination',
           "telefoonnummer"         => 'tel',
           "internetadres"          => 'www',
           "straatnaam_correspondentieadres"    => 'cor_street',
           "huisnummer_toevoeging_correspondentieadres" =>  'cor_number',
           "postcode_correspondentieadres"  => 'cor_pc',
           "plaatsnaam_correspondentieadres"    => 'cor_place',
           "nodaal_gebied_code"     => null, #'nodal_id',
           "nodaal_gebied_naam"     => null,
           "rpa_gebied_code"        => null, #'rpa_id',
           "rpa_gebied_naam"        => null,
           "wgr_gebied_code"        => null, #'wgr_id',
           "wgr_gebied_naam"        => null,
           "coropgebied_code"       => null, #'corop_id',
           "coropgebied_naam"       => null,
           "onderwijsgebied_code"   => null, #'education_id',
           "onderwijsgebied_naam"   => null,
           "rmc_regio_code"         => null, #'rmc_id',
           "rmc_regio_naam"         => null,
        );
    protected $schoolboardmapping = array(
        "administratiekantoornummer"  => "parent_brin",
        "bevoegd_gezag_nummer"        => "brin",
        "bevoegd_gezag_naam"          => "name",
        "straatnaam"                  => "street",
        "huisnummer_toevoeging"       => "number",
        "postcode"                    => "pc",
        "plaatsnaam"                  => "place",
        "gemeentenummer"              => null,
        "gemeentenaam"                => "municipal",
        "denominatie"                 => "denomination",
        "telefoonnummer"              => "tel",
        "internetadres"               => "www",
        "straatnaam_correspondentieadres" => "cor_street",
        "huisnummer_toevoeging_correspondentieadres" => "cor_number",
        "postcode_correspondentieadres" => "cor_pc",
        "plaatsnaam_correspondentieadres" => "cor_place",
      );
    //
    protected $correctmappingavailable = false;
    protected $success = false;
    protected $correctmime = false;//

    protected $message; //Place for errormessage;
    //Counters:
    protected $total    = 0;
    protected $new      = 0;
    protected $updated  = 0;


    public function getFile()
    {
        
        $file = \Input::file('xls_file');
        //Please add a vulnerability check over here... (e.g. is this an xls file?)
        $this->checkMime($file->getMimeType());
        $path = $file->getRealPath();
        return $path;
    }

    protected function checkMime($mime)
    {
      if($mime == "application/vnd.ms-office"){
        $this->correctmime = true;
      } else {
        $this->message = \Lang::get('importschools.nocorrectmime');
      }
    }

    public function getFilters()
    {
        return [
        'chunk'
        ];
    }

    /**
     * Imports every school from the cfi-file!
     * @return boolean Result of this import.
     */
    public function import()
    {
        if($this->correctmime){
          foreach($this->toArray() as $filedata){
              if( $this->correctmappingavailable OR $this->determinecorrectmapping($filedata) ){
                $modeldata = $this->createmodeldata($filedata);
                $this->feedmodel($modeldata);
              } else {
                $this->message = \Lang::get('importschools.nocorrectmapping');
                return false;             
              }
          }
          return $this->setsuccess();
        }
        return false;
    }

    protected function determinecorrectmapping($filedata)
    {
        $fileheaders    = \array_keys( $filedata );     

        $this->checkandsetmapping($fileheaders,[
          $this->schoolmapping,
          $this->schoolboardmapping,
          ]);
        return $this->correctmappingavailable;
    }

    protected function checkandsetmapping($fileheaders,array $availablemappings)
    {
      foreach($availablemappings as $currentmapping){
        $currentheaders = \array_keys($currentmapping);
        if( $this->identicalheaders($fileheaders,$currentheaders))
        {
          $this->setcorrectmapping($currentmapping);
          return true;
        }
      }
      return false;
    }

    protected function identicalheaders($fileheaders,$acceptedheaders)
    {
      $difference     = \array_diff( $acceptedheaders,$fileheaders );
      return empty($difference);
    }

    protected function setcorrectmapping($data)
    {
      $this->mapping = $data;
      $this->correctmappingavailable = true;
    }

    protected function createmodeldata($filedata)
    {
      $modeldata = array();
      foreach($filedata as $key => $value){
          $field = $this->mapping[$key];
          if( $field ){
              $modeldata[$field] = $value;
          }
      }
      //Special for schoolboards, where brin = brin_es (original brin_es not available in source)
      if(!(array_key_exists('brin_es',$modeldata))){
        $modeldata['brin_es'] = $modeldata['brin'];
      }
      return $modeldata;
    }

    protected function feedmodel($modeldata)
    {
        $school = School::where('brin_es','=',$modeldata['brin_es'])->first();
        if( $school ){
          //School is found in the database
          $school->update($modeldata);
          $this->updated++;
        } else {
          //No record of this school yet
          School::create($modeldata);
          $this->new++;
        }
        $this->total++;
    }
    protected function setsuccess()
    {     
        $this->message = \Lang::get('importschools.message',[
            'total'   => $this->total,
            'new'     => $this->new,
            'updated' => $this->updated
          ]);
        $this->success = true;
        return $this->success;
    }


    public function report(){
        return $this->message;
    }




}