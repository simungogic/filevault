<?php

class Asset extends Controller
{
    public $loggedIn = false;

    public function index()
    {
    }

    public function items()
    {
        FileVault::model('Session')->get('userid');
        $model = FileVault::model('AssetModel');
        echo $model->getAssetsList(FileVault::model('Session')->get('userid'),2,1);
    }
}