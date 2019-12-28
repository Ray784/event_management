<?php 
require "cloudinarysdk/src/Cloudinary.php";
require "cloudinarysdk/src/Uploader.php";
class CloudImages
{
    private $cloudName="event078"; //cloudinary cloud name 
    private $apiKey ="336287146547962"; //cloudinary api key
    private $apiSecret="SKbT0B0rG-hT1MdmelAKWoBefx0"; //cloudinary api secret
    private $baseUrl="http://res.cloudinary.com/event078"; //cloudinary base url 
     
    //default constructor
    function CloudImages()
    {
        \Cloudinary::config(array(
            "cloud_name" => $this->cloudName,
            "api_key" =>  $this->apiKey,
            "api_secret" => $this->apiSecret
        ));
    }
    /*
    @description: upload a file to cloudinary
    @params : url live link or image temp name e.g http://res-1.cloudinary.com/cloudinary/image/asset/dpr_2.0/logo-e0df892053afd966cc0bfe047ba93ca4.png
    or 
    $_FILES["file"]["tmp_name"]
    Both are you can use 
    */
    public function UploadToCloudFile($url) {
        try
        {
            global $files, $sample_paths, $default_upload_options, $eager_params;
             
            $files = \Cloudinary\Uploader::upload($url);
            return $this->Response(1,$files['public_id']);
        }catch(Exception $e) {
            return $this->Response(0,$e);
        }
    }
    /*
    @description: delete a file to cloudinary
    @params id //valid id of cloudinary image or video file 
    */
    public function DeleteCloudiNaryFile($id) {
        global $files, $sample_paths, $default_upload_options, $eager_params;
        try{
            $files = \Cloudinary\Uploader::destroy($id,array("invalidate" => TRUE));
            return $this->Response(1,$files);
        }catch(Exception $e) {
            return $this->Response(0,$e);
        }
    }
    /*
    @description: update a file to cloudinary
    @params oldimageid //valid id of cloudinary image or video file
    @params : url live link or image temp name e.g http://res-1.cloudinary.com/cloudinary/image/asset/dpr_2.0/logo-e0df892053afd966cc0bfe047ba93ca4.png
    or 
    $_FILES["file"]["tmp_name"]
    Both are you can use 
    */
    public function UpdateCloudiNaryFile($url ,$oldimageid){
        //$id $oldimageid;
        try
        {
            $this->DeleteCloudiNaryFile($oldimageid);
            $files =  \Cloudinary\Uploader::upload($url ,array("public_id" => $oldimageid , "invalidate" => TRUE) );
            return $this->Response(1,$files['public_id']);
        }catch(Exception $e) {
            return $this->Response(0,$e);
        }
    }
     
    private function Response($success,$result)
    {
        if($success==0){ $result=$result->getMessage(); } 
        return array("success"=>$success,"data"=>$result);
    }
}
 
?>