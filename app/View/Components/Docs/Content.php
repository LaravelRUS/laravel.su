<?php

namespace App\View\Components\Docs;

use App\View\Modifications\BladeComponentModifier;
use App\View\Modifications\ImageAltModifier;
use App\View\Modifications\HeaderLinksModifier;
use App\View\Modifications\HighlightModifier;
use App\View\Modifications\BlockquoteColorModifier;
use App\View\Modifications\RemoveFirstHeaderModifier;
use App\View\Modifications\ResponsiveTableModifier;
use App\View\Modifications\TypografModifier;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use Symfony\Component\DomCrawler\Crawler;

class Content extends Component implements Htmlable
{
    /**
     * @var string
     */
    protected $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @throws \DOMException
     *
     * @return \App\View\Components\DocsContent
     */
    public function render()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function toHtml(): string
    {
        return Cache::remember('doc-content-' . sha1($this->content), now()->addWeek(), function () {
            $crawler = new Crawler();
            $crawler->addHtmlContent(mb_convert_encoding($this->content, 'UTF-8'));
            $content = $crawler->filterXpath('//body')->first()->html();

            return app(Pipeline::class)
                ->send($content)
                ->through([
                    HighlightModifier::class, // Подсвечивает код
                    BlockquoteColorModifier::class, // Применяет цвет к блокам цитат (Например предупреждение)
                    RemoveFirstHeaderModifier::class, // Удаляет h1 заголовок
                    HeaderLinksModifier::class, // Добавляет ссылки для заголовков
                    ResponsiveTableModifier::class, // Добавляет к таблице класс table-responsive
                    BladeComponentModifier::class, // Применяет компоненты blade
                    ImageAltModifier::class, // Добавляет alt к картинкам
                    TypografModifier::class, // Применяет типограф к тексту
                ])
                ->thenReturn();
        });
    }
}
