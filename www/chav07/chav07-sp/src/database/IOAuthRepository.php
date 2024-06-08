<?php 
require_once __DIR__ . "/DTOs/OAuthInfoModelCreate.php";
require_once __DIR__ . "/OAuthInfoModel.php";

interface IOAuthRepository{
    public function getOauthInfoById(int $userId) : ?OAuthInfoModel;
    public function createOauthInfo(OAuthInfoModelCreate $info);
    
}


?>