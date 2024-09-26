<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsMenu extends Model
{
    protected $table            = 'uls_menu';
    protected $primaryKey       = 'menu_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'update_page','type','sort_page','read_page','parent_id','modified_by','menu_name','menu_id','menu_creation_id','link','last_modified_id','image_link','delete_page','default_name','created_by','create_page',
	];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    static function display_children2($parent, $level,$menu,$chk,$uri){
        $db= \Config\Database::connect();
        Global $sidemenuu;
        $chks=explode(",",$chk);
       
        $ulsmenulinks = $db->query("SELECT a.menu_id as id, a.menu_name as name, a.link as link, a.image_link as image_link, Deriv1.Count as Count from uls_menu a  LEFT OUTER JOIN (SELECT parent_id, COUNT(*) AS Count FROM uls_menu GROUP BY parent_id) Deriv1 ON a.menu_id = Deriv1.parent_id WHERE  a.parent_id=" . $parent." and a.menu_creation_id in (".$menu.") order by a.sort_page asc");
        $ulsmenulinks= $ulsmenulinks->getResultArray();
        $sidemenuu.=$parent!=0?"<ul id='dashboard_$parent' class='collapse collapse-level-$level'>":"";
        foreach($ulsmenulinks as $row){
            if($row['Count'] > 0){ //class='active open'
				$img2=!empty($row['image_link'])?($row['image_link']):"zmdi zmdi-book";
                $sidemenuu.="<li><a  href='javascript:void(0);' data-toggle='collapse' data-target='#dashboard_".($row['id'])."'>
				<div class='pull-left'><i class='$img2 mr-20'></i><span class='right-nav-text'>" . $row['name'] . "</span></div><div class='pull-right'><i class='zmdi zmdi-caret-down'></i></div><div class='clearfix'></div></a>";
                $menudata=new UlsMenu();				
                $menudata->display_children2($row['id'], $level + 1,$menu,$chk,$uri);
				$sidemenuu.="</li> <li><hr class='light-grey-hr mb-10'></li>";
                //if(in_array($row['id'],$chks)){ $sidemenuu.="</li>";}
            }
            elseif ($row['Count']==0){
                //if(in_array($row['id'],$chks)){
                    if($row['link']!="#"){
						$uri=str_replace(array("//hetero_lms/","/hetero_lms/","//cmsmvc/","/cmsmvc/"),array("","","",""),$uri);
						//$uri=str_replace('/polycab/','',$uri);
						if(strpos($row['link'],$uri)){ $sst="class='active'";}else{$sst="";}
						//$sst="";
						$img=!empty($row['image_link'])?($row['image_link']):"zmdi zmdi-book";
						if($parent==0){
							 $sidemenuu.="<li ".$sst."><a href='".base_url($row['link'])."' onclick=\"link('".$row['link']."')\" ".$sst." ><div class='pull-left'><i class='$img mr-20'></i><span class='right-nav-text'>" . $row['name'] . "</span></div><div class='pull-right'></div><div class='clearfix'></div></a></li>
							 <li><hr class='light-grey-hr mb-10'></li>";
						}
						else{
							 $sidemenuu.="<li ".$sst."><a href='".base_url($row['link'])."' onclick=\"link('".$row['link']."')\" ".$sst." >" . $row['name'] . "</a></li>";
						}
                       
						
                    }
                //}
            } else;
        }
        $sidemenuu.=$parent!=0?"</ul>":"";
        return $sidemenuu;
    }

    static function display_parent_nodes($id,$home){
        $db= \Config\Database::connect();
        $Menu_Id=session()->get('Menu_Id');
        if(!empty($Menu_Id)){
			$mid=array();
			$id=str_replace(array("//adani_server"),array(""),$id);
            //unset($_SESSION['selectedmenuitem']);
           
            $ulsmenulinks="SELECT menu_id,parent_id,link,menu_name FROM `uls_menu` WHERE menu_creation_id=".session()->get('Menu_Id');
		    $ulsmenulinks=$db->query($ulsmenulinks);
            $ulsmenulinks=$ulsmenulinks->getResultArray();
            foreach($ulsmenulinks as $row){
                $ids=$row['menu_id'];
                $data[$ids]=$row; 
            }
            foreach($data as $v){
                if($v['link']==$id){
                    $b=$v['menu_id'];
                    $current =$data[$b];
					$mid[]=$b;
                    //$current = $data[$id];
                    $parent_id = $current["parent_id"] === 0 ? 0 : $current["parent_id"];					
                    //$parents = ($current["link"]=="#")?array("<a href='#'>".$current["menu_name"]."</a>"):array("<a href='/polycab".$current["link"]."'>".$current["menu_name"]."</a>");
                    $i=0;
                    while(isset($data[$parent_id])){
                        $current = $data[$parent_id];
						$mid[]=$parent_id;
                        $parent_id = $current["parent_id"] === 0 ? 0 : $current["parent_id"];
						//isset($data[$parent_id])?print_r($data[$parent_id]):"";
                        if($i==0){$_SESSION['selectedmenuitem']=$current["menu_name"];}
                        //$parents[] = ($current["link"]=="#")?"<a href='#'>".$current["menu_name"]."</a>":"<a href='/polycab".$current["link"]."'>".$current["menu_name"]."</a>";
                        $i++;
                    }
                }
            }
			foreach($mid as $v){
				$lnk=$data[$v]['link'];
				if($data[$v]['link']=='#'){
					//echo $data[$v]['menu_name'];
                    $ulsmnulnk = $db->query("SELECT menu_id,parent_id,link,menu_name FROM `uls_menu` WHERE parent_id=$v and menu_creation_id=".session()->get('Menu_Id')." order by sort_page asc");
					$ulsmnulnk =$ulsmnulnk->getRow();
					$lnk=$ulsmnulnk->link;
					if($lnk=="#"){
                        $ulsmnulnk2 = $db->query("SELECT menu_id,parent_id,link,menu_name FROM `uls_menu` WHERE parent_id=".$ulsmnulnk->menu_id." and menu_creation_id=".session()->get('Menu_Id')." order by sort_page asc");
                        $ulsmnulnk2 =$ulsmnulnk2->getRow();
						$lnk=$ulsmnulnk2->link;
						if($lnk=="#"){
                            $ulsmnulnk3 = $db->query("SELECT menu_id,parent_id,link,menu_name FROM `uls_menu` WHERE parent_id=".$ulsmnulnk2->menu_id." and menu_creation_id=".session()->get('Menu_Id')." order by sort_page asc");
                            $ulsmnulnk3 =$ulsmnulnk3->getRow();
							$lnk=$ulsmnulnk3->link;							
							if($lnk=="#"){
                                $ulsmnulnk4 = $db->query("SELECT menu_id,parent_id,link,menu_name FROM `uls_menu` WHERE parent_id=".$ulsmnulnk3->menu_id." and menu_creation_id=".session()->get('Menu_Id')." order by sort_page asc");
                                $ulsmnulnk4 =$ulsmnulnk4->getRow();
								$lnk=$ulsmnulnk4->link;
							}							
						}
					}
				}
				$parents[] = "<a href='".base_url($lnk)."'>".$data[$v]["menu_name"]."</a>";
			}
            //$parents[] =$home;
			if(!isset($parents)){$parents=array();}
			if(count($parents)<=0){$parents[] ="";}
            return implode(" ** ", array_reverse($parents));
        }
    }
}
