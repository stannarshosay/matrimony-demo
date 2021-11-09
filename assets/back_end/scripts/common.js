var is_reload_page=0;
function scroll_to_div(div_id)
{
	$('html, body').animate({
		scrollTop: $('#'+div_id).offset().top -55 }, 'slow');
	/*$('html,body').animate({
		scrollTop: $("#"+div_id).offset().top}
	,'slow');*/
}
function show_comm_mask()
{
	var winW = $(window).width();
	var winH = $(window).height();
	var loaderLeft = (winW / 2) - (36 / 2);
	var loaderTop = (winH / 2) - (36 / 2);
	$('#lightbox-panel-mask').css('height', winH + "px");
	$('#lightbox-panel-mask').fadeTo('slow', 0.2);
	$('#lightbox-panel-mask').show();
	$('#lightbox-panel-loader').css({ 'left': loaderLeft + "px", 'top': loaderTop });
	//$("#lightbox-panel-loader").html(""); 
	$('#lightbox-panel-loader').show();
}
function hide_comm_mask()
{
	$('#lightbox-panel-mask').hide();
	$('#lightbox-panel-loader').hide();
}
function Trim(str)
{
	return str.replace(/\s/g,"");
}
var temp_div_content = new Array();

function settimeout_div(div_id,timout)
{
	timout = typeof timout !== 'undefined' ? timout : 10000;
	setTimeout(function(){ $("#"+div_id).slideUp(); }, timout);
}
function remove_element(element,timout)
{
	timout = typeof timout !== 'undefined' ? timout : 10000;
	setTimeout(function(){ $(element).remove(); }, timout);
}
function check_all()
{
	$(".checkbox_val").prop("checked",$("#all").prop("checked"))
}
function check_uncheck_all()
{
	var total_checked = $('input[name="checkbox_val[]"]:checked').length;
	var total = $('input[name="checkbox_val[]"]').length;
	if(total ==total_checked)
	{
		$("#all").prop("checked",true);
	}
	else
	{
		$("#all").prop("checked",false);	
	}
}

function search_change_limit()
{
	get_ajax_search(1);
	return false;
}
function change_order(coloumn_name,order)
{
	//alert(coloumn_name);
	$("#default_order").val(order);
	$("#default_sort").val(coloumn_name);
	get_ajax_search(1);
}
function change_sort_order(order_col)
{
	if(order_col !='')
	{
		var order_arr = order_col.split('-');
		if(order_arr[0] !='' && order_arr[1] !='')
		{
			change_order(order_arr[0],order_arr[1]);
		}
	}
}
function get_ajax_search(page_number)
{
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	
	show_comm_mask();
	$.ajax({
	   url: page_url,
	   type: "post",
	   data: {'csrf_new_matrimonial':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode},
	   success:function(data){
			$("#main_content_ajax").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("main_content_ajax");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			/*$("#hash_tocken_id").val($("#hash_tocken_id_temp").val());*/
			is_reload_page = 0;
	   }
	});
	return false;
}
function update_status_single(id,status_update)
{
	if(status_update =='' || id =='')
	{
		alert('Somthing wrong, Please refress page and try again.')
		return false;
	}
	if(status_update =='DELETE')
	{
		if(!confirm("Are you sure to delete the record?"))
		{
			return false;
		}
	}
	var selected_val = Array();
	var i=0;
	selected_val[i] = id;

	var page_number = 1;
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	
	show_comm_mask();
	$.ajax({
	   url: page_url,
	   type: "post",
	   data: {'csrf_new_matrimonial':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode,'selected_val':selected_val,'status_update':status_update},
	   success:function(data){
			$("#main_content_ajax").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("main_content_ajax");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			/*$("#hash_tocken_id").val($("#hash_tocken_id_temp").val());*/
	   }
	});
	return false;
}
function update_ad_type_single(id,status_update)
{
	if(status_update =='' || id =='')
	{
		alert('Somthing wrong, Please refress page and try again.')
		return false;
	}
	var selected_val = Array();
	var i=0;
	selected_val[i] = id;

	var page_number = 1;
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	
	show_comm_mask();
	$.ajax({
	   url: page_url,
	   type: "post",
	   data: {'csrf_new_matrimonial':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode,'selected_val':selected_val,'status_update':status_update},
	   success:function(data){
			$("#main_content_ajax").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("main_content_ajax");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			/*$("#hash_tocken_id").val($("#hash_tocken_id_temp").val());*/
	   }
	});
	return false;
}

function update_status(status_update)
{
	if(status_update =='')
	{
		alert('Somthing wrong, Please refress page and try again.')
		return false;
	}
	var total_checked = $('input[name="checkbox_val[]"]:checked').length;
	if(total_checked == 0 || total_checked =='')
	{
		alert("Please select at least one record to process");
		return false;
	}
	if(status_update =='DELETE' )
	{
		if(!confirm("Are you sure to delete the record?"))
		{
			return false;
		}
	}
	var selected_val = Array();
	var i=0;
	$('input[name="checkbox_val[]"]:checked').each(function() 
	{
		selected_val[i] = this.value;
		i++;
	});

	var page_number = 1;
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	
	show_comm_mask();
	$.ajax({
		url: page_url,
		type: "post",
		data: {'csrf_new_matrimonial':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode,'selected_val':selected_val,'status_update':status_update},
		success:function(data){
			$("#main_content_ajax").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("main_content_ajax");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
		}
	});
	return false;
}

function block_update_status(status_update)
{
	if(status_update == ''){
		alert('Somthing wrong, Please refress page and try again.')
		return false;
	}
	var total_checked = $('input[name="checkbox_val[]"]:checked').length;
	if(total_checked == 0 || total_checked == ''){
		alert("Please select at least one record to process");
		return false;
	}
	if(status_update == 'BLOCK'){
		if(!confirm("Are you sure to block the record?")){
			return false;
		}
	}
	var selected_val = Array();
	var i=0;
	$('input[name="checkbox_val[]"]:checked').each(function() {
		selected_val[i] = this.value;
		i++;
	});
	var page_number = 1;
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url ==''){
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	show_comm_mask();
	$.ajax({
	   url: page_url,
	   type: "post",
	   data: {'csrf_new_matrimonial':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode,'selected_val':selected_val,'status_update':status_update},
	   success:function(data){
			$("#main_content_ajax").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("main_content_ajax");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
		}
	});
	return false;
}

