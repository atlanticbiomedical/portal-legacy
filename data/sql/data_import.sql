use atlbiomed_2_0;

delete from atlbiomed_2_0.location;

insert into atlbiomed_2_0.location (id, latitude, longitude, created_at, updated_at)
  select id, latitude, longitude, curdate(), curdate() from atlbiomed.location;

alter table atlbiomed_2_0.location auto_increment = 100000;

delete from atlbiomed_2_0.user;

insert into atlbiomed_2_0.user (id, user_name, first_name, last_name, email, phone, address, address_2,
                                    city, state, zip, password, start_time, end_time, created_at, updated_at, user_type_id, location_id)
  select id, user_name, first_name, last_name, email, phone, address, address_2, city, state, zip, password, start_time,
         end_time, curdate(), curdate(),
         case user_type
           when 'Technician' then 1
           else 2
         end,
         case location_id
           when '<null>' then null
           else null
         end
   from atlbiomed.user;

alter table atlbiomed_2_0.user auto_increment = 100000;

delete from atlbiomed_2_0.specification;

insert into atlbiomed_2_0.specification (id, device_name, manufacturer, model_number, created_at, updated_at)
  select id, device_name, manufacturer, model_number, curdate(), curdate() from atlbiomed.specification;

alter table atlbiomed_2_0.specification auto_increment = 100000;

delete from atlbiomed_2_0.device;

insert into atlbiomed_2_0.device (id, specification_id, client_id, serial_number, location, frequency, status, created_at, updated_at)
  select id, specification_id, client_id, serial_number, location, frequency, status, curdate(), curdate() from atlbiomed.device;

alter table atlbiomed_2_0.device auto_increment = 100000;

delete from atlbiomed_2_0.client;

insert into atlbiomed_2_0.client (id, location_id, client_identification, client_name, address, address_2, city, state, zip,
                                      attn, email, phone, ext, category, notes, created_at, updated_at)
  select id, location_id, client_identification, client_name, address, address_2, city, state, zip, attn, email, phone, ext, category,
         notes, curdate(), curdate() from atlbiomed.client;

alter table atlbiomed_2_0.client auto_increment = 100000;

 delete from atlbiomed_2_0.workorder;

 insert into atlbiomed_2_0.workorder (id, device_id, client_id, tech, office, job_status_id, page_number, travel_time, onsite_time,
                                       zip, date_recieved, date_completed, workorder_type_id, job_type_id, invoice, reason,
                                       action_taken, remarks, job_date, job_start, job_end, created_at, updated_at)
  select id, device_id, client_id, tech, office, 9, page_number, travel_time, onsite_time, zip, date_recieved, date_completed, 1,
          1, invoice, reason, action_taken, remarks, job_date, job_start, job_end, curdate(), curdate() from atlbiomed.workorder;

 alter table atlbiomed_2_0.workorder auto_increment = 100000;
