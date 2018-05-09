<?php

    include_once("inc/dbFunctions.php");
    
if(!is_login()){
    header("Location:".SITE_URL);
}
    include_once("head.php");
    include_once("header.php");

    $current_user_id = current_user_id();

?>
<?php

if(isset($_POST['Upload_images']))
{
  $filenameArr = $_POST['filename'];
  $fileTitleArr = $_POST['fileTile'];
  $fileDescArr = $_POST['fileDesciption'];
  $image_statusArr = $_POST['image_status'];

  for($i = 0; $i < count($filenameArr); $i++){

   $file_name = $filenameArr[$i];
   $file_Title = $fileTitleArr[$i];
   $file_Desc = $fileDescArr[$i];
   $image_fetch_status = $image_statusArr[$i];

   if($image_fetch_status=='')
   {
    $image_status = 'Private';
   }
   else
   {
    $image_status = $image_fetch_status;
   }

   $user_id = $_SESSION['id'];

   $table='tbl_gallery';

    $users['user_id'] = $user_id;
    $users['title'] = $file_Title;
    $users['description'] = $file_Desc;
    $users['image'] = $file_name;
    $users['status'] = $image_status;

    $response = insert_data($table,$users);

    if($response)
    {
     ?>
     <script type="text/javascript">
       window.location.href="<?php echo SITE_URL; ?>/private-gallery.php";
     </script>
     <?php
    }

   }

}

?>
<section>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/js/lib/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/js/lib/jquery.form.js"></script>
    <div class="db pvtglry">

        <!--CENTER SECTION-->
        <div class="db-2 pvtglry2">

            <div class="db-2-com db-2-main">
                <h4>Upload Images</h4>
                <div class="db-2-main-com db-2-main-com-table">
                <form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="upload.php">
                <input type="hidden" name="feature_picture" id="feature_picture" value=""/>




                <div class="row">
                <label>Choose Image</label>
                <input type="file" name="images[]" id="images" multiple >
                <p>Maximum only 20 files can be uploaded at once </p>
                <div class="uploading none">
                        <label>&nbsp;</label>
                        <!--img src="uploading.gif" alt="uploading......"/-->
                        Uploading......
                </div>
                  <div class="db-mak-pay-bot">
                      <!--  <input type="submit" name="Upload_images" class="awe-btn btn-large" value="UPLOAD"> -->
                  </div>
                  </div>

                </form>

                <form id="image_preview" action='' method="post" style="display:none;">
                    <div id="images_preview"></div>

                </form>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include_once("footer.php");
?>
<!-- start of upload multiple images  -->
<script type="text/javascript">
$(document).ready(function(){
    $('#images').on('change',function(){
        $('#multiple_upload_form').ajaxForm({
            //display the uploaded images
            target:'#images_preview',
            beforeSubmit:function(data){
                $('.uploading').show();
                 $(".loader").show();
            },
            success:function(data){
                $('.uploading').hide();
                 $(".loader").hide();
                 $("#image_preview").show();
                $("#feature_picture").val(data['file_name']);
            },
            error:function(data){
            }
        }).submit();
    });



    //Delete Image

    $(document).on("click", '.crossbtn', function(event) {
        if(confirm('Are you sure you want to delete?')) {

              $(this).parent().parent().remove();

              var galvikphoto = $('.galvikphoto').length;
              if(galvikphoto==0){
                   $("#image_preview").hide();
              }
        }
    });
});
</script>

<!-- end of upload multiple images  -->
