<?php
function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
 $path = BASE_URL.'/public/reports/graphs/full/'.$_REQUEST['ass_id'].'/'.$_REQUEST['emp_id'].'_'.$_REQUEST['pos_id'].'_radar.svg';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = url_get_contents($path);
 $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
 
$path1 = BASE_URL.'/public/reports/graphs/full/'.$_REQUEST['ass_id'].'/over_all'.$_REQUEST['emp_id'].'_'.$_REQUEST['pos_id'].'.svg';
$type1 = pathinfo($path1, PATHINFO_EXTENSION);
$data1 = url_get_contents($path1);
$base64_new = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

?>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  
  <title>Employee Single page Assessment Report</title>
  
  <style type="text/css">
	@page {
	  margin: 0;font-family: "Helvetica,sans-serif" !important;
	}
	html { margin: 0px;font-family: "Helvetica,sans-serif" !important;}
	.flyleaf {
		page-break-after: always;
		z-index: -1;
		margin-top: -2.5cm !important;
		font-family: "Helvetica,sans-serif" !important;
	}
	body{
		margin:0px;
		padding:0px;
		margin-top: 2.2cm !important;
		
		font-family: "Helvetica,sans-serif" !important;
		font-size: 14px;
	}
	div.body {
		margin-left: 1.5cm !important;
		margin-right: 1.5cm !important;
		color:#000;
		font-family: "Helvetica,sans-serif" !important;
		font-size: 14px;
	}
	#overlay {
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		margin:0px;
		padding:0px;
		margin-top: -2.5cm !important;
		background-position: left top;
		background-repeat: no-repeat;
		z-index: -1;
	}
	#overlay2 {
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		margin:0px;
		padding:0px;
		margin-top: -2.5cm !important;
		background-position: left top;
		background-repeat: no-repeat;
		z-index: 9999;
	}
	
	div.header{
		position: fixed;
		background: #fff;
		color:#fff;
		width: 100%;
		border-bottom:1px solid #010F3C;
		overflow: hidden;
		margin-left: 1cm;
		margin-right: 1cm;
		top: 0px;
		left:0cm;
		height:2cm;
	}
	div.footer {
		position: fixed;
		background: #fff;
		color:#fff;
		width: 100%;
		border-top:1px solid #010F3C;
		overflow: hidden;
		margin-left: 1cm;
		margin-right: 1cm;
		bottom: 0px;
		left:0px;
		height:1cm;
	}
	
	div.leftpane {
		position: fixed;
		background: #fff;
		width: 1cm;
		border-right: 1px solid #010F3C;
		top: 0cm;
		left: 0cm;
		height: 30cm;
	}
	
	div.rightpane {
		position: fixed;
		background: #fff;
		width: 1cm;
		border-left: 1px solid #010F3C;
		top: 0cm;
		right: 0cm;
		height: 30cm;
	}

	
	div.footer table {
	  width: 100%;
	  text-align: center;
	}
	
	hr {
	  page-break-after: always;
	  border: 0;
	}
	table{
		width:100%;
		border-collapse: collapse;
		font-family: "Helvetica,sans-serif" !important;
		color:#000;
		font-size: 12px;
    }
    thead th{
		text-align: left;
		padding: 5px;
		border: 1px solid #e3e3e3;
		font-family: "Helvetica,sans-serif" !important;
		font-size: 11px;
		text-align: left;
    }
    tbody td{
		border: 1px solid #e3e3e3;
		padding: 5px;
		font-family: "Helvetica,sans-serif" !important;
		color:#000;
		font-size: 11px;
		
    }
    /*tbody tr:nth-child(even){
		background: #F6F5FA;
    }
    tbody tr:hover{
		background: #EAE9F5
    }*/
	
	div.test {
		color: #000;
		background-color: #FFF;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: #BC6F74;
		font-family: "Helvetica,sans-serif" !important;
		
	}
	p#second {
        color: rgb(00,63,127);
        font-family: times;
        font-size: 12pt;
        text-align: justify;
    }
	.fish { position: absolute; top: 570px; left: 150px; }
	.fish1 { position: absolute; top: 300px; left: 100px; text-align:left;}
	.fish5 { position: absolute; top: 20px; text-align:right;right: 20px;}
	.headinfo { 
	   position: absolute; 
	   bottom: 200px; 
	   left: 0; 
	   width: 100%; 
	}
	.card-view.panel.panel-default > .panel-heading {
		background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
		border-bottom: 2px solid #eee;
	}
	.card-view.panel > .panel-heading {
		border: medium none;
		border-radius: 0;
		color: inherit;
		margin: -28px -15px 0;
		padding: 0px 15px;
	}
	h6, .panel-title {
		font-size: 16px;
		font-weight: 600;
		line-height: 24px;
		text-transform: capitalize;
		font-family: "Helvetica,sans-serif" !important;
	}
	.card-view {
		background: #fff none repeat scroll 0 0;
		border: medium none;
		border-radius: 0;
		box-shadow: 0 1px 11px rgba(0, 0, 0, 0.09);
		margin-bottom: 10px;
		margin-left: -10px;
		margin-right: -10px;
		padding: 15px 15px 0;
	}
	.card-view.panel .panel-body {
		padding: 20px 0;
	}
	p,span{
		font-size: 12px;
		line-height: 15px;
		font-family: "Helvetica,sans-serif" !important;
	}
	ol li {
		font-size: 12px;
		padding:0px;
		font-family: "Helvetica,sans-serif" !important;
	}
	ul li {
		font-size: 12px;
		padding:0px;
		font-family: "Helvetica,sans-serif" !important;
	}
	.title {
		border: 1px solid transparent;
		border-radius: 0.25rem;
		margin-bottom: 1rem;
		padding: 0.60rem 1.25rem;
		position: relative;
		border-color: #b8daff;
		background: #0077d3 none repeat scroll 0 0;
		color: #fff;
		
	}
	.titleheader {
		border: 1px solid #734021;
		border-radius: 0.25rem;
		margin-bottom: 0.5rem;
		padding: 0.40rem 1.20rem;
		position: relative;
		border-color: #734021;
		font-weight:bold;
		
	}
	.row.header {
		background: #ea6153 none repeat scroll 0 0;
		color: #ffffff;
		font-weight: 900;
	}
	#header {
		position: relative;
		left: auto;
		right: auto;
		width: 59%;
		float: right;
		padding:0px 18px 0px 0px;
	}

	#main-content {
		left: auto;
		right: auto;
		position: relative;
		width: 40%;
		float: right;
		padding:10px;

	}
	
	hr.style-one {
		border: 0;
		height: 1px;
		background: #333;
	}
	
  </style>
  
