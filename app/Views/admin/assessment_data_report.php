<script>
function assessment_details(){
	var selMulti = $.map($("#assessement_name option:selected"), function (el, i) {
         return $(el).val();
    });
	var ass_select_ids=selMulti.join(",");
	if(ass_select_ids!=''){
		location.href=BASE_URL+"/admin/assessment_data_report?ass_id="+ass_select_ids;
	}
	
}
</script>

	<!--<div class="row">
		<div class="col-lg-12">
			 <div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">Search Parameters</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
				
					<div class="panel-body">
						<div class="col-md-12">
							
							<div class="col-lg-6">
								<div class="panel-heading">
									<div class="pull-left col-lg-4">
										<h6 class="panel-title txt-dark">Assessment Name :</h6>
									</div>
									<div class="pull-left">
										
										<select name="assessement_name[]" id="assessement_name" class="col-lg-12" multiple="multiple" data-placeholder="Choose" onchange="assessment_details();" style="width:150%">
										
										<optgroup label='Assessment Cycles'>
										<?php
										foreach($assessments as $assessment){
										$zone=isset($_REQUEST['ass_id'])?explode(",",$_REQUEST['ass_id']):array();
										$program_sel=in_array($assessment['assessment_id'],$zone)?"selected='selected'":"";
										?>
										<option value='<?php echo $assessment['assessment_id'];?>' <?php echo $program_sel; ?>><?php echo $assessment['assessment_name'];?></option>	
										<?php
										}
										?>	
										</optgroup>
										
										</select>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
	</div>-->
	<?php 
	if(!empty($ass_id)){
	?>
	<div id="idexceltable">	
		<table id='repheader' style='width:99%' align='center' class='table table-striped table-bordered table-hover'>
			<thead>
			<?php $total_count=(count($comp_data)*5); ?>
				<tr>
					<td nowrap>S.No</td>
					<td nowrap>Employee Code</td>
					<td nowrap>Employee Name</td>
					<td nowrap>Grade Code</td>
					<td nowrap>Designation</td>
					<td nowrap>Grade</td>
					<td nowrap>Location</td>
					<td nowrap>Solar/Wind</td>
					<td nowrap>Work Scope</td>
					<td nowrap>Assessment Position</td>
					<th colspan="<?php echo $total_count; ?>">Competency</th>
					
				</tr>
				<tr>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
				<?php 
				foreach($comp_data as $comp_datas){
				?>
					<th colspan="5"><?php echo $comp_datas['comp_def_name']; ?></th>
					
				<?php 
				}
				?>
				</tr>
				
				<tr>
				<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
					<td nowrap></td>
				<?php 
				foreach($comp_data as $comp_datas){
				?>
					<th>Level</th>
					<th>Criticality</th>
					<th>MCQ</th>
					<th>Inbasket</th>
					<th>Casestudy</th>
				<?php } ?>
				</tr>
				
			</thead>
			<?php 
			foreach($emp_data as $key=>$emp_datas){
			?>
			<tr>
				
				<td><?php echo ($key+1);?></td>
				<td><?php echo $emp_datas['employee_number'];?></td>
				<td><?php echo $emp_datas['full_name'];?></td>
				<td><?php echo $emp_datas['subgradename'];?></td>
				<td><?php echo $emp_datas['position_name'];?></td>
				<td><?php echo @$emp_datas['grade_name'];?></td>
				<td><?php echo @$emp_datas['location_name'];?></td>
				<td><?php echo @$emp_datas['bu'];?></td>
				<td><?php echo $emp_datas['org_name'];?></td>
				<td><?php echo $emp_datas['ass_position_name'];?></td>
				<?php 
				foreach($comp_data as $comp_datas){
					?>
					<td><?php echo !empty($comp_datas['scale_name'])?$comp_datas['scale_name']:"-";?></td>
					<td><?php echo !empty($comp_datas['comp_cri_name'])?$comp_datas['comp_cri_name']:"-";?></td>
					<td>
					<?php 
					/* $ass_test=UlsAssessmentTest::get_ass_position($ass_id,$emp_datas['position_id'],'TEST');
					if(!empty($ass_test['assess_test_id'])){
						$correct_total=UlsUtestResponsesAssessment::question_count_correct_total($ass_id,$ass_test['assess_test_id'],$ass_test['test_id'],$emp_datas['employee_id'],$comp_datas['comp_def_id']);
						$correct_ans=UlsUtestResponsesAssessment::question_count_correct_count($ass_id,$ass_test['assess_test_id'],$ass_test['test_id'],$emp_datas['employee_id'],$comp_datas['comp_def_id']);
						echo $total_per=!empty($correct_ans['correct_flag'])?(round((($correct_ans['correct_flag']/$correct_total['tot_count'])*100),2)."%"):"";
					}
					else{
						echo "-";
					} */
					$ass_comp_test=UlsAssessmentReport::admin_position_assessed_competency_level_test_report($ass_id,$emp_datas['position_id'],$comp_datas['comp_def_id'],$comp_datas['assessment_pos_level_scale_id'],$emp_datas['employee_id']);
					echo !empty($ass_comp_test['ass_ave'])?round($ass_comp_test['ass_ave'],2):"-";
					?>
					</td>
					<td>
					<?php
					$ass_comp_inbasket=UlsAssessmentReport::admin_position_assessed_competency_level_inbasket_report($ass_id,$emp_datas['position_id'],$comp_datas['comp_def_id'],$comp_datas['assessment_pos_level_scale_id'],$emp_datas['employee_id']);
					echo !empty($ass_comp_inbasket['ass_ave'])?round($ass_comp_inbasket['ass_ave'],2):"-";
					?>
					</td>
					<td>
					<?php
					$ass_comp_case=UlsAssessmentReport::admin_position_assessed_competency_level_case_report($ass_id,$emp_datas['position_id'],$comp_datas['comp_def_id'],$comp_datas['assessment_pos_level_scale_id'],$emp_datas['employee_id']);
					echo !empty($ass_comp_case['ass_ave'])?round($ass_comp_case['ass_ave'],2):"-";
					?>
					</td>
				<?php
				}
				?>
			</tr>
			<?php
			}
			?>
		</table>
					
			
	</div>
	<div align='left' style='padding:10px;'>
		
		<a class='btn btn-sm btn-success' href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."&ExportType=export-to-excel"; ?>">Export To Excel</a>
	</div>
	<?php
	}?>
