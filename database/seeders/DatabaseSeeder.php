<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(FrameworkSeeder::class);
        $this->call(ProductTemplateSeeder::class);
        $this->call(SystemSettingSeeder::class);
        $this->call(TallySeeder::class);
        $this->call(PrivacyPolicySeeder::class);
        $this->call(TermsConditionSeeder::class);
        $this->call(EmailDesignSeeder::class);
        $this->call(SellYourAppSeeder::class);
        $this->call(LicenseSeeder::class);
        $this->call(DmcaSeeder::class);
        $this->call(Guarantee::class);
    }
}
