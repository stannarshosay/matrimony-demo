<?php
$plan_name ='';
if(isset($user_agent) && $user_agent == 'NI-AAPP'){
	if(isset($plan_data['plan_name']) && $plan_data['plan_name']!=''){
		$plan_name = $plan_data['plan_name'];
	}
	$order_id = 'Membership Plan - '.$plan_name;
	$p_plan = $this->input->post('plan_id');
	$user_id = $this->input->post('user_id');
}else{

	if(isset($plan_data['plan_name']) && $plan_data['plan_name']!=''){
		$plan_name = $plan_data['plan_name'];
	}

	$order_id = 'Membership Plan - '.$plan_name;
	$plan_data_array = $plan_data['plan_data_array'];
	$p_plan = $plan_data['plan_id'];
}
//print_r($plan_data);
$total = $plan_data['total_pay'];
$cust_name = "";
$cust_email = "";
if(isset($get_user_data['username']) && $get_user_data['username']!=''){
	$cust_name = $get_user_data['username'];
}
if(isset($get_user_data['email']) && $get_user_data['email']!=''){
	$cust_email = $get_user_data['email'];
}
$cust_number = '';
if(isset($get_user_data['mobile']) && $get_user_data['mobile'] !='')
{
	$mo_arr = explode('-',$get_user_data['mobile']);
	$cust_number = $mo_arr[1];
}
$_POST['amount'] = $total;
$_POST['firstname'] = $cust_name;
$_POST['email'] = $cust_email;
$_POST['phone'] = $cust_number;
$_POST['productinfo'] = $order_id;
$total_new = ($total*100);
$amount = $total;
if(isset($user_agent) && $user_agent == 'NI-AAPP'){
	$matri_id='';
	if(isset($user_id) && $user_id != ''){
		$matri_id = $user_id;
	}
	$_POST['surl'] = $base_url.'premium-member/payment-success-mobile-app/'.$matri_id.'/'.$p_plan;
	$_POST['furl'] = $base_url.'premium-member/payment-fail-mobile-app';
	$return_url = $base_url.'premium-member/payment-success-mobile-app/'.$matri_id.'/'.$p_plan;
}else{
	$_POST['surl'] = $base_url.'premium-member/payment-status/RazorPay';
	$_POST['furl'] = $base_url.'premium-member/payment-status/fail';
	$return_url = $base_url.'premium-member/payment-status/RazorPay';
}
$posted = array();
$txnid = '';
if($this->input->post('razorpay_payment_id')!=''){
	$txnid = $this->input->post('razorpay_payment_id');
}
?>
<form name="razorpayform" id="razorpayform" action="<?php echo $return_url; ?>" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="<?php echo $txnid;?>" />
    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $order_id; ?>"/>
    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
    <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $_POST['productinfo']; ?>"/>
    <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $_POST['surl']; ?>"/>
    <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $_POST['furl']; ?>"/>
    <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $_POST['firstname']; ?>"/>
    <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total_new; ?>"/>
    <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id" >
</form>
<?php //exit;?>
<script language='javascript'>document.razorpayform.submit();</script>