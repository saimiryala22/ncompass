<style>
.value{
	display: block;
    position: relative;
    padding: 4px 8px;
    width: 100%;
    font-size: 14px;
    resize: none;
    border: 1px solid #CCC;
    background-color: #FAFAFA;
    outline: none;
}
.radio_space{
	padding-right:20px;
}
</style>
<script>
$(document).ready(function(){
	$("#feedback").validationEngine();
	
});
function open_skip_button(){
	var position_id=document.getElementById('position_id').value;
	var assessment_pos_id=document.getElementById('assessment_pos_id').value;
	var assessment_id=document.getElementById('assessment_id').value;
	var asstype=document.getElementById('asstype').value;
	var pro=document.getElementById('pro').value;
	var jid=document.getElementById('jid').value;
	var emp_id=document.getElementById('emp_id').value;
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			//document.getElementById('text').innerHTML=xmlhttp.responseText;
			window.location.href =BASE_URL+"/employee/employee_assessment_details?jid="+jid+"&pro="+pro+"&asstype="+asstype+"&assessment_id="+assessment_id+"&position_id="+position_id+"&assessment_pos_id="+assessment_pos_id; 
		}
	}
	xmlhttp.open("GET",BASE_URL+"/employee/employee_feedback_skip?position_id="+position_id+"&assessment_pos_id="+assessment_pos_id+"&assessment_id="+assessment_id+"&asstype="+asstype+"&pro="+pro+"&jid="+jid,true);
	xmlhttp.send();
}
</script>
<section class="main-section">
	<div class="container">
		<div class="row">
			<!-- TEST SECTION :BEGIN -->
			<div class="test-section">
				<form action='<?php echo BASE_URL;?>/employee/employee_feedback_insert' method='post' name='feedback' id='feedback' enctype='multipart/form-data'>
				<input type='hidden' name='position_id' id='position_id' value="<?php echo $_REQUEST['position_id'];?>"/>
				<input type='hidden' name='assessment_pos_id' id='assessment_pos_id' value="<?php echo $_REQUEST['assessment_pos_id'];?>" />
				<input type='hidden' name='emp_id' id='emp_id' value="<?php echo $_SESSION['emp_id'];?>" />
				<input type='hidden' name='assessment_id' id='assessment_id' value="<?php echo $_REQUEST['assessment_id'];?>" />
				<input type='hidden' name='asstype' id='asstype' value="<?php echo $_REQUEST['asstype'];?>" />
				<input type='hidden' name='pro' id='pro' value="<?php echo $_REQUEST['pro'];?>" /> 
				<input type='hidden' name='jid' id='jid' value='<?php echo $_REQUEST['jid']; ?>' />
				<input type='hidden' name='feed_id' id='feed_id' value='' />
				<!-- TEST HEAD SECTION :BEGIN -->
				<div class="test-head-section">
					<div class="d-flex align-items-center justify-content-between">
						<div class="test-head">
							<div class="icon material-icons">assignment_turned_in</div>
							<div class="test-info">
								<div class="test-name">Feedback</div>
								<p class="test-content">*Your Feedback is valuable to us. Please spare a few mins to fill this.</p>
							</div>
						</div>
						
					</div>
				</div>
				<!-- TEST BODY :BEGIN -->
				<div class="">
					<div class="row">
						<div class="col-6">
							<div class="test-body">
								<!--<div class="question-title">1.) How did you find the overall process</div>-->
								<div class="question-title">1.) How do you rate this process for assessing the techincal competencies of your team?(आप कैसे रेटिंग देते हैं! आपकी टीम की तकनीकी दक्षताओं का आकलन करने के लिए यह प्रक्रिया?)</div>
								
								<div class="space-20"></div>

								<div class="answer-section">
									<input id="ans-ac" type="radio" name="Q1" value="1" class="validate[required] radio-control">
									<label for="ans-ac" class="label">Poor/ख़राब</label>
									<span class="radio_space"></span>
									<input id="ans-abc-c" type="radio" name="Q1" value="2" class="validate[required] radio-control">
									<label for="ans-abc-c" class="label">Average/औसत</label>
									<span class="radio_space"></span>
									<input id="ans-abcd" type="radio" name="Q1" value="3" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Good/अच्छा</label>
									<span class="radio_space"></span>
									<input id="ans-noneg" type="radio" name="Q1" value="4" class="validate[required] radio-control">
									<label for="ans-noneg" class="label">Very Good/बहुत अच्छा</label>
									<span class="radio_space"></span>
									<input id="ans-none" type="radio" name="Q1" value="5" class="validate[required] radio-control">
									<label for="ans-none" class="label">Excellent/उत्कृष्ट</label>
								</div>
							</div>
							<div class="test-body">
								<div class="question-title">2.) How do you rate each of the Methods used(आप कैसे रेटिंग देते हैं प्रयुक्त विधियों का)</div>
								<?php
								foreach($ass_test as $ass_tests){
									if($ass_tests['assessment_type']=='TEST'){
								?>
								<b>MCQs(एमसीक्यू)</b>
								<div class="space-20"></div>

								<div class="answer-section">
									<input id="ans-ac1" type="radio" name="Q21" value="1" class="validate[required] radio-control">
									<label for="ans-ac" class="label">InAppropriate(अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abc2" type="radio" name="Q21" value="2" class="validate[required] radio-control">
									<label for="ans-abc2" class="label">Neither App. or InApp(न तो उपयुक्त या अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd3" type="radio" name="Q21" value="3" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Appropriate(उचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd4" type="radio" name="Q21" value="4" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Not Applicable(लागू नहीं है)</label>
								</div>
								<?php 
								}
								elseif($ass_tests['assessment_type']=='INBASKET'){
								?>
								<b>Inbasket(इनबास्केट)</b>
								<div class="space-20"></div>

								<div class="answer-section">
									<input id="ans-ac-1" type="radio" name="Q22" value="1" class="validate[required] radio-control">
									<label for="ans-ac" class="label">InAppropriate(अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abc-2" type="radio" name="Q22" value="2" class="validate[required] radio-control">
									<label for="ans-abc-2" class="label">Neither App. or InApp(न तो उपयुक्त या अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd-3" type="radio" name="Q22" value="3" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Appropriate(उचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd-4" type="radio" name="Q22" value="4" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Not Applicable(लागू नहीं है)</label>
								</div>
								<?php 
								}
								elseif($ass_tests['assessment_type']=='CASE_STUDY'){
								?>
								<!--<b>3. Casestudy</b>-->
								<b>Casestudy(मामले का अध्ययन)</b>
								<div class="space-20"></div>

								<div class="answer-section">
									<input id="ans-ac_1" type="radio" name="Q23" value="1" class="validate[required] radio-control">
									<label for="ans-ac" class="label">InAppropriate(अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abc_2" type="radio" name="Q23" value="2" class="validate[required] radio-control">
									<label for="ans-abc_2" class="label">Neither App. or InApp(न तो उपयुक्त या अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd_3" type="radio" name="Q23" value="3" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Appropriate(उचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd_4" type="radio" name="Q23" value="4" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Not Applicable(लागू नहीं है)</label>
								</div>
								<?php 
								}
								elseif($ass_tests['assessment_type']=='DEFECT'){
								?>
								<b>Spot the Defect</b>
								<div class="space-20"></div>

								<div class="answer-section">
									<input id="ans-ac_1" type="radio" name="Q24" value="1" class="validate[required] radio-control">
									<label for="ans-ac" class="label">InAppropriate(अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abc22" type="radio" name="Q24" value="2" class="validate[required] radio-control">
									<label for="ans-abc22" class="label">Neither App. or InApp(न तो उपयुक्त या अनुचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd_3" type="radio" name="Q24" value="3" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Appropriate(उचित)</label>
									<span class="radio_space"></span>
									<input id="ans-abcd_4" type="radio" name="Q24" value="4" class="validate[required] radio-control">
									<label for="ans-abcd" class="label">Not Applicable(लागू नहीं है)</label>
								</div>
							<?php 
								}
							}
							?>
							</div>
						</div>
						<div class="col-6">
							<div class="test-body">
								<div class="question-title">3.) If you have to take a person reporting to you (new hire) would you think that a similar process at a time of recuitment/hiring, would you enhance the process(यदि आपको अपने पास रिपोर्ट करने वाले किसी व्यक्ति (नए कर्मचारी) को ले जाना है तो क्या आप सोचेंगे कि भर्ती/भर्ती के समय भी ऐसी ही प्रक्रिया होगी, तो क्या आप इस प्रक्रिया को बढ़ाएंगे?)</div>
								
								<div class="space-20"></div>

								<div class="answer-section">
									<input id="ans-ac-y" type="radio" name="Q3" value="1" class="validate[required] radio-control">
									<label for="ans-ac-y" class="label">Yes/हाँ</label>
									<span class="radio_space"></span>
									<input id="ans-abc-n" type="radio" name="Q3" value="2" class="validate[required] radio-control">
									<label for="ans-abc-n" class="label">No/नहीं</label>
								
									
								</div>
							</div>
							<div class="test-body">
								<div class="question-title">4.) Any Other Feedback or Comments on the process, so as to improve/refine it(प्रक्रिया पर कोई अन्य प्रतिक्रिया या टिप्पणियाँ, ताकि इसे सुधार/परिष्कृत किया जा सके)</div>
								
								<div class="space-20"></div>

								<div class="answer-section">
									<textarea rows="4" class="validate[required,minSize[10]] value" name="Q4" data-prompt-position='topLeft'></textarea>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- TEST BODY :END -->

				<div class="test-footer d-flex align-items-center justify-content-between">
					<!--<div>
						<a href="#" class="btn btn-primary" onclick="open_skip_button();">Skip</a>
					</div>-->
					<div>
						<button class='btn btn-primary' type="submit" id='submit_ass'>Submit</button>
					</div>
				</div>
				</form>
			</div>
			<!-- TEST SECTION :END -->
		</div>
	</div>
</section>

	