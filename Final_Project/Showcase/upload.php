<?php
include_once("inc/dbFunctions.php");
include('thumb_functions.php');
/*defined settings - start*/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
define('IMAGE_SMALL_DIR', DOCUMENT_ROOT.'/Showcase/uploads/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', DOCUMENT_ROOT.'/Showcase/uploads/medium/');
define('IMAGE_MEDIUM_SIZE', 250);
/*defined settings - end*/


    $images_arr = array();
	$image_type = array('jpg','png','jpeg','gif','bmp');
	
	$count = 0;
    foreach($_FILES['images']['name'] as $key=>$val){
        //upload and stored images
        $target_dir = IMAGE_MEDIUM_DIR;
        
        $file = pathinfo($_FILES['images']['name'][$key]);
        
        $file['filename'] = str_replace(' ',"",$file['filename']);
        $file['filename'] = str_replace('(',"_",$file['filename']);
        $file['filename'] = str_replace(')',"_",$file['filename']);
        
		if (in_array($file['extension'], $image_type)){
		
			$file_name_new = $file['filename'].time().'.'.$file['extension'];
			
			
			$target_file = $target_dir.$file_name_new;
			
			$file_name = $_FILES['images']['name'][$key];
			
			if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_file)){
				$images_arr[$file_name_new] = $target_file;
				$file_name_new = $file['filename'].time().'.'.$file['extension'];

			createDir(IMAGE_SMALL_DIR);
			createDir(IMAGE_MEDIUM_DIR);
			/*create directory with 777 permission if not exist - end*/
			$path[0] = $_FILES['images']['tmp_name'];
			$file = pathinfo($_FILES['images']['name']);
			$fileType = $file["extension"];
			$desiredExt='jpg';
			
			
			$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
			$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
			$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
			$image_medium_src = UPLOAD_MEDIUM_URL.'/'.$fileNameNew; 
			$image_small_src = UPLOAD_SMALL_URL.'/'.$fileNameNew; 
				
				if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {
				
				if (createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
					$output['status']=TRUE;
					$output['image_medium']= $path[1];
					$output['image_small']= $path[2];
					$output['file_name']= $fileNameNew;
				}
				}
			}
		}
		$count++;
    }
?>
      <div class="row photogalvik">

        	
<?php
if(!empty($images_arr)){ 
    foreach($images_arr as $name=>$image_src){
        //print_r($images_arr);
        ?>
  <div class="col-lg-4 col-md-4 col-sm-4 galvikphoto">
      <div class="galvi">
                <p class="crossbtn"><input title="Remove Image" class="newtab-control newtab-control-block" value="X" type="button"/></p>
        
                <ul>
                    <li><label>Title Name</label>
					<input type="text" name="fileTile[]" class="fileTile" value="" />
                    <input type="hidden" name="filename[]" id="filename" class="filename" value="<?php echo $name;?>" />
                    </li>
                    
                    <li id="descr"><label>Description</label>
					<input type="text" name="fileDesciption[]" class="fileDesciption" value="" />
					</li>
					 <li id="up_status">
					 <label>Status</label>
                        <select class="image_status" name="image_status[]" id="image_status">
                            <!--option value="">Select Status</option-->
                            
                            <option value="Private">Private</option>
							<option value="Public">Public</option>
                        </select>
                    </li>
                 </ul>
                 <ul>
                 	 <li>
                     	<img src="<?php echo SITE_URL; ?>/uploads/medium/<?php echo $name; ?>" width="150px" height="180px" alt="">
                     </li>
                 </ul> 
        </div>         
   </div> 

<?php }?>

<?php }else{
	
}
?>
              
        </div>
<?php if(!empty($images_arr)){ ?>
	<div class="upload_submit">
 <input id="submit" name="Upload_images" value="UPLOAD" type="submit" class="awe-btn btn-large" />
 </div>
<?php }?>