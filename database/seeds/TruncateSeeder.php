<?php

use Illuminate\Database\Seeder;

class TruncateSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ContactForm::truncate();
        \App\DeliveryTime::truncate();
        \App\Ad::truncate();
        \App\Newsletter::truncate();
        \App\Subbanner::truncate();
        \App\Banner::truncate();
        \App\ContentTranslation::truncate();
        \App\Content::truncate();
        \App\TitleTranslation::truncate();
        \App\Title::truncate();
        \App\SocialNetwork::truncate();

    }
}