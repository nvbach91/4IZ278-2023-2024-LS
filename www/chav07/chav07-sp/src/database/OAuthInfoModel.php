<?php 

class OAuthInfoModel{
    public int $info_id;
    public int $user_id;
    public string $provider;

    public function __construct(int $info_id, int $user_id, string $provider) {
        $this->info_id = $info_id;
        $this->user_id = $user_id;
        $this->provider = $provider;
    }
}

?>