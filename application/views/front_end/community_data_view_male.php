<?php
$matrimony=explode("-matrimony",$this->uri->segment(2));
$matrimony_name=$matrimony[0];
 if(isset($matrimony_cnt) && $matrimony_cnt!='' && $matrimony_cnt > 0 && isset($matrimony_data) && is_array($matrimony_data) && count($matrimony_data) > 0){
	foreach($matrimony_data as $matrimony_data_last) {
		$matriidgroom=explode(",",$matrimony_data_last['matri_id_groom']);
		$matriidbride=explode(",",$matrimony_data_last['matri_id_bride']);
		
	}
}
if(isset($data_row_matri_groom) && is_array($data_row_matri_groom) && count($data_row_matri_groom)>0){
	$member_data = $data_row_matri_groom;
	$path_photos = $this->common_model->path_photos;
		$gender = 'Female';
		include('community_data_view.php');
	?>
		<div class="pagination-wrap mt-0">
		<?php
		if(isset($data_row_matri_groom_count) && $data_row_matri_groom_count !='' && $data_row_matri_groom_count > 5){
		echo $this->common_model->rander_pagination_front_Male("matrimony/".$matrimony_name,$data_row_matri_groom_count);
		}
		?>
	</div>
<?php
}elseif(isset($matrimony_data_grrom_home) && is_array($matrimony_data_grrom_home) && count($matrimony_data_grrom_home)>0){
	$member_data = $matrimony_data_grrom_home;
	$path_photos = $this->common_model->path_photos;
		$gender = 'Female';
		include('community_data_view.php');
	?>
		<div class="pagination-wrap mt-0">
		<?php
		if(isset($data_row_matri_groom_count) && $data_row_matri_groom_count !='' && $data_row_matri_groom_count > 5){
			echo $this->common_model->rander_pagination_front_Male("matrimony/".$matrimony_name,$data_row_matri_groom_count);
		}
		?>
	</div>
<?php
}else{
?>
<div class="row-cstm mt-5">
    <div class="alert alert-danger">
        No Data found to display.
    </div>
</div>
<?php }?>