function update_assign_status(status_update,table)
{
	if(status_update =='')
	{
		alert('Somthing wrong, Please refress page and try again.')
		return false;
	}
	var total_checked = $('input[name="checkbox_val[]"]:checked').length;
	if(total_checked == 0 || total_checked =='')
	{
		alert("Please select at least one record to process");
		return false;
	}
	if(table=='staff'){
		var select_assign_to = $('#staff_id').val();
		if(select_assign_to==''){
			alert("Please select staff to complete action");
			return false;
		}
	}
	else{
		var select_assign_to = $('#franchise_id').val();
		if(select_assign_to==''){
			alert("Please select franchise to complete action");
			return false;
		}
	}
	var selected_val = Array();
	var i=0;
	$('input[name="checkbox_val[]"]:checked').each(function() 
	{
		selected_val[i] = this.value;
		i++;
	});

	var page_number = 1;
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	if(table=='staff'){
		var assign_id = $("#staff_id").val();
	}
	else{
		var assign_id = $("#franchise_id").val();
	}
	
	show_comm_mask();
	$.ajax({
		url: page_url,
		type: "post",
		data: {'csrf_new_matrimonial':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode,'selected_val':selected_val,'assign_id':assign_id,'status_update':status_update},
		success:function(data){
			$("#main_content_ajax").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("main_content_ajax");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
		}
	});
	return false;
}
function change_interest(status_update)
{
	if(status_update =='')
	{
		alert('Somthing wrong, Please refress page and try again.')
		return false;
	}
	var total_checked = $('input[name="checkbox_val[]"]:checked').length;
	if(total_checked == 0 || total_checked =='')
	{
		alert("Please select at least one record to process");
		return false;
	}
	
	var get_interest = $('#interest').val();
	if(get_interest==''){
		alert("Please select interest to complete action");
		return false;
	}
	
	var selected_val = Array();
	var i=0;
	$('input[name="checkbox_val[]"]:checked').each(function() 
	{
		selected_val[i] = this.value;
		i++;
	});

	var page_number = 1;
	var base_url = $("#base_url_ajax").val();
	var page_url = base_url + page_number;
	if(page_number == "" || page_number == 0 ||  base_url =='')
	{
		alert("Some issue arise please refress page.");
		return false;
	}
	curr_page_number = page_number;
	var limit_per_page = $("#limit_per_page").val();
	var search_filed = $("#search_filed").val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var default_sort = $("#default_sort").val();
	var default_order = $("#default_order").val();
	var status_mode = $("#status_mode").val();
	var interest = $("#interest").val();
	
	show_comm_mask();
	$.ajax({
		url: page_url,
		type: "post",
		data: {'csrf_new_matrimonial':hash_tocken_id,'is_ajax':1,'search_filed':search_filed,'limit_per_page':limit_per_page,'default_order':default_order,'default_sort':default_sort,'status_mode':status_mode,'selected_val':selected_val,'interest':interest,'status_update':status_update},
		success:function(data){
			$("#main_content_ajax").html(data);
			hide_comm_mask();
			load_pagination_code();
			scroll_to_div("main_content_ajax");
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
		}
	});
	return false;
}
function update_tocken(tocken)
{
	$(".hash_tocken_id").each(function()
	{
	   $(this).val(tocken);
	})
}
function load_pagination_code()
{	
   $("#ajax_pagin_ul li a").click(function()
   {
		var page_number = $(this).attr("data-ci-pagination-page");
		page_number = typeof page_number !== 'undefined' ? page_number : 0;
		if(page_number == 0)
		{
			return false;
		}
		if(page_number != undefined && page_number !='' && page_number != 0)
		{
			get_ajax_search(page_number);
		}
		return false;
   });
   load_checkbo();
}
function load_checkbo()
{
	$('html').checkBo({checkAllButton:"#all_check",checkAllTarget:".checkbox-row",checkAllTextDefault:"Check All",checkAllTextToggle:"Un-check All"});
}
function tog(v)
{
	return v?'addClass':'removeClass';
}
function back_list()
{
	window.history.back();
}
function edit_data_popup(id)
{
	$("#model_title").html('Edit Data');
	$("#mode").val('edit');
	$("#reponse_message").slideUp();
	$.each($('#id_'+id).data(), function(i, v) 
	{
		if($("#"+String(i)).length > 0)
		{
			//alert(v);
			$("#"+String(i)).val(v);
		/*	
			var temp_chnage = $('#'+String(i)).attr('onchange');
			if(temp_chnage !='' && temp_chnage != undefined)
			{
				$( "#"+String(i) ).trigger( "change" );
			}
		*/	
		}		
		if(i =='status')
		{
			$("input[name='"+String(i)+"'][value='"+String(v)+"']").prop('checked', true);
		}
		//alert('"' + i + '":"' + v + '",');
	});
	
	return false;
}
function add_data_popup()
{
	$("#mode").val('add');
	$("#id").val('');
	$("#model_title").html('Add Data');
	$("#reponse_message").slideUp();
	// $("#common_insert_update").reset();
	//$("#common_insert_update").find('input:radio').removeAttr('checked');
	document.getElementById('common_insert_update').reset();
	$("#APPROVED").attr("checked","checked");
}
function common_submit_fomr()
{
	var form_data = $('#common_insert_update').serialize();
	//alert(form_data);
	var action = $('#common_insert_update').attr('action');
	if(action !='' && form_data !='')
	{
		form_data = form_data+ "&is_ajax=1";
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: form_data,
		   success:function(data)
		   {
			   	$("#reponse_message").html(data.response);
				$("#reponse_message").slideDown();
				update_tocken(data.tocken);
				hide_comm_mask();
				settimeout_div("reponse_message");
				if(data.status == 'success')
				{
					is_reload_page = 1;
				}
				if($("#mode").val() =='add' && data.status == 'success')
				{
					form_reset();
				}
		   }
		});
	}
	else
	{
		alert("Some issue arise please refress page.");
	}
	return false;
}
function form_reset()
{
	var elemet_not_resest = new Array();
	var i = 0;
	$('.not_reset').each(function() 
	{
		elemet_not_resest[i] = this.value;
		i++;
	});
	document.getElementById('common_insert_update').reset();
	i = 0;
	$('.not_reset').each(function()
	{
		this.value = elemet_not_resest[i];
		i++;
	});
}
function close_popup()
{
	$('#common_insert_update').validate().resetForm();
    $('.error').removeClass('error');
	if(is_reload_page == 1)
	{
		get_ajax_search(1);
	}
}

function dropdownChange_mul(currnet_id,disp_on,get_list)
{
	var base_url = $("#base_url").val();
	action = base_url+ 'common_request/get_list';
	var hash_tocken_id = $("#hash_tocken_id").val();
	currnet_val = $("#"+currnet_id).val();
	if(currnet_val !='' && currnet_val !=null)
	{
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: {'csrf_new_matrimonial':hash_tocken_id,'get_list':get_list,'currnet_val':currnet_val,'multivar':'multi','tocken_val':1},
		   success:function(data)
		   {
				$("#"+disp_on).html(data.dataStr);
				update_tocken(data.tocken);
				$('#'+disp_on).trigger('chosen:updated');
				hide_comm_mask();
				if(get_list =='state_list')
				{
					if($(".city_list_update").length > 0)
					{
						$(".city_list_update").html('<option value="">Select City</option>');
						$('.city_list_update').trigger('chosen:updated');
						$('#part_city').val('').trigger("change");
					}
				}
		   }
		});
	}
	else
	{
		$("#"+disp_on).html('<option value="">Select Value</option>');
		$('#'+disp_on).trigger('chosen:updated');
		if($(".city_list_update").length > 0)
		{
			$(".city_list_update").html('<option value="">Select City</option>');
			$('.city_list_update').trigger('chosen:updated');
			$('#part_city').val('').trigger("change");
		}
	}
}
// function dropdownChange_mul_com(currnet_id,disp_on,get_list,value)
// {

