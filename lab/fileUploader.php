<?php
   class FileUploader{
       private static $target_directory = "uploads/";
       private static $size_limit = 50000;
       private $uploadOk = false;
       private $file_original_name;
       private $file_type;
       private $file_size;
       private $final_file_name;

       public function setOriginalName($name)
       {
           $this->file_original_name = $name;
       }
       public function getOriginalName()
       {
           return $this->file_original_name;
       }
       public function setFiletype($type)
       {
           $this->file_type = $type;
       }
       public function getFileType()
       {
           return $this->file_type;
       }
       public function setFileSize($size)
       {
           $this->file_size = $size;
       }
       public function getFileSize()
       {
           return $this->file_size; 
       }
       public function setFinalFileName($final_name)
       {
           $this->final_file_name = $final_name;
       }
       public function getFinalFileName()
       {
           return $this->final_file_name;
       }

       public function uploadFile()
       {
         $this->fileAlreadyExists();
       }
       public function fileAlreadyExists(){
        $uploaderObj=new FileUploader;    
        $name=$_FILES["fileToUpload"]["name"];
        $uploaderObj->setOriginalName($name);
        $target_file=self::$target_directory. basename($name);
        if (file_exists($target_file)) {
            echo "The file already exists!!";
        }else{
            $this->fileTypeIsCorrect();
        }

       }
       public function saveFilePathTo(){
           $name=$_FILES["fileToUpload"]["name"];
           $file_path=self::$target_directory.$name;
       }
       public function moveFile(){
           $name=$_FILES["fileToUpload"]["name"];
           $target_file=self::$target_directory.basename($name);
           if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)) {
               echo "The file". basename($_FILES["fileToUpload"]["name"]). " has been uploaded!!!";
           }
       }

       public function fileTypeIsCorrect(){
        $uploaderObj=new FileUploader;
        $name=$_FILES["fileToUpload"]["name"];
        $target_file=self::$target_directory.basename($name);
        $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if ($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="jpeg") {
            echo $uploaderObj->uploadOk;
        }

        $verify=getimagesize(($_FILES["fileToUpload"]["tmp_name"]));
        if ($verify!==false) {
            echo "The file is an image!!!-".$verify["mime"]."-" ;
            $uploaderObj->uploadOk=true;
            $this->fileSizeIsCorrect();
        }else{
            echo "Ooops!!The file is not an image!!";
             $uploaderObj->uploadOk=false;
        }
        
       }

       public function fileSizeIsCorrect(){
        $uploaderObj=new FileUploader;
        $size=$_FILES["fileToUpload"]["size"];
        $uploaderObj->setFileSize($size);
        if ($size>self::$size_limit) {
            echo "Ooopsy!!File too large";
            return $uploaderObj->uploadOk;
        } else {
            echo "--File size ok--";
            $uploaderObj->uploadOk=true;
            $this->moveFile();
        }
        
       }

       public function fileWasSelected(){

       }

   }
?>