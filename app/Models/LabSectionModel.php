<?php

namespace App\Models;

use CodeIgniter\Model;

class LabSectionModel extends Model
{
    protected $table = 'lab_sections';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'lab_id',
        'name',
        'slug',
        'section_number'
    ];

    // Get section by lab ID and section slug
    public function getSectionBySlug($labId, $sectionSlug)
    {
        return $this->where('lab_id', $labId)
                    ->where('slug', $sectionSlug)
                    ->first();
    }

    // Get all sections for a specific lab
    public function getLabSections($labId)
    {
        return $this->where('lab_id', $labId)
                    ->orderBy('section_number', 'ASC')
                    ->findAll();
    }
}