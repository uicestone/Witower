<?php
/**
 * 生成一组<option>
 * @param array $options 选项数组
 * @param string $checked 选中值
 * @param string $label select字段名提示文字，用于生成一个disabled的option
 * @param type $array_key_as_option_value
 * @param type $etc_option 显示一个“其他”选项，value为''
 * @param type $disable_empty_option 生成的字段名提示文字的option是否加disabled属性 用于chosen
 * @return string
 */
function options($options,$checked=NULL,$label=NULL,$array_key_as_option_value=false,$etc_option=false,$disable_empty_option=true){
	
	$options_html='';
	
	if(isset($label)){
		$options_html.='<option value=""'.($disable_empty_option?'disabled="disabled"':'').(is_null($checked)?' selected="selected"':'').">$label</option>";
	}
	
	foreach($options as $option_key=>$option){
		
		if(is_array($option)){
			$options_html.='<optgroup label="'.$option_key.'">';
			foreach($option as $option_key => $option){
				$value=$array_key_as_option_value?$option_key:$option;
				$options_html.='<option value="'.$value.'"'.($checked!==false && (is_array($checked)?in_array($value,$checked):$value==$checked)?' selected="selected"':'').'>'.$option.'</option>';
			}
			$options_html.='</optgroup>';
		}else{
			$value=$array_key_as_option_value?$option_key:$option;
			$options_html.='<option value="'.$value.'"'.($checked!==false && (is_array($checked)?in_array($value,$checked):$value==$checked)?' selected="selected"':'').'>'.$option.'</option>';
		}
	}
	
	if($etc_option){
		$options_html.='<option value="">其他</option>';
	}

	return $options_html;
}

/**
 * 生成一组个单选框
 */
function radio($options,$name,$checked,$array_key_as_option_value=false){
	$radio='';
	
	foreach($options as $option_key=>$option){
		$radio.='<label><input name="'.$name.'" value="'.($array_key_as_option_value?$option_key:$option).'" type="radio"'.($checked==($array_key_as_option_value?$option_key:$option)?' checked="checked"':'').' />'.$option.'</label>';
	}
	
	return $radio;
}

/**
 * 生成一个多选框
 */
function checkbox($label,$name,$check_value,$value=NULL,$attribute=''){
	if(is_null($value)){
		$value=$label;
	}
	return "<label><input name=\"$name\" type=\"checkbox\" value=\"$value\" ".($check_value==$value?'checked="checked"':'').' '.$attribute." />$label</label>";
}

/**
 * Form Value
 *
 * Grabs a value from the POST array for the specified field so you can
 * re-populate an input field or textarea.  If Form Validation
 * is active it retrieves the info from the validation class
 *
 * @access	public
 * @param	string
 * @return	mixed
 */
if ( ! function_exists('set_value'))
{
	function set_value($field = '', &$default = '')
	{
		
		!isset($default) && $default='';
		
		if (FALSE === ($OBJ =& _get_validation_object()) 
				// uicestone 2013/7/18 启用 form_validation类，但未对表单所有字段验证时，表单其他字段也可根据$_POST直接set_value
				|| !array_key_exists($field,$OBJ->_field_data)
			)
		{
			if ( ! isset($_POST[$field]))
			{
				return $default;
			}

			return form_prep($_POST[$field], $field);
		}

		return form_prep($OBJ->set_value($field, $default), $field);
	}
}
?>