// 	var base_url = $("#base_url").val();
// 	//alert(base_url);

// 	action = base_url+ 'common_request/get_list';
// 	var hash_tocken_id = $("#hash_tocken_id").val();
// 	currnet_val = $("#"+currnet_id).val();
// 	var value = $("#"+value).val();

// 	if(value!='' && value=='religion_list')
// 	{
// 		value = 'religion';
// 	}
// 	else if(value!='' && value=='caste_dropdown')
// 	{
// 		value = 'caste';
// 	}
// 	else if(value!='' && value=='mothertongue_list')
// 	{
// 		value = 'mother_tongue';
// 	}
// 	else if(value!='' && value=='country_list')
// 	{
// 		value = 'country_id';
// 	}
// 	alert(value);
// 	if(currnet_val !='' && currnet_val !=null)
// 	{
// 		show_comm_mask();
// 		$.ajax({
// 		   url: action,
// 		   type: "post",
// 		   dataType:"json",
// 		   data: {'csrf_new_matrimonial':hash_tocken_id,'get_list':get_list,'currnet_val':currnet_val,'multivar':'multi','tocken_val':1,'column_nam':value},
// 		   success:function(data)
// 		   {
// 				alert(data.dataStr);
// 				$("#"+disp_on).html(data.dataStr);
// 				update_tocken(data.tocken);
// 				$('#'+disp_on).trigger('chosen:updated');
// 				hide_comm_mask();
// 				if(get_list =='state_list')
// 				{
// 					if($(".city_list_update").length > 0)
// 					{
// 						$(".city_list_update").html('<option value="">Select City</option>');
// 						$('.city_list_update').trigger('chosen:updated');
// 					}
// 				}
// 		   }
// 		});
// 	}
// 	else
// 	{
// 		$("#"+disp_on).html('<option value="">Select Value</option>');
// 		$('#'+disp_on).trigger('chosen:updated');
// 		if($(".city_list_update").length > 0)
// 		{
// 			$(".city_list_update").html('<option value="">Select City</option>');
// 			$('.city_list_update').trigger('chosen:updated');
// 		}
// 	}
// }
/* For Matrimony data start*/
function dropdownChange_com(disp_on,get_list)
{
	var base_url = $("#base_url").val();
	action = base_url+ 'common_request/get_list';
	var hash_tocken_id = $("#hash_tocken_id").val();
	var get_list = $("#"+get_list).val();
	
	if(get_list!='' && get_list=='Religion')
	{
		get_list = 'religion_lists';
	}
	else if(get_list!='' && get_list=='Caste')
	{
		get_list = 'caste_dropdown';
	}
	else if(get_list!='' && get_list=='Mother-Tongue')
	{
		get_list = 'mothertongue_lists';
	}
	else if(get_list!='' && get_list=='Country')
	{
		get_list = 'country_lists';
	}
	else if(get_list!='' && get_list=='State')
	{
		get_list = 'state_lists';
	}
	else if(get_list!='' && get_list=='City')
	{
		get_list = 'city_lists';
		if(get_list!='' && get_list=='city_lists')
		{
			city(get_list);
			return false;
		}
	}

	if(get_list !='' && get_list != null )
	{
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: {'csrf_new_matrimonial':hash_tocken_id,'get_list':get_list},
		   success:function(data)
		   {
				
				$("#"+disp_on).html(data.dataStr);
				update_tocken(data.tocken);
				$('#matrimony_name').select2().trigger('refresh');
				hide_comm_mask();
		   }
		});
	}
	else
	{
		$("#"+disp_on).html('<option value="">Select Value</option>');
	}
}
function city(get_list)
{
	if(get_list!='' && get_list=='city_lists')
	{
		$('#matrimony_name').html('<option value="">Select City</option>');
		var base_url_admin_only = $("#base_url_admin_only").val();
		var hash_tocken_id = $("#hash_tocken_id").val();
		$('#matrimony_name').select2({
			ajax: {
				url: base_url_admin_only+'new_listing/get_ajax_city',
				type: 'post',
				dataType: 'json',
				delay: 250,
				data: function (params) {
					
					return {
						csrf_new_matrimonial:hash_tocken_id,
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	}
}
function city_for_edit(get_list)
{
	if(get_list!='' && get_list=='city_lists')
	{
		var base_url_admin_only = $("#base_url_admin_only").val();
		var hash_tocken_id = $("#hash_tocken_id").val();
		$('#matrimony_name').select2({
			ajax: {
				url: base_url_admin_only+'new_listing/get_ajax_city',
				type: 'post',
				dataType: 'json',
				delay: 250,
				data: function (params) {
					
					return {
						csrf_new_matrimonial:hash_tocken_id,
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	}
}
/* For Matrimony data end*/
function dropdownChange(currnet_id,disp_on,get_list)
{
	var base_url = $("#base_url").val();
	action = base_url+ 'common_request/get_list';
	var hash_tocken_id = $("#hash_tocken_id").val();
	currnet_val = $("#"+currnet_id).val();
	if(currnet_val !='' && currnet_val != null )
	{
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: {'csrf_new_matrimonial':hash_tocken_id,'get_list':get_list,'currnet_val':currnet_val},
		   success:function(data)
		   {
			   
				$("#"+disp_on).html(data.dataStr);
				update_tocken(data.tocken);
				hide_comm_mask();
				if(get_list =='state_list')
				{
					if($("#city").length > 0)
					{
						$("#city").html('<option value="">Select City</option>');

					}
				}
		   }
		});
	}
	else
	{
		$("#"+disp_on).html('<option value="">Select Value</option>');
		if(get_list =='state_list')
		{
			if($("#city").length > 0)
			{
				$("#city").html('<option value="">Select City</option>');

			}
		}
	}
}
function chnageadvType()
{
	var adv_type = $('.adv_type:checked').val();
	if(adv_type =='Image')
	{
		$(".image_adv").slideDown();
		$(".google_adv").slideUp();
	}
	else
	{
		$(".google_adv").slideDown();
		$(".image_adv").slideUp();
	}
}

function job_seek_address_val()
{
	if($("#form_address_detail").length > 0)
	{
		$("#form_address_detail").validate({
			submitHandler: function(form) 
			{
				edit_profile('address_detail','save');
				return false;
				//return true;
			}
		});
	}
}
function model_search()
{
	var form_data = $('#form_model_search').serialize();
	var action = $('#form_model_search').attr('action')
	var hash_tocken_id = $("#hash_tocken_id").val();
	form_data = form_data+ "&csrf_new_matrimonial="+hash_tocken_id;	
	show_comm_mask();
	$.ajax({
	   url: action,
	   type: "post",
	   dataType:"json",
	   data: form_data,
	   success:function(data)
	   {
		    $('#myModal_filter').modal('hide');
			update_tocken(data.tocken);
			get_ajax_search(1);
	   }
	});
	return false;
}

function clear_model_filter()
{
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/clear_filter';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
		url: action,
		type: "post",
		dataType:"json",
		data: {"csrf_new_matrimonial":hash_tocken_id},
		success:function(data)
		{
			document.getElementById('form_model_search').reset();
			$('#from_reg_date').val("").datepicker("update");
			$('#to_reg_date').val("").datepicker("update");
			$(".chosen-select").val('').trigger("chosen:updated");
			$(".chosen_select_remove").html('');
			$(".chosen_select_remove").trigger('chosen:updated');
			update_tocken(data.tocken);
			get_ajax_search(1);
		}
	});
	return false;
}
function model_ip_search()
{
	var form_data = $('#form_model_ip_search').serialize();
	var action = $('#form_model_ip_search').attr('action')
	var hash_tocken_id = $("#hash_tocken_id").val();
	form_data = form_data+ "&csrf_new_matrimonial="+hash_tocken_id;	
	show_comm_mask();
	$.ajax({
		url: action,
		type: "post",
		dataType:"json",
		data: form_data,
		success:function(data)
		{
		    $('#myModal_ip_search').modal('hide');
			update_tocken(data.tocken);
			get_ajax_search(1);
		}
	});
	return false;
}
function clear_model_ip_search()
{
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/clear_ip_filter';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
		url: action,
		type: "post",
		dataType:"json",
		data: {"csrf_new_matrimonial":hash_tocken_id},
		success:function(data)
		{
			document.getElementById('form_model_ip_search').reset();
			$(".chosen-select").val('').trigger("chosen:updated");
			$(".chosen_select_remove").html('');
			$(".chosen_select_remove").trigger('chosen:updated');
			update_tocken(data.tocken);
			get_ajax_search(1);
		}
	});
	return false;
}
/* for payment pop up*/
function display_payment(user_id)
{
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/plan_list';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$('#model_title_common').html('Plan Assignment');
	$('#model_body_common').html('please wait...');
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
	   success:function(data)
	   {
		    $('#model_body_common').html(data);
		    update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('Plan Assignment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
	   }
	});
	return false;
}
function update_payment_member()
{
	var plan_id = $("#plan_id").val();
	var payment_note = $("#payment_note").val();
	var hidd_user_id = $("#hidd_user_id").val();
	var payment_mode = $("#payment_mode").val();
	
	$('#model_body_common_err').html('');
	$('#model_body_common_err').slideUp();
	
	if(plan_id =='')
	{
		alert('Please Select Plan');
		return false;
	}
	if(payment_mode =='')
	{
		alert('Please Select Payment mode');
		return false;
	}
	
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/plan_update';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
	   url: action,
	   type: "post",
	   dataType:"json",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'plan_id':plan_id,'payment_note':payment_note,'user_id':hidd_user_id,'payment_method':payment_mode},
	   success:function(data)
	   {
		    update_tocken(data.tocken);
			if(data.status == 'success')
			{
				$('#model_body_common').html(data.message);
				get_ajax_search(1);
			}
			else
			{
				$('#model_body_common_err').html(data.message);
				$('#model_body_common_err').slideDown();
			}
			$('#model_title_common').html('Plan Assignment');
			hide_comm_mask();
	   }
	});
	return false;
}
function close_payment_pop()
{
	$('#model_title_common').html('');
	$('#model_body_common').html('');
	$('#myModal_common').modal('hide');
}
/* for payment pop up*/
// for adding comment and view comment
function display_comment(user_id)
{
	var base_url_admin = $("#base_url_admin_only").val();
	var action = base_url_admin +'member/view_comment';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$('#model_title_common').html('View Comment');
	$('#model_body_common').html('please wait...');
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
	   success:function(data)
	   {
		    $('#model_body_common').html(data);
		    update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('View Comment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
	   }
	});
	return false;
}
function display_add_comment(user_id)
{
	var base_url_admin = $("#base_url_admin_only").val();
	var action = base_url_admin +'member/add_comment';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$('#model_title_common').html('Add Comment');
	$('#model_body_common').html('please wait...');
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
	   success:function(data)
	   {
		    $('#model_body_common').html(data);
		    update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('Add Comment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
	   }
	});
	return false;
}
function save_comment_member()
{
	CKEDITOR.instances['member_comment'].updateElement();
	var form_data = $('#add_comment_form').serialize();
	var action = $('#add_comment_form').attr('action');
	var hash_tocken_id = $("#hash_tocken_id").val();
	if(action !='' && form_data !='')
	{
		form_data = form_data+ "&csrf_new_matrimonial="+hash_tocken_id;	
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: form_data,
		   success:function(data)
		   {
			   	$("#reponse_message_comm").html(data.response);
				$("#reponse_message_comm").slideDown();
				update_tocken(data.tocken);
				$('#myModal_common').scrollTop(0);
				$("#member_comment").val('');
				$("#add_comment_form")[0].reset();
				CKEDITOR.instances.member_comment.setData('');
				hide_comm_mask();
				settimeout_div("reponse_message_comm");
			}
		});
	}
	else
	{
		alert("Some issue arise please refress page.");
	}
	return false;
}
function lead_generation_add_comment(user_id)
{
	var base_url_admin = $("#base_url_admin_only").val();
	var action = base_url_admin +'lead_generation/add_comment';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$('#model_title_common').html('Add Comment');
	$('#model_body_common').html('please wait...');
	$.ajax({
		url: action,
		type: "post",
		data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
		success:function(data)
		{
			$('#model_body_common').html(data);
			update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('Add Comment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
		}
	});
	return false;
}
function lead_generation_comment(user_id)
{
	var base_url_admin = $("#base_url_admin_only").val();
	var action = base_url_admin +'lead_generation/view_comment';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$('#model_title_common').html('View Comment');
	$('#model_body_common').html('please wait...');
	$.ajax({
		url: action,
		type: "post",
		data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
		success:function(data)
		{
		    $('#model_body_common').html(data);
		    update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('View Comment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
		}
	});
	return false;
}
function save_comment_lead_generation()
{
	CKEDITOR.instances['lead_comment'].updateElement();
	var form_data = $('#add_comment_form').serialize();
	var action = $('#add_comment_form').attr('action');
	var hash_tocken_id = $("#hash_tocken_id").val();
	if(action !='' && form_data !='')
	{
		form_data = form_data+ "&csrf_new_matrimonial="+hash_tocken_id;	
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: form_data,
		   success:function(data)
		   {
			   	$("#reponse_message_comm").html(data.response);
				$("#reponse_message_comm").slideDown();
				update_tocken(data.tocken);
				$('#myModal_common').scrollTop(0);
				$("#member_comment").val('');
				$("#add_comment_form")[0].reset();
				CKEDITOR.instances.lead_comment.setData('');
				hide_comm_mask();
				settimeout_div("reponse_message_comm");
		   }
		});
	}
	else
	{
		alert("Some issue arise please refress page.");
	}
	return false;
}

