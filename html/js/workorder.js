function update_stat(id,body){
   $(id).innerHTML = body;
}
function updateWorkorder(id){

  invoice_num = $('invoice_num').value;
  action_taken = $('action').value;
  remarks = $('remarks_y').value;
  job_status = $('job_status').value;
  job_type = $('job_type').value;
  reason_select = $('reason_select_y').value;
  onsite_time = $('onsite_time').value;
  travel_time = $('travel_time').value;
  wid = $('wid').value;
  travel_service = $('travel_service').value;
  zone_charge = $('zone_charge_y').value;
  salestax = $('salestax').value;
  shipping = $('shipping').value;
  totalcost = $('totalcost').value;  
  cid = $('cid').value; 
  print_name = $('print_name').value; 
  
  str = "?invoice_num="+invoice_num+"&action_taken="+action_taken
       +"&remarks="+remarks+"&job_status="+job_status+"&job_type="+job_type
       +"&reason_select="+reason_select+"&onsite_time="+onsite_time+"&travel_time="+travel_time
       +"&wid="+wid+"&zone_charge="+zone_charge+"&salestax="+salestax+"&shipping="+shipping
       +"&travel_service="+travel_service+"&cid="+cid+"&print_name="+print_name;
  new Ajax.Updater('res','/index.php/workOrder/updateworkorder',
   {
     method: 'post',
     evalScripts: true,
     parameters: str,
     onSuccess: function(){
   }
 });
}

