<?php

declare(strict_types=1);
/**
 * This file is part of DTM-PHP.
 *
 * @license  https://github.com/dtm-php/dtm-client/blob/master/LICENSE
 */
namespace DtmClient;

use DtmClient\Exception\GenerateException;

class BranchIdGenerator implements BranchIdGeneratorInterface
{

    public function generateSubBranchId(): string
    {
        $branchId = TransContext::getBranchId();
        $subBranchId = TransContext::getSubBranchId();
        if ($subBranchId >= 99) {
            throw new GenerateException('branch id is larger than 99');
        }

        if (strlen($branchId) >= 20) {
            throw new GenerateException('total branch id is longer than 20');
        }

        $subBranchId = $subBranchId + 1;
        return $this->getCurrentSubBranchId($subBranchId);
    }

    public function getCurrentSubBranchId(int $subBranchId): string
    {
        return TransContext::getBranchId() . sprintf('%02d', $subBranchId);
    }
}