// for adding comment
/* for magnifi glass zoom*/
function OnhoverMove()
{
	var native_width = 0;
	var native_height = 0;
  	var mouse = {x: 0, y: 0};
  	var magnify;
  	var cur_img;
  	var ui = {
    	magniflier: $('.magniflier')
  	};
	if (ui.magniflier.length)
	{
    	var div = document.createElement('div');
	    div.setAttribute('class', 'glass');
    	ui.glass = $(div);
	    $('body').append(div);
  	}
	var mouseMove = function(e)
	{
    	var $el = $(this);
	    var magnify_offset = cur_img.offset();
	    mouse.x = e.pageX - magnify_offset.left;
    	mouse.y = e.pageY - magnify_offset.top;
	    if(
		     mouse.x < cur_img.width() &&
		     mouse.y < cur_img.height() &&
	      	 mouse.x > 0 &&
      		 mouse.y > 0
	    ){
      		magnify(e);
    	}
    	else {
      		ui.glass.fadeOut(100);
    	}
    	return;
  	};
  	var magnify = function(e){
    var rx = Math.round(mouse.x/cur_img.width()*native_width - ui.glass.width()/2)*-1;
    var ry = Math.round(mouse.y/cur_img.height()*native_height - ui.glass.height()/2)*-1;
    var bg_pos = rx + "px " + ry + "px";
    var glass_left = e.pageX - ui.glass.width() / 2;
    var glass_top  = e.pageY - ui.glass.height() / 2;
    ui.glass.css({
      left: glass_left,
      top: glass_top,
      backgroundPosition: bg_pos
    });
    return;
  };
  $('.magniflier').on('mousemove', function()
  {
    ui.glass.fadeIn(100);
    cur_img = $(this);
    var large_img_loaded = cur_img.data('large-img-loaded');
    var src = cur_img.data('large') || cur_img.attr('src');
    if (src) {
      ui.glass.css({
        'background-image': 'url(' + src + ')',
        'background-repeat': 'no-repeat'
      });
    }
    if (!cur_img.data('native_width')){
        var image_object = new Image();
        image_object.onload = function() {
        native_width = image_object.width;
        native_height = image_object.height;
        cur_img.data('native_width', native_width);
        cur_img.data('native_height', native_height);
        mouseMove.apply(this, arguments);
        ui.glass.on('mousemove', mouseMove);
     };
     image_object.src = src;
        return;
     }
	 else 
	 {
        native_width = cur_img.data('native_width');
        native_height = cur_img.data('native_height');
     }
	mouseMove.apply(this, arguments);
    ui.glass.on('mousemove', mouseMove);
  });
  ui.glass.on('mouseout', function() {
    ui.glass.off('mousemove', mouseMove);
  });
}
/* for magnifi glass zoom*/
var temp_value_duplicate ='';
function check_duplicate(id_field,check_on)
{
	var id = $("#id").val();
	var mode = $("#mode").val();
	var field_value = $("#"+id_field).val();
	var hash_tocken_id = $("#hash_tocken_id").val();
	var base_url = $("#base_url").val();
	var page_url = base_url+ 'common_request/check_duplicate';
	if(id_field !='' && check_on !=''&& field_value !='' && mode !='' && temp_value_duplicate != field_value)
	{
		$.ajax({
		   url: page_url,
		   type: "post",
		   dataType:"json",
		   data: {'csrf_new_matrimonial':hash_tocken_id,'id':id,'mode':mode,'field_value':field_value,'field_name':id_field,'check_on':check_on},
		   success:function(data)
		   {
				if(data.status == 'success')
				{
					if($("#" + id_field+'-error').length == 0) 
					{
						$( "#"+ id_field ).after( '<label id="'+id_field+'-error" class="error" for="'+id_field+'"></label>' );
					}
					
					$("#"+id_field+'-error').text('Duplicate value found, please enter another one');
					$("#"+id_field+'-error').show();
					$("#"+id_field).addClass('error');
				}
				else
				{
					if($("#" + id_field+'-error').length > 0) 
					{
						$("#"+id_field+'-error').hide();
					}
					$("#"+id_field).removeClass('error');
				}
				update_tocken(data.tocken);
		   }
		});
	}
	return false;
}
function select2(list_id,label)
{
	$(list_id).select2({
	 placeholder: label
	 });
}
function get_suggestion_list(list_id,label,status)
{
	var base_url = $("#base_url").val();
	var action = base_url+ 'common_request/get_list_select2';
	var hash_tocken_id = $("#hash_tocken_id").val();
	$('#'+list_id).select2({
	 placeholder: label,
	  ajax: {
		url: action,
		type: "POST",
		dataType:'json',
		data: function (params) {
		  return {
			q: params.term, // search term
			page: params.page,
			csrf_new_matrimonial: hash_tocken_id,
			list_id:list_id,
			status:status
		  };
		},
	  }
	});
}

