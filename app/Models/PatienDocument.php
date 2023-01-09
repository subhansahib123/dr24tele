<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatienDocument extends Model
{
    protected $table = 'patien_documents';
    use HasFactory;
    protected $fillable = ['title','doc_file', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patinet_document_id');
    }
}
