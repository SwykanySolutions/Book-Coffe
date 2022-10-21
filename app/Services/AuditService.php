<?php

namespace App\Services;

use App\Repositories\Contracts\AuditRepositoryInterface;
use Illuminate\Http\Request;

class AuditService
{
    protected $auditRepository;

    public function __construct(AuditRepositoryInterface $auditRepository)
    {
        $this->auditRepository = $auditRepository;
    }

    public function getAudits()
    {
        return $this->auditRepository->getLastsCategoryAudits();
    }

}