var numDays = {
	'01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, 
    '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31
};

function setDays(oMonthSel, oDaysSel, oYearSel)
{ 
	var nDays, oDaysSelLgth, opt, i = 1;
	nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value]; 
	if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
		++nDays; 
	oDaysSelLgth = oDaysSel.length; 
	if (nDays != oDaysSelLgth)
	{ 
		if (nDays < oDaysSelLgth) 
			oDaysSel.length = nDays; 
		else for (i; i < nDays - oDaysSelLgth + 1; i++)
		{ 
			opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i); 
                  	oDaysSel.options[oDaysSel.length] = opt;
		} 
	}
	var oForm = oMonthSel.form;
	var month = oMonthSel.options[oMonthSel.selectedIndex].value;
	var day = oDaysSel.options[oDaysSel.selectedIndex].value;
	var year = oYearSel.options[oYearSel.selectedIndex].value;	
	//oForm.datepicker.value = year + '-' + month + '-' + day;
}

function display_comments(user_id)
{
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/view_comment';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$('#model_title_common').html('View Comment');
	$('#model_body_common').html('please wait...');
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
	   success:function(data)
	   {
		    $('#model_body_common').html(data);
		    update_tocken($("#hash_tocken_id").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('View Comment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
	   }
	});
	return false;
}
function display_add_comment(user_id)
{
	
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/add_comment';
	var hash_tocken_id = $("#hash_tocken_id").val();

	show_comm_mask();
	$('#model_title_common').html('Add Comment');
	$('#model_body_common').html('please wait...');
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
	   success:function(data)
	   {
		    $('#model_body_common').html(data);
		    update_tocken($("#hash_tocken_id").val());
			$("#hash_tocken_id_temp").remove();
			$('#model_title_common').html('Add Comment');
			$('#myModal_common').modal('show');
			hide_comm_mask();
	   }
	});
	return false;
}
function save_comment_members()
{
	CKEDITOR.instances['member_comment'].updateElement();
	var form_data = $('#add_comment_form').serialize();
	var action = $('#add_comment_form').attr('action');
	var hash_tocken_id = $("#hash_tocken_id_temp").val();
	if(action !='' && form_data !='')
	{
		form_data = form_data;//+ "&csrf_new_matrimonial="+hash_tocken_id;	
		show_comm_mask();
		$.ajax({
		   url: action,
		   type: "post",
		   dataType:"json",
		   data: form_data,
		   success:function(data)
		   {
			   	$("#reponse_message_comm").html(data.response);
				$("#reponse_message_comm").slideDown();
				update_tocken(data.tocken);
				$('#myModal_common').scrollTop(0);
				$("#member_comment").val('');
				CKEDITOR.instances.member_comment.setData('');
				hide_comm_mask();
				settimeout_div("reponse_message_comm");
		   }
		});
	}
	else
	{
		alert("Some issue arise please refress page.");
	}
	return false;
}

