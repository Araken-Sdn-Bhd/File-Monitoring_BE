<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tenders extends Model
{
    use HasFactory;
    
    protected $table ='tenders';
    protected $primaryKey ='tender_id';
    protected $fillable =['client_id', 'user_id', 'title', 'submission_date', 'submission_price', 'remark',
     'tender_requirement','tender_doc_path','technical', 'technical_doc_path','financial', 'financial_doc_path','others', 'others_doc_path', 'reference_no'];
}
