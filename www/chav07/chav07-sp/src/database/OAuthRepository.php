<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/IOAuthRepository.php";
require_once __DIR__ . "/DbConnection.php";
require_once __DIR__ . "/DTOs/OAuthInfoModelCreate.php";
require_once __DIR__ . "/OAuthInfoModel.php";

class OAuthRepository implements IOAuthRepository{

    public function __construct()
    {
        
    }

    public function getOauthInfoById(int $userId) : ?OAuthInfoModel{

        try{
            $pdo = DbConnection::getConnection();

            $statement = $pdo->prepare("SELECT * FROM USER_OAUTH_INFO WHERE USER_ID = :user_id LIMIT 1");
            $statement->bindValue(":user_id", $userId);
            $statement->execute();

            $info = $statement->fetchAll();
            if(!empty($info)){
                $result = new OAuthInfoModel(
                    $info[0]["INFO_ID"],
                    $info[0]["USER_ID"],
                    $info[0]["OAUTH_PROVIDER"],
                );

                return $result;
            }

        }
        catch(PDOException $e){
            exit("Database call failed: " . $e);
        }
        
        return null;
    }
    
    public function createOauthInfo(OAuthInfoModelCreate $info){
        try{
            $pdo = DbConnection::getConnection();

            $statement = $pdo->prepare("INSERT INTO USER_OAUTH_INFO(USER_ID, OAUTH_PROVIDER) VALUES(:user_id, :outh_provider)");
            $statement->bindValue(":user_id", $info->user_id);
            $statement->bindValue(":outh_provider", $info->provider);
            $statement->execute();

        }
        catch(PDOException $e){
            exit("Database call failed: " . $e);
        }
    }
}


?>