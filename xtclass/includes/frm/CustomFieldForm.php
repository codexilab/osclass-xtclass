<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

/*
 * Copyright 2014 Osclass
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Field.form.class.php
 */
class CustomFieldForm extends CustomForm
{

	/*public static function i18n_datePicker() { ?>
        <script>
        $.datepicker.regional['custom'] = { // Default regional settings
			closeText: '<?php echo osc_esc_js ( __('Done') ); ?>', // Display text for close link
			prevText: '<?php echo osc_esc_js ( __('Prev') ); ?>', // Display text for previous month link
			nextText: '<?php echo osc_esc_js ( __('Next') ); ?>', // Display text for next month link
			currentText: '<?php echo osc_esc_js ( __('Today') ); ?>', // Display text for current month link
			monthNames: ['<?php echo osc_esc_js ( __('January') ); ?>','<?php echo osc_esc_js ( __('February') ); ?>','<?php echo osc_esc_js ( __('March') ); ?>','<?php echo osc_esc_js ( __('April') ); ?>','<?php echo osc_esc_js ( __('May') ); ?>','<?php echo osc_esc_js ( __('June') ); ?>','<?php echo osc_esc_js ( __('July') ); ?>','<?php echo osc_esc_js ( __('August') ); ?>','<?php echo osc_esc_js ( __('September') ); ?>','<?php echo osc_esc_js ( __('October') ); ?>','<?php echo osc_esc_js ( __('November') ); ?>','<?php echo osc_esc_js ( __('December') ); ?>'], // Names of months for drop-down and formatting
			monthNamesShort: ['<?php _e('Jan'); ?>', '<?php _e('Feb'); ?>', '<?php _e('Mar'); ?>', '<?php _e('Apr'); ?>', '<?php _e('May'); ?>', '<?php _e('Jun'); ?>', '<?php _e('Jul'); ?>', '<?php _e('Aug'); ?>', '<?php _e('Sep'); ?>', '<?php _e('Oct'); ?>', '<?php _e('Nov'); ?>', '<?php _e('Dec'); ?>'], // For formatting
			dayNames: ['<?php echo osc_esc_js ( __('Sunday') ); ?>', '<?php echo osc_esc_js ( __('Monday') ); ?>', '<?php echo osc_esc_js ( __('Tuesday') ); ?>', '<?php echo osc_esc_js ( __('Wednesday') ); ?>', '<?php echo osc_esc_js ( __('Thursday') ); ?>', '<?php echo osc_esc_js ( __('Friday') ); ?>', '<?php echo osc_esc_js ( __('Saturday') ); ?>'], // For formatting
			dayNamesShort: ['<?php _e('Sun'); ?>', '<?php _e('Mon'); ?>', '<?php _e('Tue'); ?>', '<?php _e('Wed'); ?>', '<?php _e('Thu'); ?>', '<?php _e('Fri'); ?>', '<?php _e('Sat'); ?>'], // For formatting
			dayNamesMin: ['<?php _e('Su'); ?>','<?php _e('Mo'); ?>','<?php _e('Tu'); ?>','<?php _e('We'); ?>','<?php _e('Th'); ?>','<?php _e('Fr'); ?>','<?php _e('Sa'); ?>'], // Column headings for days starting at Sunday
			weekHeader: '<?php _e('Wk'); ?>', // Column header for week of the year
			dateFormat: 'dd/mm/yy', // See format options on parseDate
			firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
			isRTL: false, // True if right-to-left language, false if left-to-right
			showMonthAfterYear: false, // True if the year select precedes month, false for month then year
			yearSuffix: '' // Additional text to append to the year in the month headers
        };
        </script>
    <?php
    }

	/**
	 * @param        $id_field
	 * @param        $dateFormat
	 * @param        $value
	 * @param string $type
	 */
	public static function initDatePicker( $id_field , $dateFormat , $value , $type = 'none' ) {

        $orientation = ($type == 'to') ? 'bottom right' : 'bottom auto';

	    if ($value == '') $value = 0;

$aux = <<<FB
            <script>
            $(document).ready(function(){
                // setting datepicker
                $('.$id_field').datepicker({
                    orientation: "$orientation"
                });

                // when hide datepicker and change date on field
                $('.$id_field').on('hide changeDate', function() {
                    // format to unix timestamp
                    var fecha = $(this).datepicker('getDate');

                    if (fecha>0 && fecha!='') {
                        if ('$type'=='from') {
                            fecha.setHours('0');
                            fecha.setMinutes('0');
                            fecha.setSeconds('0');
                        } else if ('$type'=='to') {
                            fecha.setHours('23');
                            fecha.setMinutes('59');
                            fecha.setSeconds('59');
                        }

                        // new date format
                        var new_date = date('$dateFormat', fecha.getTime()/1000);

                        // hack - same dateformat as php date function
                        $('.$id_field').prop('value', new_date);
                        $('#$id_field').prop('value', fecha.getTime()/1000);
                    }
                });

                if($value>0 && $value!='') {
                    // hack - same dateformat as php date function
                    $('.$id_field').prop('value', date('$dateFormat', $value));
                    $('#$id_field').prop('value', '$value');
                }

                // clear hidden field when main field is empty
                $(".$id_field").change( function () {
                    if ($(".$id_field").prop('value') == '') {
                        $('#$id_field').prop('value', '');
                    }
                });
            });
            </script>
FB;

	    echo $aux;
	}