function show_hide_option_rad(view_member)
{
	var view_member_val = $("input[name='"+view_member+"']:checked").val();
	if(view_member_val == 'All Members')
	{
		$(".radio_"+view_member+"_All").attr("disabled", false);
		$(".radio_"+view_member+"_Own").attr("disabled", false);
		$(".radio_"+view_member+"_All").prop('checked',true);
	}
	else if(view_member_val == 'Own Members')
	{
		$(".radio_"+view_member+"_All").attr("disabled", true);
		$(".radio_"+view_member+"_Own").attr("disabled", false);
		$(".radio_"+view_member+"_Own").prop('checked',true);
	}
	else
	{
		$(".radio_"+view_member+"_All").attr("disabled", true);
		$(".radio_"+view_member+"_Own").attr("disabled", true);
		$(".radio_"+view_member+"_No").prop('checked',true);
	}
}

function resend_confirm_mail(user_id)
{
	var base_url_admin = $("#base_url_admin_only").val();
	var action = base_url_admin +'member/resend_confirm_mail';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
	   url: action,
	   type: "post",
	   dataType:'json',
	   data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
	   success:function(data)
	   {
			if(data.status == 'success'){
				alert(data.error_message);
			}else{
				alert(data.error_message);
			}
			update_tocken(data.tocken);
			hide_comm_mask();
	   }
	});
	return false;
}

function confirm_staff_access()
{
	if(confirm("Are you sure you want to login this staff member?")) {
		return true;
	}
    return false;
}

function check_brideid_groomid(id)
{
	var brideid='';
	var groomid='';
	if(id == 1){
		var gender='Female';
		brideid = $("#brideid").val();
	}else if(id == 2){
		var gender='Male';
		groomid = $("#groomid").val();
	}else{
		return false;
	}
	
	var base_url_admin = $("#base_url_admin_only").val();
	var action = base_url_admin +'approval/check_brideid_groomid';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
	   url: action,
	   type: "post",
	   dataType:'json',
	   data: {"csrf_new_matrimonial":hash_tocken_id,'gender':gender,'brideid':brideid,'groomid':groomid},
	   success:function(data)
	   {
			if(data.status == 'error'){
				if(data.brideid == 'brideid'){
					$("#brideid").val('');
					$("#brideid").focus();
				}
				if(data.groomid == 'groomid'){
					$("#groomid").val('');
					$("#groomid").focus();
				}
				alert(data.error_message);
			}
			update_tocken(data.tocken);
			hide_comm_mask();
		}
	});
	return false;
}

function KeycheckOnlyCharacter(e)
{
	//var charCode = e.keyCode;

	var charCode = (e.keyCode ? e.keyCode : e.which);
	if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || ( charCode == 37 && charCode == 38 && charCode == 39 && charCode == 40) || charCode == 46 || charCode == 13 || charCode == 9)
	{
		return true;
	}else{
		return false;
	}
}

function KeycheckOnlyPhonenumber(e)
{
	var _dom = 0;
	_dom = document.all ? 3 : (document.getElementById ? 1 : (document.layers ? 2 : 0));
	if (document.all)
		e = window.event; // for IE
	var ch = '';
	var KeyID = '';
	if (_dom == 2) { // for NN4
		if (e.which > 0)
			ch = '(' + String.fromCharCode(e.which) + ')';
		KeyID = e.which;
	} else
	{
		if (_dom == 3) { // for IE
			KeyID = (window.event) ? event.keyCode : e.which;
		} else { // for Mozilla
			if (e.charCode > 0)
				ch = '(' + String.fromCharCode(e.charCode) + ')';
			KeyID = e.charCode;
		}
	}
	if ((KeyID >= 65 && KeyID <= 90) || (KeyID >= 97 && KeyID <= 122) || (KeyID >= 33 && KeyID <= 40) || (KeyID >= 42 && KeyID <= 42) || (KeyID == 44) || (KeyID >= 46 && KeyID <= 47) || (KeyID >= 58 && KeyID <= 64) || (KeyID >= 91 && KeyID <= 96) || (KeyID >= 123 && KeyID <= 126))
	{
		return false;
	}
	return true;
}
function update_photo()
{
	var croped_base64 = $("#croped_base64").val();
	if(croped_base64 =='')
	{
		alert("Please select image and crop first");
		return false;
	}
	//$('#response_message').removeClass('alert alert-success alert-danger alert-warning');
	$('#response_message').html('');
	var base_url = $("#base_url_admin_only").val();
	var member_id = $("#member_id").val();
	var photo_number = $("#photo_number").val();
	var file_name_upload = $("#file_name_upload").val();
	//var profi_phot = 'profile_photo'+photo_number+'_crop';
	//var profi_org = 'profile_photo'+photo_number+'_org';
	var url_load = base_url+ 'approval/upload_photo_new';
	var hash_tocken_id = $("#hash_tocken_id").val();
	//var orig_base64 = $("#orig_base64").val();
	
	var fd = new FormData();
	
	var block = croped_base64.split(";");
	var contentType = block[0].split(":")[1];// In this case "image/gif"
	// get the real base64 content of the file
	var realData = block[1].split(",")[1];// In this case "iVBORw0KGg...."
	// Convert to blob
	var blob1= b64toBlob(realData, contentType);
	// for gennerate image from base64
	file_name = 'cropped_image.png';
	img_file_name = 'profile_photo'+photo_number+'_crop';
	
	fd.append(img_file_name, blob1,file_name);

	fd.append("csrf_new_matrimonial", hash_tocken_id);
	fd.append("is_ajax", "1");
	fd.append("photo_number", photo_number);
	fd.append("member_id", member_id);
	fd.append("file_name_upload", file_name_upload);
	fd.append("user_agent", 'NI-AAPP');
	
	show_comm_mask();
	$.ajax({
	   url: url_load,
	   type: "post",
	   dataType:"json",
	   data: fd,
	   contentType:false,
	   processData:false,
	   cache:false,
	   success:function(data)
	   {
			$("#response_message").html(data.errmessage);
			$("#response_message").slideDown();
			if(data.status =='success')
			{
				$("#response_message").addClass('alert alert-success');
				$("#main_crop_image_area").hide();
				$("#upload_btn").hide();
				//srci = window.parent.document.getElementById("img_dt_"+member_id).src;
				//window.parent.document.getElementById("img_dt_"+member_id).src = croped_base64;
				//$("#img_dt_"+member_id).attr('src',croped_base64);
				
			}
			else
			{
				$("#response_message").addClass('alert alert-danger');
			}
			update_tocken(data.tocken);
			hide_comm_mask();
	   }
	});
}
function b64toBlob(b64Data, contentType, sliceSize)
{
	contentType = contentType || '';
	sliceSize = sliceSize || 512;
	
	var byteCharacters = atob(b64Data);
	var byteArrays = [];
	
	for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
		var slice = byteCharacters.slice(offset, offset + sliceSize);
	
		var byteNumbers = new Array(slice.length);
		for (var i = 0; i < slice.length; i++) {
			byteNumbers[i] = slice.charCodeAt(i);
		}
	
		var byteArray = new Uint8Array(byteNumbers);
	
		byteArrays.push(byteArray);
	}
	var blob = new Blob(byteArrays, {type: contentType});
	return blob;
}

