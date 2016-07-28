<?php 

$need=array_flip(array('CONTACT','PHONE','EMAIL','PRICE'));
if(isset($account['custom_fields'],$account['custom_fields']['leads']))
  do
  {
    foreach($account['custom_fields']['leads'] as $field)
    if(is_array($field) && isset($field['id']))
      {
        if(isset($field['code']) && isset($need[$field['code']]))   //&& isset($need[$field['code']])
          $fields[$field['code']]=(int)$field['id'];
           }
                 }

            while(false);
     /*  
        $diff=array_diff_key($need,$fields);
        if(empty($diff))
          break 2;

      if(isset($diff))
        die('В amoCRM отсутствуют следующие поля'.': '.join(', ',$diff));
      else
        die('Невозможно получить дополнительные поля');
    }
  while(false);
else
  die('Невозможно получить дополнительные поля'); */
$custom_fields=isset($fields) ? $fields : false;

 ?>