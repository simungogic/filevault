<?php

class AssetModel extends Model
{
    public function getAssetsList($userId,$page,$perPage/*,$orderBy,$order*/)
    {
        $start = ($page - 1) * $perPage;
        $query = $this->getDatabase()->prepare("SELECT * FROM Assets WHERE UserId = :userid LIMIT $start,$perPage");
        $query->bindParam(':userid', $userId);
        $query->execute();
        $rows = $query->fetch();
        return $rows['MimeTip'];//return $rows['Javno'];
    }
}