function load_canvas_scrop(file_img)
{
	$("#main_crop_image_area").show();
	$("#croped_img").html('');
	$("#upload_btn").hide();
	
	var rot = 0,ratio = 1;
	var CanvasCrop = $.CanvasCrop({
		cropBox : ".imageBox",
		imgSrc : file_img,
		limitOver : 0
	});
	$('#upload-file').on('change', function(){
		var reader = new FileReader();
		reader.onload = function(e) {
			CanvasCrop = $.CanvasCrop({
				cropBox : ".imageBox",
				imgSrc : e.target.result,
				limitOver : 0
			});
			rot =0 ;
			ratio = 1;
		}
		reader.readAsDataURL(this.files[0]);
		this.files = [];
	});
	
	$("#rotateLeft").on("click",function(){
		rot -= 90;
		rot = rot<0?270:rot;
		CanvasCrop.rotate(rot);
	});
	$("#rotateRight").on("click",function(){
		rot += 90;
		rot = rot>360?90:rot;
		CanvasCrop.rotate(rot);
	});
	$("#zoomIn").on("click",function(){
		ratio =ratio*0.9;
		CanvasCrop.scale(ratio);
	});
	$("#zoomOut").on("click",function(){
		ratio =ratio*1.1;
		CanvasCrop.scale(ratio);
	});
	$("#alertInfo").on("click",function(){
		var canvas = document.getElementById("visbleCanvas");
		var context = canvas.getContext("2d");
		context.clearRect(0,0,canvas.width,canvas.height);
	});
	
	$("#crop").on("click",function(){
		var src = CanvasCrop.getDataURL("png");
		//$("body").append("<div style='word-break: break-all;'>"+src+"</div>");  
		//$(".container").append("<img src='"+src+"' />");
		$("#croped_img").html("<img src='"+src+"' />");
		$("#croped_base64").val(src);
		$("#upload_btn").show();
		//update_photo();
	});        
	console.log("ontouchend" in document);		
}
var myWindow;
function crop_photo(user_id,photo_number)
{
	var w = 1124;
	var h = 640;
	var base_url_admin = $("#base_url_admin").val();
	var action = base_url_admin +'/crop_photo/'+user_id+'/'+photo_number;
	
	var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;  
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;  
              
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;  
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;  
              
    var left = ((width / 2) - (w / 2)) + dualScreenLeft;  
    var top = ((height / 2) - (h / 2)) + dualScreenTop;  
	

	var newWindow = window.open(action, "Crop Photo", 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
	//var myWindow = window.open(action, "Crop Photo", "width=1124,height=660");
	return false;
	
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	//$('#model_title_common').html('Plan Assignment');
	//$('#model_body_common').html('please wait...');
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'user_id':user_id},
	   success:function(data)
	   {
		   $('#response_first_load').html(data);
		    update_tocken($("#hash_tocken_id_temp").val());
			$("#hash_tocken_id_temp").remove();
			$("#upload_btn").hide();
			//$('#model_title_common').html('Plan Assignment');
			//$('#myModal_pic').modal('show');
			//http://192.168.1.111/mega_matrimony/assets/photos_big/20a77cb6e91eb14ac6dfec5b98de04e9.png
			/* var CanvasCrop = $.CanvasCrop({
				cropBox : ".imageBox",
				imgSrc : "http://192.168.1.111/mega_matrimony/assets/photos_big/20a77cb6e91eb14ac6dfec5b98de04e9.png",
				limitOver : 2
			});*/
			
			hide_comm_mask();
	   }
	});
	return false;
}
function closeWin() {
	window.close();
    //myWindow.close();
}
//  phone();
//         function phone(){
//             document.getElementById('phone').innerHTML = 'Residence/Landline';
//         };
      


// // time change
// var times = {}, re = /^\d+(?=:)/;

// for (var i = 13, n = 1; i < 24; i++, n++) {
//   times[i] = n < 10 ? "0" + n : n
// }

// document.getElementById("birthtime")
// .onchange = function() {
// 	console.log("hai");
//   var time = this
//   , value = time.value
//   , match = value.match(re)[0];
//   this.nextElementSibling.innerHTML =
//   (match && match >= 13 ? value.replace(re, times[match]) : value)
//   + (time.valueAsDate.getTime() < 43200000 ? " AM" : " PM")
// }


