<?php

namespace App\Repositories\Contracts;

interface AuditRepositoryInterface
{
    public function getLastsAudits(int $idUser = null);
    public function getLastsCategoryAudits(int $id = null);
    public function getLastsChapterMangaAudits(int $id = null);
    public function getLastsFormatAudits(int $id = null);
    public function getLastsFrameAudits(int $id = null);
    public function getLastsMangaOverViewAudits(int $id = null);
    public function getLastsPeopleAudits(int $id = null);
    public function getLastsRoleAudits(int $id = null);
    public function getLastsSliderAudits(int $id = null);
    public function getLastsStatusAudits(int $id = null);
}
