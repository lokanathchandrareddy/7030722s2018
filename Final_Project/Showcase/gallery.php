<?php

 include_once("inc/dbFunctions.php");

if(!is_login()){
    header("Location:".SITE_URL);
}
    include_once("head.php");
    include_once("header.php");


$limit = 12;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;


$limits = 'LIMIT '.$start_from.', '.$limit;
$table ='tbl_gallery';
$condition = " where status='Public' ORDER BY id DESC";
$galleries = selectTableRowsLimit($table,$condition,$cols="*", $limits );
$total_num_rows = totalNumRows($table,$condition,$cols="*");
?>

<style>
.gallery-images { margin:30px auto;}
.gallery-images img { height:150px; float:left; margin:10px; border:3px solid #fff; border-radius:5px;max-height: 264px !important;
    min-height: 264px !important;}
#gallerybox{
        z-index:99999;
    }

 .demo
    {
    height: auto !important;
    max-height: 300px !important;
    min-height: 264px !important;
    max-width: 265px !important;
    width: 264px !important;
    }
</style>


<section class="gallery-images gal-imgv">
    <div class="container imgse imgv">
        <div class="row jquery-script-ads galimv">
        <?php
        if(!empty($galleries )){
          foreach($galleries as $page)
          {
            $imagefile = $page['image'];
            $imagename = $page['title'];
            $userID    = $page['user_id'];
			$image_owner = get_user_by_id($userID);

			$fname =   isset($image_owner['first_name']) ? $image_owner['first_name'] : "";
			$lname = isset($image_owner['last_name']) ? $image_owner['last_name'] : "";

        ?>
        <div class="col-lg-3 col-md-3 fetch_image">

             <div class="vikct">
			 <img alt="Uploaded by : &nbsp;<?php echo $fname.' '.$lname;?>" src="<?php echo gallery_pic_mediumsrc($imagefile); ?>" class="demo" style="cursor: pointer;">
        <!-- </div>
         <div class="img_details">--><p><?php echo $imagename; ?></p>
            </div>
        </div>

        <?php } ?>
        <?php }else{?>
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
                $pagLink .= "<a class='".$current_sel."' href='gallery.php?page=".$i."'>".$i."</a>";
            };
            echo $pagLink . "</div>";
            ?>
    </div>
</section>


<script type="text/javascript">
    $('.demo').gallerybox();

</script>



<?php
    include_once("footer.php");
?>
