<?php

namespace App\Models;

use CodeIgniter\Model;

class UlsTest extends Model
{
    protected $table            = 'ulstests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'wrong_feedback','warning_enabled_flag','warning_duration','total_score','time_consume','test_type_flag','test_option','test_name','test_instructions','test_id','test_code','start_date_active','show_summary_flag','score_flag','resume_instructions','resume_flag','rating_scale_id','questions_per_page','post_test_feedback','parent_org_id','modified_date','modified_by','max_attempts','last_modified_id','keywords','inherit_feedback_flag','end_date_active','duration_flag','duration_between_attempts','duration','display_order_flag','description','created_date','created_by','correct_feedback','active_flag',
	];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
}
