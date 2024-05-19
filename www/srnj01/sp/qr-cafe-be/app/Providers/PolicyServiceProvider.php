<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\ApiKey;
use App\Models\Client;
use App\Models\Generated;
use App\Models\Seller;
use App\Models\Sequence;
use App\Policies\AccountPolicy;
use App\Policies\ApiKeyPolicy;
use App\Policies\ClientPolicy;
use App\Policies\GeneratedPolicy;
use App\Policies\SellerPolicy;
use App\Policies\SequencePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    protected $policies = [
        Client::class => ClientPolicy::class,
        Sequence::class => SequencePolicy::class,
        Account::class => AccountPolicy::class,
        ApiKey::class => ApiKeyPolicy::class,
        Seller::class => SellerPolicy::class,
        Generated::class => GeneratedPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
