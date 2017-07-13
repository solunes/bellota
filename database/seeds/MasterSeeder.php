<?php

use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Añadir otros lenguajes si aplica
        /*\Solunes\Master\App\Language::create([
            'code' => 'en',
            'name' => 'Ingles',
            'image' => 'en.png'
        ]);*/
        // General
        $site = \Solunes\Master\App\Site::find(1);
        $site->name = 'Master';
        $site->domain = 'http://master.dev/';
        $site->title = 'Muestra de Tienda Virtual';
        $site->description = 'Nuestro objetivo es programar la plataforma del Programa Municipal';
        $site->keywords = 'programa, municipal, iniciativas sostenibles, medio ambiente, guayaquil, ecuador';
        $site->google_verification = '';
        $site->analytics = '';
        $site->save();
        
        // Nodos
        $node_social_network = \Solunes\Master\App\Node::create(['name'=>'social-network', 'location'=>'app', 'folder'=>'global']);
        $node_title = \Solunes\Master\App\Node::create(['name'=>'title']);
        $node_content = \Solunes\Master\App\Node::create(['name'=>'content']);
        $node_banner = \Solunes\Master\App\Node::create(['name'=>'banner']);
        $node_subbanner = \Solunes\Master\App\Node::create(['name'=>'subbanner']);
        $node_newsletter = \Solunes\Master\App\Node::create(['name'=>'newsletter']);
        $node_ad = \Solunes\Master\App\Node::create(['name'=>'ad']);
        $node_delivery_item = \Solunes\Master\App\Node::create(['name'=>'delivery-time']);
        $node_contact_form = \Solunes\Master\App\Node::create(['name'=>'contact-form', 'folder'=>'form']);
        
        // Menu: Home
        $page_home = \Solunes\Master\App\Page::create(['type'=>'customized', 'customized_name'=>'home', 'es'=>['name'=>'Inicio']]);
        \Solunes\Master\App\Menu::create(['page_id'=>$page_home->id]);

        // Menu: Tienda
        $page_store = \Solunes\Master\App\Page::create(['type'=>'customized', 'customized_name'=>'store', 'es'=>['name'=>'Tienda']]);
        \Solunes\Master\App\Menu::create(['page_id'=>$page_store->id]);

        // Menu: About
        $page_about = \Solunes\Master\App\Page::create(['customized_name'=>'about', 'es'=>['name'=>'Bellota']]);
        \Solunes\Master\App\Menu::create(['page_id'=>$page_about->id]);

        // Menu: Blog
        $page_blog = \Solunes\Master\App\Page::create(['customized_name'=>'blog', 'es'=>['name'=>'Blog']]);
        \Solunes\Master\App\Menu::create(['page_id'=>$page_blog->id]);
        
        // Menu: Contacto
        $page_contact = \Solunes\Master\App\Page::create(['customized_name'=>'contact', 'es'=>['name'=>'Contacto']]);
        \Solunes\Master\App\Menu::create(['page_id'=>$page_contact->id]);
        
        // Variables
        \Solunes\Master\App\Variable::create([
            'name' => 'admin_email',
            'type' => 'string',
            'es' => ['value'=>'edumejia30@gmail.com'],
        ]);
        \Solunes\Master\App\Variable::create([
            'name' => 'footer_name',
            'type' => 'string',
            'es' => ['value'=>'Bast Bolivia'],
        ]);
        \Solunes\Master\App\Variable::create([
            'name' => 'footer_rights',
            'type' => 'string',
            'es' => ['value'=>'TODOS LOS DERECHOS RESERVADOS'],
        ]);

        // Social Networks
        \App\SocialNetwork::create([
            'code' => 'facebook',
            'url' => 'https://www.facebook.com/BASTbolivia/',
        ]);
        \App\SocialNetwork::create([
            'code' => 'youtube',
            'url' => 'https://www.youtube.com/',
        ]);
        
        /*factory(App\Customer::class, 30)->create();
        factory(App\CustomerPoint::class, 150)->create();
        factory(App\Operator::class, 100)->create(['city_id'=>$lpz->id]);
        factory(App\Operator::class, 100)->create(['city_id'=>$scz->id]);
        factory(App\OperatorAttendance::class, 100)->create(['operator_id'=>1, 'status'=>'1/2']);
        factory(App\OperatorAttendance::class, 100)->create(['operator_id'=>2, 'status'=>'O']);
        factory(App\Product::class, 20)->create(['type'=>'product']);
        factory(App\Product::class, 30)->create(['type'=>'implement']);*/
        /*factory(App\FilledForm::class, 50)->create(['form_id'=>1]);
        factory(App\FilledForm::class, 50)->create(['form_id'=>2]);
        factory(App\FilledForm::class, 50)->create(['form_id'=>3]);
        factory(App\FilledForm::class, 50)->create(['form_id'=>4]);
        factory(App\FilledForm::class, 50)->create(['form_id'=>5]);
        factory(App\FilledField::class, 50)->create(['filled_form_id'=>rand(1,50), 'field_id'=>rand(1,9)]);
        factory(App\FilledField::class, 50)->create(['filled_form_id'=>rand(51,100), 'field_id'=>rand(10,15)]);
        factory(App\FilledField::class, 50)->create(['filled_form_id'=>rand(101,150), 'field_id'=>rand(16,26)]);
        factory(App\FilledField::class, 50)->create(['filled_form_id'=>rand(151,200), 'field_id'=>rand(27,65)]);
        factory(App\FilledField::class, 50)->create(['filled_form_id'=>rand(201,250), 'field_id'=>rand(66,77)]);*/
        //factory(App\Questionnaire::class, 100)->create(['user_id'=>1]);
        
    }
}