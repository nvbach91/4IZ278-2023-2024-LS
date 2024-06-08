<?php 

class OAuthInfoModelCreate{
    public int $user_id;
    public string $provider;

    public function __construct(int $user_id, string $provider) {
        $this->user_id = $user_id;
        $this->provider = $provider;
    }
}

?>