</head>


<body class="body">
	<div class="leftpane">
	  <div style="text-align: center;"></div>
	</div>
	<div class="rightpane">
	  <div style="text-align: center;"></div>
	</div>
	<div class="header">
		<img src="<?php echo LOGO_IMG; ?>" style="float:right;margin:0.15cm 0.2cm" width="150" height="54"> 
		
	</div>

	<div class="footer">
	  <div style="text-align: right;color:#000;margin-right:50px;font-size: 10px;font-family: Helvetica,sans-serif !important;">www.N-Compas.com</div>
	</div>

	<?php 
	$results=$assessor=$comname=$comp_id=array();
	foreach($ass_results as $key1=>$result){
		$comp_id[$result['comp_def_id']]="C".($key1+1);
		$comname[$result['comp_def_id']]=$result['comp_def_name'];
	}
	?>
	<div class="body">
		<h4 style="text-align:center;padding-left:20px;">Summary Assessment Report of <b style="font-size:14pt;"><?php echo $emp_info['name']; ?></b></h4>
		<table cellspacing="0" cellpadding="5" style="border:1px solid #36a2eb;">
			<tr bgcolor="#f1f1f1">
				
				<td>Designation:<br><b><?php echo $emp_info['position_name']; ?></b></td>
				<td>Grade:<br><b><?php echo $emp_info['grade_name']; ?></b></td>
				<td>Department:<br><b><?php echo $emp_info['org_name']; ?></b></td>
				<td>Location:<br><b><?php echo $emp_info['location_name']; ?></b></td>
			</tr>
		</table>
		
		<h4 class="titleheader" style="font-size:9pt;"><b style="font-size:9pt;">A. Competency Radar Graph</b></h4>
		<p>Competency Radar Graph is the graphical representation of the relative information – between what is required of the job and what you posses.</p>
		<table width="100%">
			<tbody>
				<tr>
					<td width="50%"><img src="<?php echo $base64;?>" style="width:310px;height:290px;padding-top:10px; "/></td>
					<td width="50%" align="top">
						<?php 
						$val_self=array_combine($comp_id,$comname);
						//print_r($val_self);
						foreach($val_self as $key => $val_selfs){
							echo $key."-".$val_selfs."<br>";
						}
						
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<h4 class="titleheader"  style="font-size:9pt;"><b style="font-size:9pt;">B. Assessment Summary</b></h4>
		<p>In order to help you get a better understanding on the outcome of the assessment process, the various methods have been converted into numeric values. </p>
		<table width="100%">
			<thead>
				<tr class="row header">
					<th width="5%">S.No</th>
					<th width="20%">Assessment Method</th>
					<th width="15%">Total Question</th>
					<th width="15%">Answered Correctly/Rating</th>
					<th width="20%">Percentage Scored (%)</th>
					<th width="25%">Weightage for Assessment Method (%)</th>
					<th width="20%">Weighted Score</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$results=array();
			foreach($assessor_rating_new as $assessor_rating_news){
				$finalval=!empty($assessor_rating_news['assessor_val'])?round(($assessor_rating_news['rat_num']*$assessor_rating_news['assessor_val']),2):$assessor_rating_news['rat_num'];
				$results[$assessor_rating_news['assessment_type']]['assessment_type']=$assessor_rating_news['assessment_type'];
				$results[$assessor_rating_news['assessment_type']]['assess_type']=$assessor_rating_news['assess_type'];
				$results[$assessor_rating_news['assessment_type']]['weightage']=$assessor_rating_news['weightage'];
				$results[$assessor_rating_news['assessment_type']]['test_ques']=$assessor_rating_news['test_ques'];
				$results[$assessor_rating_news['assessment_type']]['test_score']=$assessor_rating_news['test_score'];
				$results[$assessor_rating_news['assessment_type']]['rating_scale']=$assessor_rating_news['rating_scale'];
				$results[$assessor_rating_news['assessment_type']]['assessor'][$assessor_rating_news['assessor_id']]=$finalval;
			}
			$i=1;
			$score='';
			$wei_sum=0;
			$wei_total=0;
			foreach($results as $key1=>$assessor_ratings){
				$wei_sum=($wei_sum+$assessor_ratings['weightage']);
				?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php 
					$ast=($assessor_ratings['assessment_type']!='TEST')?'<sup><font color="#FF0000">*</font></sup>':"";
					
					echo $assessor_ratings['assess_type']; echo $ast; ?></td>
					<td><?php
					if($assessor_ratings['assessment_type']=='TEST'){
						echo $assessor_ratings['test_ques'];
					}
					else{
						echo "NA";
					} 
					?></td>
					<td><?php
					if($assessor_ratings['assessment_type']=='TEST'){
						$score_test=$assessor_ratings['test_score'];
						echo $score_test_f=$score_test;
					}
					else{
						$final=0;
						foreach($assessor_ratings['assessor'] as $key2=>$ass_id){
							$final=$final+$results[$key1]['assessor'][$key2];
						}
						$final=round($final/count($results[$key1]['assessor']),2);
						$score=round($final,2);
						echo $score_f=$score;
					} 
					?></td>
					<td><?php
					if($assessor_ratings['assessment_type']=='TEST'){
						echo $score_test=(($assessor_ratings['test_score']/$assessor_ratings['test_ques'])*100);
					}
					else{
						$final=0;
						foreach($assessor_ratings['assessor'] as $key2=>$ass_id){
							$final=$final+$results[$key1]['assessor'][$key2];
						}
						$final=round($final/count($results[$key1]['assessor']),2);
						echo $score=(($final/$assessor_ratings['rating_scale'])*100);
					} 
					?></td>
					<td><?php echo $assessor_ratings['weightage']; ?></td>
					<td><?php
					$score_final=$scorefinal=0;
					if($assessor_ratings['assessment_type']=='TEST'){
						$score_test=(($assessor_ratings['test_score']/$assessor_ratings['test_ques'])*100);
						$wei=$assessor_ratings['weightage'];
						echo $score_final=round((($score_test*$wei)/100),2);
					}
					else{
						$final=0;
						foreach($assessor_ratings['assessor'] as $key2=>$ass_id){
							$final=$final+$results[$key1]['assessor'][$key2];
						}
						$final=round($final/count($results[$key1]['assessor']),2);
						$score=(($final/$assessor_ratings['rating_scale'])*100);
						$wei=$assessor_ratings['weightage'];
						echo $scorefinal=round((($score*$wei)/100),2);
					} 
					$wei_total=round($wei_total+($score_final+$scorefinal),2);
					?></td>
				</tr>
			<?php
			}
			?>
			<tr style="font-size:16px;">
				<td colspan='5'  style="font-size:18px;">Overall Score</td>
				<td style="font-size:18px;"><?php echo $wei_sum;?></td>
				<td style="font-size:18px;"><?php echo $wei_total;?></td>
			</tr>
			</tbody>
		</table>
		<br>
		<div style="color:red; padding-left:5px; font-size:8px;">
			For In-basket and Case study, a rating scale of 1 to 4 was used<br>
			<?php 
			foreach($ass_rating_scale as $key=>$ass_rating_scales){
				$g=($key!=0)?", ":"";
				?>
				<span style="font-size:8px;"><?php echo $g; ?><?php echo $ass_rating_scales['rating_number'];?>-<?php echo $ass_rating_scales['rating_name_scale'];?></span>
			<?php
			}
			?>
		</div>
		<br style="clear:both;">
		<img src="<?php echo $base64_new;?>" style="width:100%;height:200px;" >
	</div>
</body>