	/**
	 * @param null $field
	 * @param bool $search
	 */
	public static function meta( $field = null , $search = false ) {

        if($field!=null) {
            // date interval
            if( $field['e_type'] === 'DATEINTERVAL') {
                $field['s_value'] = array();
                $field['s_value']['from']   = '';
                $field['s_value']['to']     = '';

                if(!$search) {
                    $aInterval = Field::newInstance()->getDateIntervalByPrimaryKey($field['fk_i_item_id'], $field['pk_i_id']);

                    if(is_array($aInterval) && !empty($aInterval) ) {
                        $temp['from']       = @$aInterval['from'];
                        $temp['to']         = @$aInterval['to'];
                        $field['s_value']   = $temp;
                    }
                } else {
                    $_meta = Params::getParam('meta');
                    $temp['from']   = @(int)$_meta[$field['pk_i_id']]['from'];
                    $temp['to']     = @(int)$_meta[$field['pk_i_id']]['to'];
                    $field['s_value'] = $temp;
                }
            }
            // end date interval
            if( Session::newInstance()->_getForm('meta_'.$field['pk_i_id']) != '' ){
                $field['s_value'] = Session::newInstance()->_getForm('meta_'.$field['pk_i_id']);
            } else if(!isset($field['s_value']) || $field['s_value']=='') {
                $s_value = Params::getParam('meta');
                $field['s_value'] = '';
                if(isset($s_value[$field['pk_i_id']])) {
                    $field['s_value'] = $s_value[$field['pk_i_id']];
                }
            }

            if( $field['e_type'] === 'TEXTAREA' ) {
                if($search) {
                    echo '<h6>'.$field['s_name'].'</h6>';
                    echo '<input class="form-control form-control-light" id="meta_'.$field['s_slug'].'" type="text" name="meta['.$field['pk_i_id'].']" value="' . osc_esc_html((isset($field) && isset($field[ 's_value' ])) ? $field[ 's_value' ] : '' ) . '" />';
                } else {
		$field_textarea_value = isset($field[ 's_value' ]) ? $field[ 's_value' ] : '';
		$field_textarea_value = osc_apply_filter('osc_item_edit_meta_textarea_value_filter', $field_textarea_value, $field);
                    echo '<label for="meta_'.$field['s_slug'].'">'.$field['s_name'].': </label>';
                    echo '<textarea class="form-control form-control-light" id="meta_' . $field['s_slug'] . '" name="meta['.$field['pk_i_id'].']" rows="10">' . ((isset($field) && isset($field_textarea_value)) ? $field_textarea_value : '' ) . '</textarea>';
                }
            } else if( $field['e_type'] === 'DROPDOWN' ) {
                if($search) {
                    echo '<h3>'.$field['s_name'].'</h3>';
                } else {
                    echo '<h3><label for="meta_'.$field['s_slug'].'">'.$field['s_name'].': </label></h3>';
                }
                if(isset($field) && isset($field['s_options'])) {
                    $options = explode( ',' , $field['s_options']);
                    if(count($options)>0) {
                        echo '<select class="form-control form-control-light" name="meta['.$field['pk_i_id'].']" id="meta_' . $field['s_slug'] . '">';
                        if($search) {
                            echo '<option value="">'. __('Select', 'osclass')." ". $field['s_name'].'</option>';
                        }
                        foreach($options as $option) {
                            echo '<option value="'.osc_esc_html($option).'" '.($field['s_value']==$option?'selected="selected"':'').'>'.$option.'</option>';
                        }
                        echo '</select>';
                    }
                }
            } else if( $field['e_type'] === 'RADIO' ) {
                // radio at search page, becomes dropdown with radio options
                if($search) {
                    echo '<h3>'.$field['s_name'].'</h3>';
                    if(isset($field) && isset($field['s_options'])) {
                        $options = explode( ',' , $field['s_options']);
                        if(count($options)>0) {
                            foreach($options as $key => $option) {
                                echo '<label for="meta_' . $field['s_slug'] . '_'.$key.'"><input type="radio" name="meta['.$field['pk_i_id'].']" id="meta_' . $field['s_slug'] . '_'.$key.'" value="'.osc_esc_html($option).'"'.($field['s_value']==$option?' checked="checked"':'').' />'.$option.'</label><br/>';
                            }
                        }
                    }
                } else {
                    echo '<h3><label for="meta_'.$field['s_slug'].'">'.$field['s_name'].': </label></h3>';
                    if(isset($field) && isset($field['s_options'])) {
                        $options = explode( ',' , $field['s_options']);
                        if(count($options)>0) {
                            echo '<ul>';
                            foreach($options as $key => $option) {
                                echo '<li><input type="radio" name="meta['.$field['pk_i_id'].']" id="meta_' . $field['s_slug'] . '_'.$key.'" value="'.osc_esc_html($option).'"'.($field['s_value']==$option?' checked="checked"':'').' /><label for="meta_' . $field['s_slug'] . '_'.$key.'">'.$option.'</label></li>';
                            }
                            echo '</ul>';
                        }
                    }
                }
            } else if( $field['e_type'] === 'CHECKBOX' ) {
                if(isset($field) && isset($field['s_options'])) {
                	echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" name="meta['.$field['pk_i_id'].']" id="meta_' . $field['s_slug'] .'" value="1"'.((isset($field) && isset($field['s_value']) && $field['s_value']==1)?' checked="checked"':'').' />';
                    echo '<label class="form-check-label" for="meta_'.$field['s_slug'].'">'. $field['s_name'].' </label>';
                    echo '</div>';
                }
            } else if( $field['e_type'] === 'DATE' ) {
                if($search) {
                    echo '<h3>'.$field['s_name'].'</h3>';
                } else {
                    echo '<h3><label for="meta_'.$field['s_slug'].'">'.$field['s_name'].': </label></h3>';
                }
                // timestamp/1000 (javascript timestamp)
                echo '<input type="hidden" id="meta_'.$field['s_slug'].'" name="meta['.$field['pk_i_id'].']" value="" />';
                echo '<input type="text" id="" class="meta_'.$field['s_slug'].' cf_date form-control form-control-light" value="" />';
                self::initDatePicker( 'meta_' . $field[ 's_slug' ] , osc_date_format() , $field[ 's_value' ] );

            } else if( $field['e_type'] === 'DATEINTERVAL' ) {
                if($search) {
                    echo '<h3>'.$field['s_name'].'</h3>';
                } else {
                    echo '<label for="meta_'.$field['s_slug'].'">'.$field['s_name'].': </label>';
                }

                echo '<div class="row">';

                echo '<div class="col-6">';
                echo ucfirst(__('from')). ' ';
                echo '<input type="hidden" id="meta_'.$field['s_slug'].'_from" name="meta['.$field['pk_i_id'].'][from]" value="'.$field['s_value']['from'].'" />';
                echo '<input type="text" id="" class="meta_'.$field['s_slug'].'_from cf_date_interval form-control form-control-light" value="" />';
                self::initDatePicker( 'meta_' . $field[ 's_slug' ] . '_from' , osc_date_format() , $field[ 's_value' ][ 'from' ] , 'from' );
                echo '</div>';

                echo '<div class="col-6">';
                echo ' ' . ucfirst(__('to')). ' ';
                echo '<input type="hidden" id="meta_'.$field['s_slug'].'_to" name="meta['.$field['pk_i_id'].'][to]" value="'.$field['s_value']['to'].'" />';
                echo '<input type="text" id="" class="meta_'.$field['s_slug'].'_to cf_date_interval form-control form-control-light" value="" />';
                self::initDatePicker( 'meta_' . $field[ 's_slug' ] . '_to' , osc_date_format() , $field[ 's_value' ][ 'to' ] , 'to' );
                echo '</div>';

                echo '</div>';

            } else {
                if($search) {
                    echo '<h3>'.$field['s_name'].'</h3>';
                } else {
                    echo '<label for="meta_'.$field['s_slug'].'">'.$field['s_name'].': </label>';
                }
                echo '<input class="form-control form-control-light" id="meta_'.$field['s_slug'].'" type="text" name="meta['.$field['pk_i_id'].']" value="' . osc_esc_html((isset($field) && isset($field[ 's_value' ])) ? $field[ 's_value' ] : '' ) . '" />';
            }
        }
    }

	/**
	 * @param null $catId
	 *
	 * @return bool
	 */
	public static function meta_fields_search( $catId = null ) {
        // we received the categoryID
        if($catId == null) {
            return false;
        }

        $aCustomFields = array();
        // we check if the category is the same as our plugin
        foreach($catId as $id) {
            $aTemp = Field::newInstance()->findByCategory($id);
            foreach ($aTemp as $field) {
                if($field['b_searchable']==1) {
                    $aCustomFields[$field['pk_i_id']] = $field;
                }

            }
        }

        if(count($aCustomFields)>0) {
            foreach($aCustomFields as $field) {
            	echo '<div class="form-group">';
                self::meta( $field , true );
                echo '</div>';
            }
        }
    }

	/**
	 * @param null $catId
	 * @param null $itemId
	 */
	public static function meta_fields_input( $catId = null , $itemId = null ) {
        $fields = Field::newInstance()->findByCategoryItem($catId, $itemId);
        if(count($fields)>0) {
            foreach($fields as $field) {
                echo '<div class="form-group row meta">';
                echo '<div class="col-md-5 offset-md-4">';
                self::meta( $field );
                echo '</div>';
                echo '</div>';
            }
        }
    }
}