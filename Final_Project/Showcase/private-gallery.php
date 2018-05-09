<?php

 include_once("inc/dbFunctions.php");
  
if(!is_login()){
    header("Location:".SITE_URL);
}
    include_once("head.php");
    include_once("header.php");

$user_id = $_SESSION['id'];

$limit = 12;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;


$limits = 'LIMIT '.$start_from.', '.$limit;
$table ='tbl_gallery';
$condition = " where user_id=$user_id ORDER BY id DESC";
$galleries = selectTableRowsLimit($table,$condition,$cols="*",$limits);
$total_num_rows = totalNumRows($table,$condition,$cols="*");
?>

<style>

.gallery-images { margin:30px auto;}
.gallery-images img { height:150px; float:left; margin:10px; border:3px solid #fff; border-radius:5px;}
#gallerybox{
        z-index:99999;
    }
 .demo
    {
    height: auto !important;
    max-height: 265px !important;
    min-height: 264px !important;
    max-width: 265px !important;
    width: 264px !important;
    }
</style>


<section class="gallery-images private-gallery">
    <div class="container imgse">
        <div class="jquery-script-ads">
        <?php
		if(!empty($galleries )){
          foreach($galleries as $page)
          {
            $imagefile = $page['image'];
            $imagename = $page['title'];
            $imageid = $page['id'];

			 $userID    = $page['user_id'];
			$image_owner = get_user_by_id($userID);

			$fname =   isset($image_owner['first_name']) ? $image_owner['first_name'] : "";
			$lname = isset($image_owner['last_name']) ? $image_owner['last_name'] : "";
        ?>


        <div class="image_outer">
			<div class="vikct fetch_image">
				<img alt="Uploaded by : &nbsp;<?php echo $fname.' '.$lname;?>" src="<?php echo gallery_pic_mediumsrc($imagefile); ?>" class="demo" style="cursor: pointer;">
				<p><?php echo $imagename; ?></p>
			 </div>
			 <!--<div class="img_details"><p><?php //echo $imagename; ?></p></div>-->
			 <div class="btn-group editimg" role="group">
				<a href="javascript:void(0);" class="btn btn-sucess delete-img" data="<?php echo $imageid; ?>">&times;</a>
				<a href="edit-gallery.php?id=<?php echo $page['id'];?>&action=edit-gallery"><i class="fa fa-edit"></i></a>
			</div>
		</div>
        <?php } ?>
        <?php }else{ ?>
				<p class="no_result">No Records</p>
		<?php } ?>


        </div>
    </div>

	<div class="container">
		<?php

			 $total_records = $total_num_rows;
			$total_pages = ceil($total_records / $limit);
			$pagLink = "<div class='pagination'>";

			if(isset($_GET["page"])) {
				$currentPage  = $_GET["page"];
			}else {
				$currentPage=1;
			};
			for ($i=1; $i<=$total_pages; $i++) {
				if($currentPage == $i){
					$current_sel = 'active';
				}else{
					$current_sel = '';
				}
				$pagLink .= "<a class='".$current_sel."' href='private-gallery.php?page=".$i."'>".$i."</a>";
			};
			echo $pagLink . "</div>";
			?>
	</div>
</section>


<script type="text/javascript">
    $('.demo').gallerybox();

</script>

<script type="text/javascript">
  $(document).ready(function(){
  $('.delete-img').click(function(){

    if(confirm("Are you sure!")){
     var imageid =  jQuery(this).attr('data');

     jQuery.ajax({
     url: 'inc/ajax_db_functions.php',
     type: 'POST',
     dataType: "json",
     data: {'imageid': imageid, 'action':'delete_image'},
       success: function(msg) {
           if(msg['confirm']==1){
              alert('Deleted Successfully');
              window.location.href='<?php echo SITE_URL; ?>/private-gallery.php'
                }
           else if(msg['confirm']==0)
           {
            alert('Something went wrong plaese try again later')
           }
          }
        });
    }

  });
});
</script>



<?php
    include_once("footer.php");
?>