window.onload = function(){  


	
	var physical_status = $("[name='physical_status']:checked").val();
	if(physical_status !='' && physical_status =='Yes'){
		$('.disabled_discription').css('display','block');
	}
	else{
		$('.disabled_discription').css('display','none');
	}

	var religion_status = $("[name='religion']").val();
	//console.log(religion_status);
	if(religion_status !='' && religion_status =='1')
	{
		$('.parish').css('display','none');
		$('.diocese').css('display','none');
		$('.horoscope').css('display','block');
		$('.manglik').css('display','block');
		$('.star').css('display','block');
		$('.gothra').css('display','block');
		$('.moonsign').css('display','block');
		$('.birthtime').css('display','block');
		$('.subcaste').css('display','block');
		$('.having_dosham').css('display','block');

		
	}
	else if(religion_status !='' && religion_status =='30')
	{
		$('.horoscope').css('display','none');
		$('.manglik').css('display','none');
		$('.star').css('display','none');
		$('.gothra').css('display','none');
		$('.moonsign').css('display','none');
		$('.parish').css('display','block');
		$('.diocese').css('display','block');
		$('.birthtime').css('display','none');
		$('.subcaste').css('display','none');
		$('.having_dosham').css('display','none');

		
	}
	else{
		$('.horoscope').css('display','none');
		$('.manglik').css('display','none');
		$('.star').css('display','none');
		$('.gothra').css('display','none');
		$('.moonsign').css('display','none');
		$('.parish').css('display','none');
		$('.birthtime').css('display','none');
        $('.subcaste').css('display','none');
		$('.diocese').css('display','none');
		$('.having_dosham').css('display','none');
	}
	var part_religion_status = $("#part_religion").val()==null?[]:$("#part_religion").val();

	//console.log(part_religion_status);
				$('.part_parish').css('display','none');
			 	$('.part_diocese').css('display','none');
			 	$('.part_manglik').css('display','none');
	 	        $('.part_star').css('display','none');
	 	        $('.part_gothra').css('display','none');
	 	        $('.part_moonsign').css('display','none');
	$.each(part_religion_status, function(key,value) {

	  //alert(value.com);
	  //console.log(value);
	  switch(value){

	  	case '1':{
	  		// 	$('.part_christian_denomination').css('display','none');
			 	// $('.part_diocese').css('display','none');
			 	$('.part_manglik').css('display','block');
	 	        $('.part_star').css('display','block');
	 	        $('.part_gothra').css('display','block');
	 	        $('.part_moonsign').css('display','block');

	  		break;
	  	}
	  	case '30':{
	  		$('.part_parish').css('display','block');
			 	$('.part_diocese').css('display','block');
			 	// $('.part_manglik').css('display','none');
	 	  //       $('.part_star').css('display','none');
	 	  //       $('.part_gothra').css('display','none');
	 	  //       $('.part_moonsign').css('display','none');
	  		break;
	  	}
	  	case '3':{
	  		//console.log("muslim");
	  		break;
	  	}
	  	default:{
	  		console.log("default");
	  	}
	  }
	}); 
 
}  
function ReligionChange()
{
	var religion_status = $("[name='religion']").val();
	console.log(religion_status);

	if(religion_status !='' && religion_status =='1')
	{
		
		$('.parish').css('display','none');
		$('.diocese').css('display','none');
		$('.horoscope').css('display','block');
		$('.manglik').css('display','block');
		$('.star').css('display','block');
		$('.gothra').css('display','block');
		$('.moonsign').css('display','block');
		$('#birthtime').css('display','block');
		$('.subcaste').css('display','block');
		$('.having_dosham').css('display','block');
		
	}
	else if(religion_status !='' && religion_status =='30')
	{
		$('.horoscope').css('display','none');
		$('.manglik').css('display','none');
		$('.birthtime').css('display','none');
		$('.star').css('display','none');
		$('.gothra').css('display','none');
		$('.moonsign').css('display','none');
		$('.subcaste').css('display','none');
		$('.having_dosham').css('display','none');
		$('.parish').css('display','block');
		$('.diocese').css('display','block');
		
	}
	else{
		$('.horoscope').css('display','none');
		$('.manglik').css('display','none');
		$('.birthtime').css('display','none');
		$('.star').css('display','none');
		$('.gothra').css('display','none');
		$('.moonsign').css('display','none');
		$('.having_dosham').css('display','none');
		$('.parish').css('display','none');
		$('.diocese').css('display','none');
		$('.subcaste').css('display','none');
	}
}
function PartReligionChange()
{
	

	var part_religion_status = $("#part_religion").val()==null?[]:$("#part_religion").val();

	
				$('.part_parish').css('display','none');
			 	$('.part_diocese').css('display','none');
			 	$('.part_manglik').css('display','none');
	 	        $('.part_star').css('display','none');
	 	        $('.part_gothra').css('display','none');
	 	        $('.part_moonsign').css('display','none');
	$.each(part_religion_status, function(key,value) {

	
	  switch(value){

	  	case '1':{
	  		
			 	$('.part_manglik').css('display','block');
	 	        $('.part_star').css('display','block');
	 	        $('.part_gothra').css('display','block');
	 	        $('.part_moonsign').css('display','block');

	  		break;
	  	}
	  	case '30':{
	  		$('.part_parish').css('display','block');
			 	$('.part_diocese').css('display','block');
			 		  		break;
	  	}
	  	case '3':{
	  		
	  		break;
	  	}
	  	default:{
	  		console.log("default");
	  	}
	  }
	}); 


}



function PhysicalChange(){
	//var physical_status = $("#physical_status").val();
	var physical_status = $("[name='physical_status']:checked").val();
	if(physical_status !='' && physical_status =='Yes'){
		$('.disabled_discription').css('display','block');
	}
	else{
		$('.disabled_discription').css('display','none');
	}
	//console.log(physical_status);
}
//PhysicalChange('physical_status')
function display_total_childern()
{
	var marital_status = $("[name='marital_status']:checked").val();
	//console.log(marital_status);
	if(marital_status !='' && marital_status !='Unmarried')
	{
		$("#total_children").removeAttr('disabled');
		display_childern_status();
	}
	else
	{
		$("#total_children").attr('disabled','disabled');
		$("#total_children").val('');
		$("[name='status_children']").prop('checked', false);
		$("[name='status_children']").attr('disabled','disabled');
	}
}
function display_childern_status()
{
	var total_children = $("#total_children").val();
	if(total_children !='' && total_children !='0')
	{
		//$("input[name='status_children']").attr('disabled', true);
		 $("[name='status_children']").removeAttr('disabled');
	}
	else
	{
		//$("input[name='status_children']").attr('disabled', false);
		$("[name='status_children']").attr('disabled','disabled');
		$("[name='status_children']").prop('checked', false);
	}
}
function check_valid_mobile_number(eleID,eleIDval)
{
	var mobile = $("#"+eleID).val();
	if(mobile !='' && mobile == 0)
	{
		alert("Please enter valid mobile number");
		$("#"+eleID).val('');
		return false;
	}
	if($("#country_code").length > 0 && $("#mobile_num").length > 0 )
	{
		var country_code = $("#country_code").val();
		var mobile_num = $("#mobile_num").val();
		var mobile_num_up = country_code+'-'+mobile_num;
		$("#"+eleIDval).val(mobile_num_up);
		
	}
}
function check_valid_number(ab)
{
	if(isNaN($(ab).val()))
	{
		$(ab).val('');
	}
}
function generate_sitemap(){
	var base_url = $("#base_url_admin_only").val();
	var action = base_url +'site-setting/generate-sitemap';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
		url: action,
		type: "post",
		data: {"csrf_new_matrimonial":hash_tocken_id},
		success:function(data)
		{
			hide_comm_mask();
			if(data=='success'){	
				alert('Sitemap Generated Successfully.');
			}
			$('#response_first_load').html(data);
			update_tocken(hash_tocken_id);
			$("#hash_tocken_id_temp").remove();
		}
	});
	return false;
}
function change_captcha_code(captcha_div_id,captcha_session)
{
	var base_url_admin = $("#base_url_main").val();
	var action = base_url_admin +'/common_request/change_captcha';
	var hash_tocken_id = $("#hash_tocken_id").val();
	show_comm_mask();
	$.ajax({
	   url: action,
	   type: "post",
	   data: {"csrf_new_matrimonial":hash_tocken_id,'captcha_session':captcha_session},
	   success:function(data)
	   {
		   $("#"+captcha_div_id).html(data);
			hide_comm_mask();
	   }
	});
}

function setDate_day(num_days)
{
	var b_date = $("#birth_date").val();
	//alert(b_date);
	var html_days = '<option value="" selected="">Day</option>';
	if(num_days !='' && num_days > 0)
	{
		for(var ij = 1;ij<=num_days;ij++)
		{
			var sell_date = '';
			if(b_date !='' && b_date == ij)
			{
				sell_date = 'selected';
			}
			html_days+= '<option '+ sell_date +' value="'+ij+'">'+ij+'</option>';
		}
		$("#birth_date").html(html_days);
	}
}
function month_year_change()
{
	var m_date = $("#birth_month").val();
	var y_date = $("#birth_year").val();
	var num_days = '';
	var update_date_ddr = 0;
	if(m_date !='')
	{
		num_days = numDays[m_date];
		if(num_days !='')
		{
			if(y_date !='' && y_date > 0 && y_date % 4 == 0 && num_days == 28)
			{
				num_days = 29;
			}
			setDate_day(num_days);
		}
	}
	return false;
}

