<?php

namespace App\Repositories;

use App\Models\Audit;
use App\Models\Category;
use \App\Repositories\Contracts\AuditRepositoryInterface;

class AuditRepository implements AuditRepositoryInterface
{
    protected $audits;
    protected $category;

    public function __construct(Audit $audits, Category $category)
    {
        $this->audits = $audits;
        $this->category = $category;
    }

    public function getLastsAudits(int $id = null)
    {
    }

    public function getLastsCategoryAudits(int $id = null)
    {
    }

    public function getLastsChapterMangaAudits(int $id = null)
    {
        // TODO: Implement getLastsChapterMangaAudits() method.
    }

    public function getLastsFormatAudits(int $id = null)
    {
        // TODO: Implement getLastsFormatAudits() method.
    }

    public function getLastsFrameAudits(int $id = null)
    {
        // TODO: Implement getLastsFrameAudits() method.
    }

    public function getLastsMangaOverViewAudits(int $id = null)
    {
        // TODO: Implement getLastsMangaOverViewAudits() method.
    }

    public function getLastsPeopleAudits(int $id = null)
    {
        // TODO: Implement getLastsPeopleAudits() method.
    }

    public function getLastsRoleAudits(int $id = null)
    {
        // TODO: Implement getLastsRoleAudits() method.
    }

    public function getLastsSliderAudits(int $id = null)
    {
        // TODO: Implement getLastsSliderAudits() method.
    }

    public function getLastsStatusAudits(int $id = null)
    {
        // TODO: Implement getLastsStatusAudits() method.
    }
}
