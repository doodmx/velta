<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use Spatie\Sitemap\Tags\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\SitemapGenerator;
use App\Interfaces\Blog\BlogInterface;


class GenerateSitemap extends Command
{

    private $blogs, $courses;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It generates the website sitemap, excluding admin routes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(/*BlogInterface $blogContract*/)
    {
        parent::__construct();
       // $this->blogs = $blogContract;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SitemapIndex::create()
            ->add(Sitemap::create('/pages_sitemap.xml')
                ->setLastModificationDate(Carbon::yesterday()))
            ->add(Sitemap::create('/posts_sitemap.xml')
                ->setLastModificationDate(Carbon::yesterday()))
            ->writeToFile('public/sitemap.xml');


        SitemapGenerator::create(config('app.url'))
            ->getSitemap()
            ->add(
                Url::create('/')
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(1.0)
                    ->addAlternate('/', 'en')

            )
            ->add(Url::create(route('we_do'))
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.9)
                ->addAlternate(route('we_do'), 'en')
            )
            ->add(Url::create('/membership')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.8)
                ->addAlternate('/membership', 'en')
            )
            ->add(Url::create('/intro')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.7)
                ->addAlternate('/intro', 'en')
            )
            ->add(Url::create('/velta_center')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.7)
                ->addAlternate('/velta_center', 'en')
            )
            ->add(Url::create('/about')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.2)
                ->addAlternate('/about', 'en')
            )
            ->writeToFile(public_path('pages_sitemap.xml'));


       /* $posts = $this->blogs->showAll();
        $postsSitemap = SitemapGenerator::create(config('app.url'))
            ->getSitemap();

        foreach ($posts as $post) {
            $postsSitemap->add(Url::create('/blog/' . $post->seo->slug)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.2)
                ->addAlternate('/blog/' . $post->seo->slug, 'en')
            );
        }

        $postsSitemap->writeToFile(public_path('posts_sitemap.xml'));*/



    }
}
