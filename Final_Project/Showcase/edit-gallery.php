<?php

    include_once("inc/dbFunctions.php");

if(!is_login()){
  header("Location:".SITE_URL);
}

  $tbluser = "tbl_gallery";
  $imgid = $_GET['id'];
  $current_user_id = current_user_id();

  if(isset($_POST['profile-update']))
  {
    $tbluser = "tbl_gallery";
    $data['title'] =  $_POST['image_title'];
    $data['description'] =  $_POST['image_desc'];
    $data['image'] =  $_POST['gallery_image'];
    $data['status'] = $_POST['image_status'];

    $condition_update = " where id ='$imgid'";

    $response = update_data($tbluser,$data,$condition_update);
    if($response)
    {
      ?>
     <script>
      alert('updated successfully');
      window.location.href='<?php echo SITE_URL; ?>/private-gallery.php';
     </script>
      <?php
    }
  }


  $condition = "WHERE `id` = '$imgid'";
  $galleries = selectTableDataSingle($tbluser,$condition);

  $image_status = $galleries['status'];


  include_once("head.php");
  include_once("header.php");

?>

<section class="edit_profile">
    <div class="db">
      <!--LEFT SECTION-->
      <!-- <div class="db-l">
            <div class="db-l-1">

            </div>
            <div class="db-l-2">

            </div>
        </div> -->
      <!--CENTER SECTION-->
      <div class="db-2">
        <div class="db-2-com db-2-main">
          <h4>Edit Image</h4>
          <div class="db-2-main-com db2-form-pay db2-form-com">
             <?php if(isset($confirm)){?>
              <div id="result_message"><?php echo $confirm ;?></div>
            <?php } ?>
            <form id="update_edit_form" action="" method="post" enctype="multipart/form-data">
              <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>Title</label>

                                              <input type="text" name="image_title" value="<?php echo $galleries['title']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
              </div>
              <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>Description</label>
                                                <input type="text" name="image_desc" value="<?php echo $galleries['description']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
              </div>


                              <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>Image</label>
                            <div class="box">
                              <div id="edit_pic_pre"><img src="<?php echo gallery_pic_mediumsrc($galleries['image']);?>" width="230px" height="250px"></div>
                                <input type="hidden" name="gallery_image" id="gallery_image" value="<?php echo $galleries['image'];?>" />
                               <input type="file" name="image_upload_file" id="image_upload_file" class="inputfile inputfile-6" />
                                <label for="file-7"><span></span><strong>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose image</strong>
                               </label>
                                <span class="profile_pic_loader"></span>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                            </div>

                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="form-item form-group">
                               <div class="inputGroupContainer">
                                <div class="input-group">
                                  <label>Status</label>

                            <select name="image_status"/>
                             <option value="Public" <?php if ($image_status == 'Public') { echo 'selected="selected"';}?> selected="selected">Public</option>
                             <option value="Private" <?php if ($image_status == 'Private') { echo 'selected="selected"';}?>>Private</option>
                            </select>

                                  </div>
                                   </div>
                                    </div>
                                </div>
              </div>



                            <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <input type="submit" value="UPDATE" name="profile-update" class="awe-btn full-btn">
                                            </div>
                                        </div>
                                    </div>
                                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--RIGHT SECTION-->
      <div class="db-3">

      </div>
    </div>
  </section>




<?php include_once("footer.php");?>
<script>
$(function() {

  /**=========================  Image upload =================================*/

  $(document).on('change', '#image_upload_file', function(){



    var form_data = new FormData();

    form_data.append("file", document.getElementById('image_upload_file').files[0]);
       $.ajax({
      url:"image_upload.php",
      method:"POST",
      data: form_data,
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      beforeSend:function(){
        //$('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
       $(".loader").show();
      },
      success:function(data)
      {
       $(".loader").hide();

      if(data['status']){


        $("#edit_pic_pre").html('<img src="'+data['image_medium_src']+'"/>');
        $("#gallery_image").val(data['file_name']);

       }else{
        $("#edit_pic_pre").html(data['error']);
      }
      }
    });

    });
  /**========================= END  Profile Image upload =================================*/



});
</script>
