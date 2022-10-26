<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TermsConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TermsCondition::query()->updateOrInsert(["type" => "developer_terms_condition"],["type" => "developer_terms_condition", "terms_condition" => "<p>OK</p>"]);
        \App\Models\TermsCondition::query()->updateOrInsert(["type" => "buyer_terms_condition"], ["type" => "buyer_terms_condition", "terms_condition" => "<p>OK</p>"]);
        \App\Models\TermsCondition::query()->updateOrInsert(["type" => "reskin_terms_condition"], ["type" => "reskin_terms_condition", "terms_condition" => "<p>OK</p>"]);
        \App\Models\TermsCondition::query()->updateOrInsert(["type" => "user_terms_condition"], ["type" => "user_terms_condition", "terms_condition" => "<p>OK</p>"]);
        \App\Models\TermsCondition::query()->updateOrInsert(["type" => "affiliate_terms_condition"], ["type" => "affiliate_terms_condition", "terms_condition" => "<p>OK</p>"]);
    }
}