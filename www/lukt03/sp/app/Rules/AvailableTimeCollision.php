<?php

namespace App\Rules;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriodImmutable;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class AvailableTimeCollision implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $start = CarbonImmutable::make($value);
        $end = CarbonImmutable::make($this->data['end']);
        $availableTimes = auth()->user()->availableTimes;

        foreach ($availableTimes as $availableTime) {
            if (($start->between($availableTime->start, $availableTime->end) && $start->isBefore($availableTime->end)) || 
                ($end->between($availableTime->start, $availableTime->end) && $end->isAfter($availableTime->start))) {
                $fail('validation.colliding_event')->translate();
                return;
            }
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }
}
